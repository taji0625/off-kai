@extends('app')

@section('title', 'ログイン - オフ会.com')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <div class="card mt-3 text-center">
                    <div class="card-header">
                        <span style="color: rgb(124,123,123); font-size: 18px;">
                            ログイン
                        </span>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body text-center">
                        @include('errors')
                        <div class="card-text">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="md-form mt-5">
                                    <label for="email">
                                        メールアドレス
                                    </label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" required  autocomplete="email" value="{{ old('email') }}" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="md-form mt-5">
                                    <label for="password">
                                        パスワード
                                    </label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <input type="hidden" name="remember" id="remember" value="on">

                                <div class="text-left mt-5">
                                    <a href="{{ route('password.request') }}" class="card-text  atag_gray">パスワードを忘れた方はこちら</a>
                                </div>

                                <button class="btn login-btn mt-5 mb-2" type="submit">
                                    ログイン
                                </button>

                                <button class="btn guest-login-btn mt-4 mb-2">
                                    <a href="{{ route('login.guest') }}" class="text-white" >
                                        ゲストログイン（閲覧用）
                                    </a>
                                </button>

                            </form>

                            <div class="mt-4 mb-2">
                                <a href="{{ route('register') }}" class="card-text atag_gray">
                                    ユーザー登録はこちら
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
@endsection
