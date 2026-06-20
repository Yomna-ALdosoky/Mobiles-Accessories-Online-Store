<x-front-layout :title="__('Security Settings')">

    <section class="account-login section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-8">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        <div
                            class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 fw-bold">🔐 {{ __('Two-Factor Authentication') }}</h6>
                                <small class="text-muted">
                                    {{ __('Extra security for your account') }}
                                </small>
                            </div>

                            @if($user->two_factor_secret)
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                {{ __('Enabled') }}
                            </span>
                            @else
                            <span class="badge bg-light text-muted px-3 py-2">
                                {{ __('Disabled') }}
                            </span>
                            @endif
                        </div>
                        <div class="card-body p-4">

                            <form method="POST" action="{{ route('two-factor.enable') }}">
                                @csrf

                                @if(!$user->two_factor_secret)

                                <div class="text-center py-4">

                                    <div class="mb-3">
                                        <i class="lni lni-shield fs-1 text-primary"></i>
                                    </div>

                                    <p class="text-muted mb-4">
                                        {{ __('Protect your account with an additional verification step.') }}
                                    </p>

                                    <button class="btn btn-primary px-4 py-2">
                                        {{ __('Enable 2FA') }}
                                    </button>
                                </div>
                                @else

                                <div class="mb-4 text-center">
                                    <p class="small text-muted mb-2">
                                        {{ __('Scan using Google Authenticator') }}
                                    </p>
                                    <div class="d-inline-block p-3 border rounded-3 bg-light">
                                        {!! $user->twoFactorQrCodeSvg() !!}
                                    </div>
                                </div>

                                <div class="border-top my-4"></div>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h6 class="fw-bold mb-0">{{ __('Recovery Codes') }}</h6>
                                        <small class="text-muted">{{ __('Keep them safe') }}</small>
                                    </div>
                                    <div class="bg-light border rounded-3 p-3">
                                        <div class="row g-2">
                                            @foreach ($user->recoveryCodes() as $code)
                                            <div class="col-6">
                                                <div
                                                    class="d-flex justify-content-between align-items-center bg-white px-2 py-1 rounded border">

                                                    <code class="small">{{ $code }}</code>

                                                    <button type="button" class="btn btn-sm btn-light border copy-btn"
                                                        data-code="{{ $code }}">
                                                        {{ __('Copy') }}
                                                    </button>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>

                                {{-- Actions --}}
                                @method('DELETE')

                                <div class="d-flex justify-content-between align-items-center">

                                    <span class="text-success small fw-semibold">
                                        ✔ {{ __('2FA is active') }}
                                    </span>

                                    <button class="btn btn-outline-danger btn-sm px-3">
                                        {{ __('Disable') }}
                                    </button>

                                </div>

                                @endif

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.copy-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                navigator.clipboard.writeText(btn.dataset.code);
                btn.innerText = "{{ __('Copied') }}";
                setTimeout(() => btn.innerText = "{{ __('Copy') }}", 1500);
            });
        });
    </script>

</x-front-layout>