<x-front-layout title="Set Password">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ __('Set Password') }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ __('Set Password') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('password.set.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Set Your Password') }}</h3>
                                <p>{{ __('Since you logged in with a social account, you can create a password to log in
                                    directly with your email next time.') }}</p>
                            </div>

                            {{-- Password Field --}}
                            <div class="form-group input-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    id="password" name="password" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password Field --}}
                            <div class="form-group input-group">
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <input class="form-control" type="password" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <div class="button">
                                <button class="btn" type="submit">{{ __('Save Password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>