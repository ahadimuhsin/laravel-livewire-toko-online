<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-credit-card"></i>
                Payment
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" wire:model="search"
                        class="form-control" placeholder="Cari sesuatu ...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa fa-search"></i>Search
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center; width: 6%;">
                                No.
                                </th>
                                <th scope="col">NO. Invoice</th>
                                <th scope="col">Grand Total</th>
                                <th scope="col">Date</th>
                                <th scope="col" style="text-align: center; width: 15%;">
                                Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $no => $payment)
                            <tr>
                                <th scope="row" style="text-align: center">
                                {{ ++$no + ($payments->currentPage() - 1) * $payments->perPage() }}</th>
                            </tr>
                            <td>{{ $payment->invoice }}</td>
                            <td class="text-right">{{ money_id($payment->total) }}</td>
                            <td>{{ TanggalID("j M Y", $payment->created_at) }}</td>
                            <td class="text-center">
                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-list-ul"></i></a>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
