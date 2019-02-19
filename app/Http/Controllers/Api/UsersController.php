<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Transformers\UserTransformer;

class UsersController extends Controller
{

    /**
     *
     * @author kaku
     * @createtime 2019.02.18
     * 携帯認証APi
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);


        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }


    /**
     *
     * @author kaku
     * @createtime 2019.02.18
     * ユーザー情報
     */

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
