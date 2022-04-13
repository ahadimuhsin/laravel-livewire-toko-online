<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Invoice;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    //
    protected $API_KEY = 'bde360fb1f7ec2eb275da40b81bf4347';
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'key' => $this->API_KEY,
            // 'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get All Provinces',
            'data'    => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'key' => $this->API_KEY,
            // 'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json'
        ])->get('https://api.rajaongkir.com/starter/city?&province='.$request->province.'');

        $cities = $response['rajaongkir']['results'];

        return response()->json([
            'success' => true,
            'message' => 'Get City By ID Provinces : '.$request->province,
            'data'    => $cities
        ]);
    }

    public function getDistricts(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            // 'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json'
        ])->get('https://dev.farizdotid.com/api/daerahindonesia/kecamatan', [
            'id_kota' => $request->city
        ]);

        return $response;
    }

    public function getShipping(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            // 'authorization' => env('RUANGAPI_KEY'),
            'key' => $this->API_KEY,
            'content-type' => 'application/json'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin'            => 113,
            'destination'       => $request->destination,
            'weight'            => $request->weight,
            'courier'           => $request->courier
        ]);

        return $response['rajaongkir']['results'];
    }

    public function getWayBill(Request $request)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => env('RUANGAPI_KEY'),
            'content-type' => 'application/json'
        ])->post('https://ruangapi.com/v1/waybill', [
            'waybill' => $request->no_resi,
            'courier' => $request->courier
        ]);

        return $response;
    }

    public function checkVoucher(Request $request)
    {
        $voucher = Voucher::where('voucher', $request->voucher)->first();
        if($voucher){
            return response()->json([
                'success' => true,
                'data' => $voucher
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
            ], 200);
        }
    }

    public function checkout(Request $request)
    {
        //buat nomor invoice
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length ; $i++){
            $random .= rand(0,1) ? rand(0,9) : chr(rand(ord('a'), ord('z')));
        }
        $invoice = 'INVOICE-'.Str::upper($random);
        $data_invoice = Invoice::create([
            'invoice' => $invoice,
            'customer_id' => auth()->guard('customer')->user()->id,
            'courier' => $request->courier,
            'service' => $request->service,
            'cost_courier' => $request->cost,
            'weight' => $request->weight,
            'name' => $request->name,
            'phone' => $request->phone,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'address' => $request->address,
            'note' => $request->note,
            'grand_total' => $request->grand_total + rand(10,99),
            'status' => 'pending'
        ]);

        //masukkan ke pesanan product
        foreach(Cart::get()['products'] as $cart)
        {
            $harga_set = $cart->price * ($cart->discount / 100);
            $harga_diskon = $cart->price - $harga_set;

            $data_invoice->order()->create([
                'invoice' => $invoice,
                'product_id' => $cart->id,
                'product_name' => $cart->title,
                'image' => $cart->image,
                'unit' => $cart->unit,
                'unit_weight' => $cart->unit_weight,
                'price' => $harga_diskon
            ]);

        }

        Cart::clear();

        return response()->json([
            'success' => true,
            'data' => $data_invoice
        ], 201);
    }
}
