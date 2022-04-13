<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-folder"></i> Tambah Kategori
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-md-12">
                                @if($image)
                                <div class="text-center">
                                    <img src="{{ $image->temporaryUrl() }}"
                                    alt="" style="height: 150px; width: 150px; object-fit: cover"
                                    class="img-thumbnail">
                                    <p>Preview</p>
                                </div>
                                @else
                                <div class="text-center">
                                    <img src="{{ asset('images/image.png') }}" alt=""
                                    style="height: 150px; width: 150px; object-fit: cover"
                                    class="img-thumbnail">
                                    <p>Preview</p>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                    wire:model="image" required>
                                    @error('image')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" wire:model="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nama Kategori">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
