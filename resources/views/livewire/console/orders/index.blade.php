<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded-lg">
                <div class="card-header">
                    <i class="fa fa-shopping-cart"></i>
                    Orders
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" wire:model="search" placeholder="Cari..."
                            class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i>Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; width: 6%">No</th>
                                    <th scope="col">No. Invoice</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" style="text-align: center; width: 17%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $no => $invoice)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($invoices->currentPage() - 1) * $invoices->perPage() }}
                                    </th>
                                    <td>{{ $invoice->invoice }}</td>
                                    <td class="text-right">
                                        {{ money_id($invoice->grand_total) }}
                                    </td>
                                    <td class="text-center">
                                        @if($invoice->status == 'pending')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-circle-notch fa-spin"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @elseif($invoice->status == 'payment_review')
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fa fa-spinner fa-spin"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @elseif($invoice->status == 'payment_invalid')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-times-circle"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @elseif($invoice->status == 'progress')
                                        <button class="btn btn-sm btn-info">
                                            <i class="fa fa-hourglass-start"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @elseif($invoice->status == 'shipping')
                                        <button class="btn btn-sm btn-primaru">
                                            <i class="fa fa-truck"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @elseif($invoice->status == 'done')
                                        <button class="btn btn-sm btn-success">
                                            <i class="fa fa-check-circle"></i>
                                            {{ $invoice->status }}
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        {{ TanggalID("j M Y", $invoice->created_at) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $invoice->id) }}"
                                        class="btn btn-sm btn-primary">
                                            <i class="fa fa-list-ul">
                                            </i>
                                        </a>
                                        <a href="{{ route('orders.status', $invoice->id) }}"
                                        class="btn btn-sm btn-success">
                                            <i class="fa fa-exchange-alt">
                                            </i>
                                        </a>
                                        <a href="{{ route('orders.receipt', $invoice->id) }}"
                                            class="btn btn-sm btn-warning">
                                                <i class="fa fa-truck">
                                                </i>
                                            </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                        {{ $invoices->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
