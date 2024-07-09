<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PATCH')

    <!-- change password -->
    <div class="row mb-3">
        <div class="col">
            <h5 class="mb-0">Change Password</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-light shadow-sm mb-4">
                <div class="card-body">
                    <div class="row h-100">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="form-floating">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">Change Password</button>
    </div>
</form>
