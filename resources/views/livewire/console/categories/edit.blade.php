<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-folder"></i> Edit Category
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="categoryId"> {{-- valuenya adalah categoryId di dalam controller livewire --}}
                        <div class="row">
                            <div class="col-md-12">
                                @if($image)
                                <div class="text-center">
                                    <img src="{{ $image->temporaryUrl() }}" alt=""
                                    style="height: 150px; width: 150px; object-fit: cover"
                                    class="img-thumbnail">
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
                                    wire:model="image">
                                    @error('image')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" id="name"
                                    wire:model.lazy="name" class="form-control @error ('name') is-invalid @enderror"
                                    placeholde="Category Name">

                                    @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
