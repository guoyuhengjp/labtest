<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    /**
     * ホームページで表示
     * @author kaku
     * @createtime 2019.02.16
     */
    public function root()
    {
        return view('pages.root');
    }
}
