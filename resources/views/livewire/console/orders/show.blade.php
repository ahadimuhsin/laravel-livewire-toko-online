<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> Detail Orders
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 25%">
                        No.Invoice
                        </td>
                        <td style="width:1%">:</td>
                        <td>
                            {{ $invoice->invoice }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nama Lengkap
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            No Telp / WA
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->phone }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kurir / Service / Cost
                        </td>
                        <td>:</td>
                        <td>
                            {{ strtoupper($invoice->courier) }} |
                            {{ $invoice->service }} - {{ money_id($invoice->cost_courier) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Provinsi
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            //ambil data json ke ruangapi
                                $response = Http::withHeaders([
                                    'accept' => 'application/json',
                                    'authorization' => env('RUANGAPI_KEY'),
                                    'content-type' => 'application/json',
                                ])->get('https://ruangapi.com/api/v1/cities', [
                                    'province' => $invoice->province
                                ]);

                                //print nama provinsi
                                echo $response['data']['province']['name'];
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kota / Kabupaten
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            //ambil data json ke ruangapi
                                $response = Http::withHeaders([
                                    'accept' => 'application/json',
                                    'authorization' => env('RUANGAPI_KEY'),
                                    'content-type' => 'application/json',
                                ])->get('https://ruangapi.com/api/v1/cities', [
                                    'province' => $invoice->province,
                                    'id' => $invoice->city
                                ]);

                                //print nama provinsi
                                echo $response['data']['results']['name'];
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kecamatan
                        </td>
                        <td>:</td>
                        <td>
                            @php
                            //ambil data json ke ruangapi
                                $response = Http::withHeaders([
                                    'accept' => 'application/json',
                                    'authorization' => env('RUANGAPI_KEY'),
                                    'content-type' => 'application/json',
                                ])->get('https://ruangapi.com/api/v1/districts', [
                                    'city' => $invoice->city,
                                    'id' => $invoice->district
                                ]);

                                //print nama provinsi
                                echo $response['data']['province']['name'];
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alamat Lengkap
                        </td>
                        <td>:</td>
                        <td>
                            {{ $invoice->address }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Total Pembelian
                        </td>
                        <td>:</td>
                        <td>
                            {{ money_id($invoice->grand_total) }}
                        </td>
                    </tr>
                </table>

                <hr>

                <table class="table" style="border-style: solid !important; border-color: rgb(198,206,214) !important;">
                <tbody>
                    @foreach($invoice->order as $order)
                    @php
                        $harga_set = $order->price * ($order->discount/100);
                        $harga_diskon = $order->price - $harga_set;
                    @endphp

                    <tr style="background: #edf2f7">
                        <td class="b-none" width="15%">
                            <div class="wrapper-image-cart">
                                <img src="{{ Storage::url('public/products/').$order->image }}"
                                style="width: 100%; border-radius: .5rem">
                            </div>
                        </td>
                        <td class="b-none">
                            <h5><b>{{ $order->product_name }}</b></h5>
                            <table class="table table-borderless" style="font-size: 14px">
                            <tr>
                                <td style="padding: .20 rem">PRICE</td>
                                <td style="padding: .20 rem">:</td>
                                <td style="padding: .20 rem"> {{ money_id($harga_diskon) }}</td>
                            </tr>

                            <tr>
                                <td style="padding: .20 rem">QTY</td>
                                <td style="padding: .20 rem">:</td>
                                <td style="padding: .20 rem"> {{ $order->unit }}</td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <a href="{{ route('orders.index') }}" class="btn btn-md btn-dark">
                    <i class="fa fa-long-arrow-alt-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
