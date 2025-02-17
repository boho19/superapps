<x-auth-layout>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto align-self-center">
        <div class="card card-light shadow-sm mb-4">
            <div class="my-2 text-white text-sm">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="my-2 text-white font-medium text-sm">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div>
                            <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-primary-button>{{ __('Log Out') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
