<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' =>'画像は jpeg, bmp, png, gif でお願いします',
            'avatar.dimensions' => '画像のサーズは208pxでお願いします',
            'name.unique' => 'ユーザー名を入力してください',
            'name.regex' => 'ユーザー名は英語、数字の組み合わせしてください',
            'name.between' => 'ユーザー名は3文字から25文字まで設定してください',
            'name.required' => 'ユーザー名を入力してください',
        ];
    }
}
