<?php
namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    // linkの保存でcacheをclear
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}
