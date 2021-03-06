<div style="margin-top: -120px">
    <div class="container-fluid mb-lg-5 mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body p-3">
                        <h6 class="font-weight-bold">
                            <i class="fa fa-list-ul"></i>
                            Main Menu
                        </h6>
                        <hr>
                        @include('layouts.customer_menu')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow rounded-lg">
                    <div class="card-body">
                        <h6 class="font-weight-bold">
                            <i class="fa fa-shopping-cart"></i> My Orders
                        </h6>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center"
                                        style="text-align:center; width: 6%">No.</th>
                                        <th scope="col" class="text-center">Invoice</th>
                                        <th scope="col" class="text-center">Grand Total</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $no => $invoice)
                                    <tr>
                                        <th scope="row" style="text-align:center">
                                        {{ ++$no + ($invoices->currentPage() - 1) * $invoices->perPage() }}
                                        </th>
                                        <td>{{ $invoice->invoice }}</td>
                                        <td class="text-right">{{ money_id($invoice->grand_total) }}
                                        </td>
                                        <td class="text-center">
                                            @if($invoice->status == "pending")
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-circle-notch fa-spin"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @elseif($invoice->status == "payment_review")
                                            <button class="btn btn-sm btn-warning">
                                                <i class="fa fa-spinner fa-spin"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @elseif($invoice->status == "payment_invalid")
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-times-circle"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @elseif($invoice->status == "progress")
                                            <button class="btn btn-sm btn-info">
                                                <i class="fa fa-hourglass-start"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @elseif($invoice->status == "shipping")
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fa fa-truck"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @elseif($invoice->status == "done")
                                            <button class="btn btn-sm btn-success">
                                                <i class="fa fa-check-circle"></i>
                                                {{ $invoice->status }}
                                            </button>
                                            @endif
                                        </td>

                                        <td class="text-center" style="width: 20%">
                                        <a href="{{ route('customer.orders.show', $invoice->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                            class="btn btn-sm btn-primary">
                                        <i class="fa fa-list-ul"></i>
                                        </a>

                                        @if($invoice->status == "pending" or $invoice->status == "payment_invalid")
                                        <a href="{{ route('payment.index', $invoice->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Konfirmasi Pembayaran"
                                            class="btn btn-sm btn-success">
                                        <i class="fa fa-credit-card"></i>
                                        </a>
                                        @endif
                                        @if($invoice->no_resi != "")
                                        <span data-toggle="tooltip" data-placement="top" title="Tracking Order Progress">
                                            <button data-courier="{{ strtolower($invoice->courier) }}"
                                                data-resi="{{ $invoice->no_resi }}"
                                                class="btn btn-tracking btn-sm btn-primary">
                                            <i class="fa fa-truck"></i></button>
                                        </span>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                            {{ $invoices->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="tracking" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-truck"></i> Tracking Status
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <h6 class="font-weight-bold">
                        <i class="fa fa-info-circle"></i>
                    Information Shipping</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td class="w-25">Status</td>
                            <td>
                                <div class="font-weight-bold" id="status"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">No. Resi</td>
                            <td>
                                <div class="font-weight-bold" id="no_resi"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">Courier</td>
                            <td>
                                <div class="font-weight-bold" id="courier"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">Service</td>
                            <td>
                                <div class="font-weight-bold" id="service"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">Delivery To</td>
                            <td>
                                <div class="font-weight-bold" id="receiver_address"></div>
                            </td>
                        </tr>
                    </table>

                    <h6 class="font-weight-bold mt-4">
                        <i class="fa fa-truck"></i>
                        Information Status Tracking</h6>
                    <table class="table table-bordered" id="detail-tracking">

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.btn-tracking').click(function(){
            let courier = $(this).data('courier');
            let no_resi = 4(this).data('resi');
            let token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/waybill",
                data: {
                    _token: token,
                    courier: courier,
                    no_resi: no_resi
                },
                type: "post",
                dataType: "json",
                success: function(response){
                    console.log(response);

                    //append to modal
                    $("#status").html(response.data.delivery_status.status);
                    $("#no_resi").html(no_resi);
                    $("#courier").html(courier.toUpperCase());
                    $("#service").html(response.data.courier.service_code);
                    $("#receiver_address").html(response.data.waybill.receiver_address);

                    //detail
                    $.each(response.data.details, function(key, value){
                        $("#detail-tracking").append('<tr>'+
                            '<td class="w-25">'+
                            value.shipping_date + '' + value.shipping_time +
                            '</td>' +
                            '<td>'+
                                value.shipping_description  + '[' + value.city_name + ']' +
                            '</td>' +
                            '</tr>');
                    });
                    $("#tracking").modal('show');
                }
            })
        });
    });
</script>
