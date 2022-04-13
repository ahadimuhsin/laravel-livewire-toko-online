<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-shopping-bag"></i> Edit Produk
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" id="image" wire:model="image"
                                    class="form-control">

                                    @error('image')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" id="title" wire:model.lazy="title"
                                    class="form-control @error('title') is-invalid @enderror">

                                    @error('title')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label>Category</label>
                                    <select class="select2 form-control
                                    @error('category_id') is-invalid @enderror"
                                    wire:model.lazy="category_id">

                                    <option value="">Pilih Kategori</option>

                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                    </option>
                                    @endforeach

                                    </select>

                                    @error('category_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="text" id="weight" wire:model.lazy="weight"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    placeholder="Weight Product">

                                    @error('weight')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" wire:ignore>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Content Product</label>
                                    <textarea id="content" wire:model.lazy="content" rows="5"
                                    class="form-control @error('content') is-invalid @enderror"
                                    placeholder="Content">{{ $content }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" wire:model.lazy="unit" id="unit"
                                    class="form-control @error('unit') is-invalid @enderror"
                                    placeholder="Unit Product, Exp: gram, kg">

                                    @error('unit')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit Weight</label>
                                    <input type="text" wire:model.lazy="unit_weight" id="unit_weight"
                                    class="form-control @error('unit_weight') is-invalid @enderror"
                                    placeholder="Unit Weight Product">

                                    @error('unit_weight')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" wire:model.lazy="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Price Product">

                                    @error('price')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount (%)</label>
                                    <input type="text" wire:model.lazy="discount" id="discount"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    placeholder="Product Discount (%)">

                                    @error('discount')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keywords</label>
                                    <input type="text" wire:model.lazy="keywords" id="keywords"
                                    class="form-control @error('keywords') is-invalid @enderror"
                                    placeholder="Keywords Product">

                                    @error('keywords')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea wire:model.lazy="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description Product" rows="4">{{ $description }}</textarea>
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

<script>
    $(document).ready(function(){
        //select 2 category
        $('.select2').select2({
            theme: 'bootstrap4',
            width: 'style'
        });

        $('.select2').on('change', function(e){
            @this.set('category_id', e.target.value);
        });
    })
</script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content').on('change', function(e){
        @this.set('content', e.editor.getData());
    });

    CKEDITOR.replace('description').on('change', function(e){
        @this.set('description', e.editor.getData());
    })
</script>
