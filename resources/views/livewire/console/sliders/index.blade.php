<div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-header"></i> Sliders
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $no=>$slider)
                            <tr>
                                <th class="text-center" scope="row">
                                    {{ ++$no + ($sliders->currentPage() -1)
                                    * $sliders->perPage()  }}
                                </th>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/sliders/').$slider->image }}"
                                    class="w-100 rounded" style="height: 200px">

                                    <p class="mt-2">{{ $slider->link }}</p>
                                </td>
                                <td class="text-center">
                                    <button wire:click="destroy({{ $slider->id }})" class="btn btn-sm btn-danger">
                                    Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow rounded-lg">
            <div class="fa fa-header">
                <i class="fa fa-image"></i> Upload Slider
            </div>
            <div class="card-body">
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
                <hr>
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <input type="file" wire:model="image" id="image"
                        class="form-control">

                        @error('image')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Link Slider</label>
                        <input type="text" wire:model="link" id="link"
                        class="form-control" placeholder="Link Slider">

                        @error('link')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
