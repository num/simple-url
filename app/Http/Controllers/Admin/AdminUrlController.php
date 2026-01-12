<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;

class AdminUrlController extends Controller
{
    public function url()
    {
        $urls = Url::with('user')
            ->latest()
            ->paginate(1);
        return view('admin.url.index', compact('urls'));
    }

    public function delete($id)
    {
        $url = Url::findOrFail($id);
        
        // Clear cache
        cache()->forget("url:short:{$url->short_url}");
        
        $url->delete();
        return redirect()->route('admin.url');
    }
}
