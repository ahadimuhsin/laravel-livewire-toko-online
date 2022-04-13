<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-folder"></i> Product
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="{{ route('products.create') }}"
                            class="btn btn-dark">
                                <i class="fa fa-plus-circle"></i>
                                Tambah
                            </a>
                        </div>
                        <input type="text" wire:model="search" placeholder="Cari ..."
                        class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit">
                                <i class="fa fa-search"></i>
                                Cari
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $no =>$product)
                            <tr>
                                <th class="text-center" scope="row">
                                    {{ ++$no + ($products->currentPage()-1) }}
                                </th>
                                <td>{{$product->title }}</td>
                                <td>{{$product->category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.edit',$product->id) }}"
                                        class="btn btn-sm btn-primary">Edit
                                    </a>
                                    <button wire:click="destroy({{$product->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <td colspan="4" class="text-center">Data Kosong</td>
                            @endforelse
                        </tbody>
                    </table>
                    {{$products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
