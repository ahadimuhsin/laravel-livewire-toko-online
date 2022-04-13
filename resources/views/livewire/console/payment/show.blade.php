<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-credit-card"></i> Detail Payment
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 20%">
                            No.Invoice
                            </td>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $payment->invoice }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Nama Lengkap
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            No. Telp / WA
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Transfer Dari Bank
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->bank_transfer_from }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Transfer Ke Bank
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->bank_transfer_to }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Atas Nama
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->from_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Total Transfer
                            </td>
                            <td>:</td>
                            <td>
                                {{ money_id($payment->total) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Tanggal Transfer
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->transfer_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Catatan
                            </td>
                            <td>:</td>
                            <td>
                                {{ $payment->note }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Bukti Transfer
                            </td>
                            <td>:</td>
                            <td class="text-center">
                                <img src="{{ Storage::url('public/payments/').$payment->image }}"
                                style="width: 300px">
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('payments.index') }}" class="btn btn-md btn-dark shadow">
                        <i class="fa fa-long-arrow-alt-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
