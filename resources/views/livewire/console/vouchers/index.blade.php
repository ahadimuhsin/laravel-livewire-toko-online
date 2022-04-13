<div>
    {{-- Do your work, then step back. --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-award"></i> Vouchers
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="input-group">
                            <div class="input-group-append">
                                <a href="{{ route('vouchers.create') }}" class="btn btn-dark">
                                    <i class="fa fa-plus-circle"></i> Add Voucher
                                </a>
                            </div>
                            <input type="text" wire:model="search" placeholder="Cari nama voucher" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Voucher</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Minimal Shopping</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vouchers as $no => $voucher)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            {{ ++$no + ($vouchers->currentPage() - 1) * $vouchers->perPage() }}
                                        </th>
                                        <th>
                                            {{ $voucher->title }}
                                        </th>
                                        <th>
                                            {{ $voucher->voucher }}
                                        </th>
                                        <th class="text-right">
                                            {{ money_id($voucher->nominal_voucher) }}
                                        </th>
                                        <th class="text-right">
                                            {{ money_id($voucher->total_minimal_shopping) }}
                                        </th>
                                        <th>
                                            <a href="{{ route('vouchers.edit', $voucher->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button wire:click="destroy({{ $voucher->id }})"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </th>
                                    </tr>
                                    @empty
                                    <td colspan="6" class="text-center">Data Kosong</td>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $vouchers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
