<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cetak()
    {
        $detail_transaksi = DB::table('detail_transaksi')
                    ->where('transaksi_id', 1)
                    ->get();
        
        $transaksi = DB::table('transaksi')
                    ->where('id', 1)
                    ->first();

        // dd($transaksi->total_harga);

        foreach($detail_transaksi as $barang) {
            $item = Item::find($barang->item_id);

            $barang->item_id = $item->nama_item;

        }
        
        $pdf = PDF::loadView('cetak', ['detail_transaksi' => $detail_transaksi, 'total_harga' => $transaksi->total_harga, 'cash' => $transaksi->cash, 'kembali' => $transaksi->kembali, 'no_transaksi' => $transaksi->id, 'date' => date("F jS, Y", strtotime("now"))])->setPaper('a4', 'potrait');

        return $pdf->stream("cetak.pdf");

    }
}
