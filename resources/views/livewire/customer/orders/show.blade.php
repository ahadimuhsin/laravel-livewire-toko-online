<div style="margin-top: -120px">
    <div class="container-fluid mb-lg-5 mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body p-3">
                        <h6 class="font-weight-bold">
                            <i class="fa fa-list-ul">
                            </i>
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
                            <i class="fa fa-shopping-cart">
                            </i>
                            My Orders
                        </h6>
                            <hr>
                            <table class="table table-bordered">
                                <tr>
                                   <td style="width: 25%">No. Invoice</td>
                                   <td style="width:1%">:</td>
                                   <td>{{ $invoice->invoice }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%">Nama Lengkap</td>
                                    <td style="width:1%">:</td>
                                    <td>{{ $invoice->name }}</td>
                                 </tr>
                                 <tr>
                                    <td style="width: 25%">No Telp / WA</td>
                                    <td style="width:1%">:</td>
                                    <td>{{ $invoice->phone }}</td>
                                 </tr>
                                 <tr>
                                    <td style="width: 25%">Kurir / Service / Cost</td>
                                    <td style="width:1%">:</td>
                                    <td>{{ strtoupper($invoice->courier) }} |
                                    {{ $invoice->service }} - {{ money_id($invoice->cost_courier) }}</td>
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
                                                'key' => env('RAJAONGKIR_API_KEY'),
                                                'content-type' => 'application/json',
                                            ])->get('https://api.rajaongkir.com/starter/province?id='.$invoice->province.'');

                                            //print nama provinsi
                                            // dd($response['rajaongkir']['results']['province']);
                                            echo $response['rajaongkir']['results']['province'];
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
                                                'key' => env('RAJAONGKIR_API_KEY'),
                                                'content-type' => 'application/json',
                                            ])->get('https://api.rajaongkir.com/starter/city?id='.$invoice->city.'&province='.$invoice->province.'');

                                            //print nama kota
                                            // dd($response['rajaongkir']['results']);
                                            echo $response['rajaongkir']['results']['city_name'];
                                        @endphp
                                    </td>
                                </tr>
                                {{-- <tr>
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
                                </tr> --}}
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
                    </div>

                    <div class="card mt-4 border-0 shadow rounded-lg">
                        <div class="card-body">
                            <h6 class="font-weight-bold"><i class="fa fa-shopping-cart"></i>
                            Detail Order</h6>
                            <hr>

                            <table class="table" style="border-style: solid !important;
                            border-color: rgb(198, 206, 214) !important;">
                            <tbody>
                                @foreach($invoice->order as $order)
                                @php
                                    $harga_set = $order->price * ($order->discount / 100);
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
                                    <table class="table-borderless" style="font-size: 14px">
                                        <tr>
                                            <td style="padding:.20rem">Price</td>
                                            <td style="padding:.20rem">:</td>
                                            <td style="padding:.20rem">{{ money_id($harga_diskon) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:.20rem">Quantity</td>
                                            <td style="padding:.20rem">:</td>
                                            <td style="padding:.20rem">{{ $order->unit_weight }} {{ $order->unit }}</td>
                                        </tr>
                                    </table>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>

                            <a href="{{ route('customer.orders') }}" class="btn btn-dark btn-md">
                            <i class="fa fa-long-arrow-alt-left"></i>
                            Kembali</a>

                            @if($invoice->status == "pending")
                            <a href="{{ route('payment.index', $invoice->invoice) }}" class="btn btn-dark btn-md">
                            Konfirmasi Pembayaran</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Stop trying to control. --}}
</div>
