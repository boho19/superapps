<x-auth-layout>
    <!-- Session Status -->
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto align-self-center">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
        <div class="card card-light shadow-sm mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-floating mb-3">
                        <x-text-input type="email" id="emailaddress" name="email" placeholder="Masukan Email" :value="old('email')" required autofocus />
                        <x-input-label for="emailaddress" :value="__('Email')" />
                    </div>

                    <div class="d-grid">
                        <x-primary-button>{{ __('Email Password Reset Link') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
