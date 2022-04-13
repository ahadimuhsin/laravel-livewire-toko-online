<div style="margin-top: 100px">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold mt-2">
                        <i class="fa fa-user-circle"></i>
                        DAFTAR </h3> <p> atau <a href="{{ route('auth.customer.login') }}" class="text-dartk">
                        <u> masuk jika sudah punya akun</u></a>
                        </p>
                </div>
                <div class="card border-0 shadow rounded-lg mb-3">
                    <div class="card-body">
                        <form wire:submit.prevent="register">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" wire:model.lazy="name"
                                id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Full Name">

                                @error("name")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" wire:model.lazy="email"
                                id="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email">

                                @error("email")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" wire:model.lazy="password"
                                id="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password">

                                @error("password")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="password" wire:model.lazy="password_confirmation"
                                id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Retype Your Password">

                                @error("password_confirmation")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block shadow">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>
