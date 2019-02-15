<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\UserRequest;

class UsersController extends Controller
{

    /**
     * ユーザー表示
     * @author kaku
     * @createtime 2019.02.15
     * @$user model
     * @return view
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * ユーザー編集
     * @author kaku
     * @createtime 2019.02.15
     * @$user model
     * @return view
     */
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }


    /**
     * ユーザー編集情報保存
     * @author kaku
     * @createtime 2019.02.15
     * @$user model
     * @return view
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '個人情報が更新しました');
    }

}
