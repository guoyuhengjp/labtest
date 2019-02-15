<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next)
    {
        // 三つの判断：
        // 1. ユーザーはすでにログインしました
        // 2.　メールアドレスの認証はまだ
        // 3. 今訪問したURLはメールのURLではない。
        if ($request->user() &&
            ! $request->user()->hasVerifiedEmail() &&
            ! $request->is('email/*', 'logout')) {

            // 画面メッセージを表示する
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
