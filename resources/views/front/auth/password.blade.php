<x-front-layout :title="$pageTitle">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">{{ $pageTitle }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> {{ __('Home') }}</a></li>
                            <li>{{ $pageTitle }}</li>
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
                    <form class="card login-form" action="{{ route('user-password.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ $pageTitle }}</h3>
                                <p>
                                    @if($isSettingPassword)
                                    {{ __('Since you logged in with a social account, you can create a password to log in directly next time.') }}
                                    @else
                                    {{ __('Please enter your current password to update it.') }}
                                    @endif
                                </p>
                            </div>

                            {{-- Current Password --}}
                            @if(!$isSettingPassword)
                            <div class="form-group input-group">
                                <label for="current_password">{{ __('Current Password') }}</label>
                                <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password"
                                    required>
                                @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            {{-- New Password --}}
                            <div class="form-group input-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="form-group input-group">
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="button">
                                <button class="btn" type="submit">
                                    {{ $isSettingPassword ? __('Save Password') : __('Update Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>