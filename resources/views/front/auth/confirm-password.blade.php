<x-front-layout :title="__('Confirm Password')">

    <section class="account-login section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-8">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        {{-- Header --}}
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h6 class="mb-1 fw-bold"><span>🔒</span>{{ __('Confirm Password') }}</h6>
                            <small class="text-muted">
                                {{ __('This is a secure action. Please confirm your password.') }}
                            </small>
                        </div>

                        {{-- Body --}}
                        <div class="card-body p-4">

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="mb-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" type="password" name="password"
                                        class="form-control mt-1" required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary px-4 py-2">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</x-front-layout>