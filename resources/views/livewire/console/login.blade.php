<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card border-0 shadow rounded-lg mb-3">
        <div class="card-body">
            <form wire:submit.prevent="login">
                {{-- Email --}}
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" wire:model.lazy="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Alamat Email">

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- Password --}}
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" wire:model.lazy="password"
                     class="form-control @error('password') is-invalid @enderror"
                     placeholder="Password">

                     @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
                <small>
                    <a href="{{ route('auth.customer.login') }}" class="float-right">Login sebagai customer</a>
                </small>
            </form>
        </div>
    </div>
</div>
