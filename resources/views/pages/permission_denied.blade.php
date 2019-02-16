@extends('layouts.app')
@section('title', 'アクセス禁止')

@section('content')
  <div class="col-md-4 offset-md-4">
    <div class="card ">
      <div class="card-body">
        @if (Auth::check())
          <div class="alert alert-danger text-center mb-0">
            アクセスは禁止しています
          </div>
        @else
          <div class="alert alert-danger text-center">
            先にログインしてください
          </div>

          <a class="btn btn-lg btn-primary btn-block" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            ログイン
          </a>
        @endif
      </div>
    </div>
  </div>
@stop
