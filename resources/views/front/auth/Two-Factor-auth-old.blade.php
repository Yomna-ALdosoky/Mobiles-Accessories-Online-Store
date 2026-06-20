<x-front-layout title="Security Settings">

    <section class="account-login section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-8">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        {{-- Header --}}
                        <div
                            class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 fw-bold">Two-Factor Authentication</h6>
                                <small class="text-muted">
                                    Extra security for your account
                                </small>
                            </div>

                            @if($user->two_factor_secret)
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                Enabled
                            </span>
                            @else
                            <span class="badge bg-light text-muted px-3 py-2">
                                Disabled
                            </span>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="card-body p-4">

                            <form method="POST" action="{{ route('two-factor.enable') }}">
                                @csrf

                                @if(!$user->two_factor_secret)

                                {{-- Enable State --}}
                                <div class="text-center py-4">

                                    <div class="mb-3">
                                        <i class="lni lni-shield fs-1 text-primary"></i>
                                    </div>

                                    <p class="text-muted mb-4">
                                        Protect your account with an additional verification step.
                                    </p>

                                    <button class="btn btn-primary px-4 py-2">
                                        Enable 2FA
                                    </button>

                                </div>

                                @else

                                {{-- QR --}}
                                <div class="mb-4 text-center">

                                    <p class="small text-muted mb-2">
                                        Scan using Google Authenticator
                                    </p>

                                    <div class="d-inline-block p-3 border rounded-3 bg-light">
                                        {!! $user->twoFactorQrCodeSvg() !!}
                                    </div>

                                </div>

                                {{-- Divider --}}
                                <div class="border-top my-4"></div>

                                {{-- Recovery Codes --}}
                                <div class="mb-4">

                                    <div class="d-flex justify-content-between mb-2">
                                        <h6 class="fw-bold mb-0">Recovery Codes</h6>
                                        <small class="text-muted">Keep them safe</small>
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
                                                        Copy
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
                                        ✔ 2FA is active
                                    </span>

                                    <button class="btn btn-outline-danger btn-sm px-3">
                                        Disable
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

    {{-- Copy Script --}}
    <script>
        document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(btn.dataset.code);
            btn.innerText = 'Copied';
            setTimeout(() => btn.innerText = 'Copy', 1500);
        });
    });
    </script>

</x-front-layout>