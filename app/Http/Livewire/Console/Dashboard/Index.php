<?php

namespace App\Http\Livewire\Console\Dashboard;

use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    //untuk dashboard index

    public $bulan;
    public $jumlah;
    public $count_order_year;
    public $count_order_pending_year;
    public $count_order_review_year;
    public $count_order_progress_year;
    public $count_order_shipping_year;
    public $count_order_completed_year;
    public $total_revenue_month;
    public $total_revenue_all;

    public function mount()
    {
        $year = date('Y');
        $month = date('m');

        //grafik
        $order = DB::table('invoices')
        ->addSelect(DB::raw('COUNT(id) as jumlah'))
        ->addSelect(DB::raw('MONTH(created_at) as bulan'))
        ->addSelect(DB::raw('MONTHNAME(created_at) as nama_bulan'))
        ->addSelect(DB::raw('YEAR(created_at) as tahun'))
        ->whereYear('created_at', $year)
        ->where('status', 'done')
        ->groupBy('bulan')
        ->orderByRaw('bulan ASC')
        ->get();

        if(count($order)){
            foreach($order as $hasil)
            {
                $this->bulan[] = $hasil->nama_bulan;
                $this->jumlah[] = $hasil->jumlah;
            }
        }
        else{
            $this->bulan[] = "";
            $this->jumlah[] = "";
        }

        //total order tahun ini
        $this->count_order_year = Invoice::where('status', 'done')
        ->whereYear('created_at', $year)->get()->count();

        /*
        untuk statistik
        */
        //pending
        $this->count_order_pending_year = Invoice::where('status', 'pending')
        ->whereYear('created_at', $year)->get()->count();
        //review
        $this->count_order_review_year = Invoice::where('status', 'payment-review')
        ->whereYear('created_at', $year)->get()->count();
        //progress
        $this->count_order_progress_year = Invoice::where('status', 'progress')
        ->whereYear('created_at', $year)->get()->count();
        //shipping
        $this->count_order_shipping_year = Invoice::where('status', 'shipping')
        ->whereYear('created_at', $year)->get()->count();
        //completed
        $this->count_order_completed_year = Invoice::where('status', 'done')
        ->whereYear('created_at', $year)->get()->count();

        /*
        total revenue
        */
        //month
        $this->total_revenue_month = Invoice::where('status', 'done')
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->sum('grand_total');
        //all
        $this->total_revenue_month = Invoice::where('status', 'done')
        ->sum('grand_total');
    }
    public function render()
    {
        return view('livewire.console.dashboard.index');
    }
}
