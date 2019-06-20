<?php

namespace App\Http\Controllers;

use DB;
use App\Order;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:transaksi-view')->only('index', 'search', 'rekap');
        $this->middleware('permission:transaksi-add')->only('store');
        $this->middleware('permission:transaksi-edit')->only('edit', 'update');
        $this->middleware('permission:transaksi-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Order::join('detail_orders', 'orders.id', 'detail_orders.order_id')
                            ->join('masakans', 'detail_orders.masakan_id', 'masakans.id')
                            ->select('orders.id', 'orders.no_meja', 'masakans.nama_masakan', 'detail_orders.jumlah', 'masakans.harga', DB::raw('harga*jumlah as total'))
                            ->where('orders.status_order', 0)
                            ->get();
        $hartot = 0;
        $bayar = false;
        $title = 'Kasir';

        return view('transaksi.transaksiTable', compact('title', 'models', 'hartot', 'bayar'));
    }

    public function search(Request $request)
    {
        $models = Order::join('detail_orders', 'orders.id', 'detail_orders.order_id')
                            ->join('masakans', 'detail_orders.masakan_id', 'masakans.id')
                            ->select('orders.id', 'orders.no_meja', 'masakans.nama_masakan', 'detail_orders.jumlah', 'masakans.harga', DB::raw('harga*jumlah as total'))
                            ->where('orders.status_order', 0)
                            ->where('orders.no_meja', $request->get('no_meja'))
                            ->get();
        $bayar = true;
        $hartot = 0;
        foreach ($models as $model)
        {
            $hartot += $model->total;
        }
        $title = 'Transaksi';

        return view('transaksi.transaksiTable', compact('title', 'models', 'hartot', 'bayar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tran = Transaksi::create([
            'user_id' => Auth::id(),
            'order_id' => $request->get('order_id'),
            'total_bayar' => $request->get('total_bayar'),
        ]);

        if ($tran)
        {
            Order::find($request->get('order_id'))->update([
                'status_order' => 1
            ]);

            $request->session()->flash('success', 'Pembayaran berhasil dilakukan.');
            return redirect()->route('transaksi.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rekap()
    {
        $title = 'Rekap Transaksi';

        return view('transaksi.transaksiRekap', compact('title'));
    }

    public function rekap_dttb()
    {
        $models = Transaksi::with('user')->get();

        return DataTables::of($models)
                            ->editColumn('total_bayar', function($model){
                                return "Rp. " . number_format($model->total_bayar ,0,',','.');
                            })
                            ->addIndexColumn()
                            ->make(true);
    }
}
