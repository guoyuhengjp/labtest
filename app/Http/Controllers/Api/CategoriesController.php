<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Transformers\CategoryTransformer;


class CategoriesController extends Controller
{
    /**
     *
     * @author kaku
     * @since 2019.02.20
     * カテゴリーの一覧リスト
     */
    public function index()
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }
}
