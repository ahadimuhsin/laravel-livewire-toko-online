<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-users"></i> Create Users
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" wire:model.lazy="name"
                                id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama Lengkap">

                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" wire:model.lazy="email"
                                id="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Alamat Email">

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" wire:model.lazy="password"
                                id="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password">

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password Confimation</label>
                                <input type="password" wire:model.lazy="password_confirmation"
                                id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Password Confirmation">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <button type="reset" class="btn btn-warning">RESET</button>
                </form>
            </div>
        </div>
    </div>
</div>
