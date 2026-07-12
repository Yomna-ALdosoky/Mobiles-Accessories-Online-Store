<x-front-layout :title="__('Register')">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ __('Registration') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                        <li>{{ __('Registration') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>{{ __('No Account? Register') }}</h3>
                            <p>{{ __('Registration takes less than a minute but gives you full control over your
                                orders.') }}</p>
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

                        @if ($errors->any())
                        <div class="alert alert-danger mb-3" style="border-radius: 10px;">
                            <h4 class="text-danger" style="font-size: 16px;">{{ __('There is a problem with the data:')
                                }}</h4>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="reg-fn">{{ __('First Name') }}</label>
                                        <input class="form-control" type="text" name="name" id="reg-fn"
                                            value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="reg-email">{{ __('E-mail Address') }}</label>
                                        <input class="form-control" type="email" name="email" id="reg-email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="reg-phone">{{ __('Phone Number') }}</label>
                                        <input class="form-control" type="text" name="phone_number" id="reg-phone"
                                            value="{{ old('phone_number') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="reg-pass">{{ __('Password') }}</label>
                                        <input class="form-control" type="password" name="password" id="reg-pass"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="reg-pass-confirm">{{ __('Confirm Password') }}</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            id="reg-pass-confirm" required>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="button">
                                        <button class="btn" type="submit">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </div>

                            <p class="outer-link">
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}">{{ __('Login Now') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>