<x-front-layout :title="__('2FA Challenge')">

    <div class="account-login section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-5 col-md-7 col-12">
                    <form class="card border-0 shadow rounded-4" action="{{ route('two-factor.login') }}" method="post">
                        @csrf

                        {{-- Header --}}
                        <div class="card-header bg-white border-bottom py-3 px-4 text-center">

                            <h6 class="fw-bold d-flex justify-content-center align-items-center gap-2 mb-1">
                                <span>🔐</span>
                                {{ __('Verify Your Identity') }}
                            </h6>

                            <small class="text-muted">
                                {{ __('Enter the verification code to continue') }}
                            </small>

                        </div>

                        {{-- Body --}}
                        <div class="card-body p-4">

                            @if ($errors->has('code'))
                            <div class="alert alert-danger py-2 small">
                                {{ $errors->first('code') }}
                            </div>
                            @endif

                            {{-- 2FA Code --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ __('2FA Code') }}</label>
                                <input class="form-control" type="text" name="code"
                                    style="height: 42px; border-radius: 10px;">
                            </div>

                            {{-- Recovery Code --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ __('Recovery Code') }}</label>
                                <input class="form-control" type="text" name="recovery_code"
                                    style="height: 42px; border-radius: 10px;">
                            </div>

                            {{-- Button --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary px-4 py-2 rounded-3">
                                    {{ __('Confirm') }}
                                </button>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</x-front-layout>