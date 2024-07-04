<x-auth-layout>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto align-self-center">
        <h2 class="text-center mb-4">Sign Up</h2>
        <div class="card card-light shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="was-validated">
                    @csrf
                    <div class="form-floating mb-3">
                        <x-text-input type="email" id="emailaddress" name="email" placeholder="Masukan Email" :value="old('email')" required autocomplete="username" />
                        <x-input-label for="emailaddress" :value="__('Email')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="password" id="password" name="password" placeholder="Masukan Password" required autocomplete="new-password" />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="form-floating mb-3">
                        <x-text-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Masukan Konfirmasi Password" required autocomplete="new-password" />
                        <x-input-label for="password" :value="__('Confirm Password')" />
                    </div>
                    <div class="d-grid">
                        <x-primary-button>{{ __('Sign Up') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-grid">
            <span>Have an account? <a href="/login" class="mb-3">Sign In</a></span>
        </div>
    </div>
</x-auth-layout>
