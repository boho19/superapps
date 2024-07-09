<x-auth-layout>
    {{-- <x-auth-session-status class="btn-danger" :status="session('error')" /> --}}
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto align-self-center">
        <h2 class="text-center mb-4">Sign in</h2>
        <div class="card card-light shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="was-validated">
                    @csrf
                    <div class="form-floating mb-3">
                        <x-text-input type="email" id="emailaddress" name="email" placeholder="Masukan Email" :value="old('email')" required autofocus autocomplete="email" />
                        <x-input-label for="emailaddress" :value="__('Email')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="password" id="password" name="password" placeholder="Masukan Password" required autocomplete="current-password" />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    {{-- <div class="d-grid">
                        @if (Route::has('password.request'))
                        <a class="link mb-3" style="text-align: left;" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div> --}}

                    <div class="d-grid">
                        <x-primary-button>{{ __('Sign In') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-grid">
            <span>Don't have an account? <a href="/register" class="mb-3">Sign Up</a></span>
        </div>
    </div>
</x-auth-layout>
