<?php

namespace App\Http\Controllers;

use App\Helpers\Base62;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Url;

class UrlController extends Controller
{

    public function create(){
        return view('url.create');
    }

    public function url()
    {
        $urls = Url::where('created_by', auth()->id())
            ->latest()
            ->paginate(1);
        return view('url.index', compact('urls'));
    }
    
    public function store(Request $request)
    {
        $url = Url::create([
            'url' => $request->url,
            'short_url' => Base62::generateUnique(6),
        ]);
        return redirect()->route('url');
    }

    public function delete($id)
    {
        $url = Url::findOrFail($id);
        
        cache()->forget("url:short:{$url->short_url}");
       
        $url->delete();
        return redirect()->route('url');
    }


    public function slowRedirect($code, Request $request)
    {
        $startTime = microtime(true);
        $url = Url::where('short_url', $code)->firstOrFail();
        DB::table('url_stats')->updateOrInsert(
            [
                'url_id' => $url->id,
                'stat_date' => now()->toDateString(),
                'referrer_url' => $request->header('referer'),
            ],
            [
                'click_count' => DB::raw('click_count + 1'),
            ]
        );
        $duration = (microtime(true) - $startTime) * 1000;
        return redirect($url->url);
    }

    public function fastRedirect($code, Request $request)
    {
        $startTime = microtime(true);

        $cacheKey = "url:short:{$code}";
        $urlData = cache()->remember($cacheKey, 3600, function () use ($code) {
            $url = Url::where('short_url', $code)->firstOrFail();
            return ['id' => $url->id, 'url' => $url->url];
        });
        \App\Jobs\TrackUrlClick::dispatch(
            $urlData['id'],
            $request->header('referer'),
            now()->toDateString()
        );
        $duration = (microtime(true) - $startTime) * 1000;

        return redirect($urlData['url']);
    }
}
