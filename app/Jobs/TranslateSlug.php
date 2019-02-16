<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;


class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $topic;

    public function __construct(Topic $topic)
    {
        //  Eloquentを取得
        $this->topic = $topic;
    }

    public function handle()
    {
        // 翻訳APIにデータを請求
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);

        // DBの操作
        \DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }

}
