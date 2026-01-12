<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TrackUrlClick implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $urlId,
        public ?string $referer,
        public string $statDate
    ) {}

    public function handle(): void
    {

        DB::table('url_stats')->updateOrInsert(
            [
                'url_id' => $this->urlId,
                'stat_date' => $this->statDate,
                'referrer_url' => $this->referer,
            ],
            [
                'click_count' => DB::raw('COALESCE(click_count, 0) + 1'),
            ]
        );

    }
}
