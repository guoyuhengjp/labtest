<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings']
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

        //カテゴリーリスト
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');

        //投稿一覧
        $api->get('topics', 'TopicsController@index')
            ->name('api.topics.index');

        // TOKENがいるAPI
        $api->group(['middleware' => 'api.auth'], function($api) {

            // 現在のユーザー情報
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');

            //ユーザーの写真
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');

            //ユーザーの情報の更新
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');

            //ユーザー新しい投稿
            $api->post('topics', 'TopicsController@store')
                ->name('api.topics.store');

            //ユーザー投稿の編集
            $api->patch('topics/{topic}', 'TopicsController@update')
                ->name('api.topics.update');

            //ユーザー投稿の削除
            $api->delete('topics/{topic}','TopicsController@destroy')
                ->name('api.topics.destroy');
        });
    });
});
