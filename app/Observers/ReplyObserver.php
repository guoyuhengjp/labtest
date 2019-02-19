<?php

namespace App\Observers;

use App\Models\Reply;

use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    /**
     *
     * @author kaku
     * @createtime 2019.02.19
     * 返信終わるの監視
     */

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();

        $reply->topic->user->notify(new TopicReplied($reply));
    }

    /**
     *
     * @author kaku
     * @createtime 2019.02.19
     * 返信中の監視
     */

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }


    /**
     *
     * @author kaku
     * @createtime 2019.02.20
     * 返信を削除する時
     */
    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }
}
