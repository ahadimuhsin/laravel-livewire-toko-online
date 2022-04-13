<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-folder"></i> Categories
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="{{ route('categories.create') }}"
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
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $no => $category)
                            <tr>
                                <th class="text-center" scope="row">
                                    {{ ++$no + ($categories->currentPage()-1) }}
                                </th>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-primary">Edit
                                    </a>
                                    <button wire:click="destroy({{ $category->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
