<?php

namespace App\Observers;

use App\Models\Topic;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        // XSS の防止
        $topic->body = clean($topic->body, 'user_topic_body');

        // 話題一覧を生成
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // APIと通信がよくない時
        if ( ! $topic->slug) {

            // dispatch
            dispatch(new TranslateSlug($topic));
        }
    }
}

