<?php

namespace App\Http\Controllers;

use App\Order;
use App\detOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:order-view')->only('index', 'rekap');
        $this->middleware('permission:order-add')->only('store');
        $this->middleware('permission:order-edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Order::where('status_order', 0)->with(['detail_orders' => function($query){
            $query->select('id', 'order_id', 'status_detail_order');
        }]);

        if(request()->has('no_meja')){
            $query->where('no_meja', request()->get('no_meja'));
        }

        $models = $query->get();

        $status_order_1 = 0;
        foreach($models as $model){
            foreach($model->detail_orders as $val){
                if($val->status_detail_order == 1){
                    $status_order_1 += 1;
                }
            }
        }

        $title = 'Detail Order';

        return view('order.orderTable', compact('title', 'models', 'status_order_1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty(session('cart')))
        {
            return redirect()->back()->with('warning', 'Anda belum memesan apapun.');
        }

        if (!empty(session('status')))
        {
            $order = Order::where('status_order', 0)->where('no_meja', $request->get('no_meja'))->first();
            foreach(session('cart') as $ses)
            {
                detOrder::create([
                    'order_id' => $order->id,
                    'masakan_id' => $ses->id,
                    'keterangan' => $ses->keterangan,
                    'jumlah' => $ses->jumlah
                ]);
            }
            session()->forget('cart');

            return back()->with('success', 'Terimakasih telah memesan,masakan akan segera tiba di meja anda.');
        }
        else
        {
            $order = Order::create([
                'no_meja' => $request->get('no_meja'),
                'user_id' => Auth::id(),
            ]);

            foreach(session('cart') as $ses)
            {
                detOrder::create([
                    'order_id' => $order->id,
                    'masakan_id' => $ses->id,
                    'keterangan' => $ses->keterangan,
                    'jumlah' => $ses->jumlah
                ]);
            }
            $request->session()->put('status', 'menunggu');
            session()->forget('cart');

            return back()->with('success', 'Terimakasih telah memesan,masakan akan segera tiba di meja anda.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::select('no_meja', 'created_at', 'id')->where('id', $id)->first();
        $models = Order::join('detail_orders', 'orders.id', 'detail_orders.order_id')
                        ->join('masakans', 'detail_orders.masakan_id', 'masakans.id')
                        ->select('nama_masakan', 'harga', 'jumlah', 'detail_orders.created_at', 'detail_orders.id', 'status_detail_order')
                        ->where('orders.id', $id)
                        ->where('status_order', 0)
                        ->get();

        return view('order.orderDetail', compact('order', 'models'));
    }

    public function rekap()
    {
        $title = 'Rekap Order';

        return view('order.orderRekap', compact('title'));
    }

    public function rekap_dttb()
    {
        $models = Order::with('user')->get();

        return DataTables::of($models)
                        ->editColumn('status_order', function($model){
                            if($model->status_order == 1){
                                return '<span class="label label-success">Beres</span>';
                            } else {
                                return '<span class="label label-danger">Belum Beres</span>';
                            }
                        })
                        ->addIndexColumn()
                        ->rawColumns(['status_order'])
                        ->make(true);
    }

    public function print($id)
    {
        $models = Order::join('detail_orders', 'orders.id', 'detail_orders.order_id')
                            ->join('masakans', 'detail_orders.masakan_id', 'masakans.id')
                            ->select('orders.id', 'masakans.nama_masakan', 'masakans.harga', 'detail_orders.jumlah', 'orders.status_order', 'orders.created_at', 'orders.user_id')
                            ->where('orders.id', $id)
                            ->get();
        $title = 'Print Bon';

        return view('order.orderPrint', compact('models', 'title'));
    }
}
