<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;

class CategoriesController extends Controller
{

    /**
     * カテゴリーによる話題の表示
     * @author kaku
     * @createtime 2019.02.16
     */
    public function show(Category $category, Request $request, Topic $topic, User $user)
    {
        // ID関連している話題、２０行で表示
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);

        $active_users = $user->getActiveUsers();

        return view('topics.index', compact('topics', 'category', 'active_users'));
    }
}
