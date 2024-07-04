<x-auth-layout>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 mx-auto align-self-center">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <div class="card card-light shadow-sm mb-4">
            <div class="card-body">

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <x-text-input type="password" id="password" name="password" placeholder="Masukan Password" required autocomplete="current-password" />
                        <x-input-label for="password" :value="__('Password')" />
                    </div>

                    <div class="d-grid">
                        <x-primary-button>{{ __('Confirm') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
