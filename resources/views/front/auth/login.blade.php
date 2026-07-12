<x-front-layout title="{{ __('Login Now') }}">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Login Now') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                        <li>{{ __('Login Now') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Login Now') }}</h3>
                                <p>{{ __('You can login using your social media account or email address.') }}</p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <a class="btn google-btn w-100"
                                            href="{{ route('auth.socilaite.redirect', 'google') }}">
                                            <i class="lni lni-google"></i> {{ __('Google login') }}
                                        </a>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <a class="btn facebook-btn w-100"
                                            href="{{ route('auth.socilaite.redirect', 'facebook') }}">
                                            <i class="lni lni-facebook-filled"></i> {{ __('Facebook login') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>{{ __('Or') }}</span>
                            </div>
                            @if ($errors->has(config('fortify.username')))
                            <div class="alert alert-danger">
                                {{ $errors->first(config('fortify.username')) }}
                            </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-email">{{ __('Email') }}</label>
                                <input class="form-control" type="text" name="{{ config('fortify.username') }}"
                                    id="reg-email" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-pass">{{ __('Password') }}</label>
                                <input class="form-control" type="password" name="password" id="reg-pass" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" value="1" class="form-check-input width-auto"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">{{ __('Remember me') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="lost-pass" href="{{ route('password.request') }}">{{ __('Forgot password?')
                                    }}</a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Login Now') }}</button>
                            </div>
                            @if (Route::has('register'))
                            <p class="outer-link">{{ __("Don't have an account?") }}
                                <a href="{{ route('register') }}">{{ __('Register here') }}</a>
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>