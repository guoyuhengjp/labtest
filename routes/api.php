<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array'
], function($api) {

    // 携帯認証コードAPI
    $api->post('verificationCodes', 'VerificationCodesController@store')
        ->name('api.verificationCodes.store');

    //ユーザーログインAPI
    $api->post('users', 'UsersController@store')
        ->name('api.users.store');

    //テストAPI
    $api->get('version', function() {
        return response('this is version v2');
    });

    //ユーザーのTokenの発行
    $api->post('authorizations', 'AuthorizationsController@store')
        ->name('api.authorizations.store');

    // tokenの更新
    $api->put('authorizations/current', 'AuthorizationsController@update')
        ->name('api.authorizations.update');

    // tokenの削除
    $api->delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('api.authorizations.destroy');


    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // TODO::ゲストAPI

        // TOKENがいるAPI
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 現在のユーザー情報
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
        });
    });
});
