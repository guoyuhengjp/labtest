<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // 違う並び方による、データの処理アルゴリズムは違う

        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }

        // N+1の問題に対して
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 毎回の最新のメッセージがあったら、reply_countの更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 時間による
        return $query->orderBy('created_at', 'desc');
    }

}
