<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Masakan;
use Illuminate\Support\Facades\Auth;

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
        $title = 'Dashboard';
        $new_order = Order::where('status_order', 0)->count();
        $total_masakan = Masakan::count();
        $total_user = User::count();

        return view('admin.home', compact('title', 'new_order', 'total_masakan', 'total_user'));
    }

    public function welcome()
    {
        $models = Masakan::where('status_masakan', '1')->orderBy('id', "DESC")->paginate(8);
        $title = 'Makan enak dan kenyang bersama kami!';
        $orders = Order::join('detail_orders', 'orders.id', 'detail_orders.order_id')
                        ->select('detail_orders.status_detail_order')
                        ->where('orders.status_order', 0)
                        ->where('user_id', Auth::id())
                        ->get();
        $menunggu = false;

        foreach($orders as $order){
            if ($order->status_detail_order == 0){
                $menunggu = true;
                break;
            }
        }

        return view('welcome', compact('title', 'models', 'menunggu'));
    }

    public function category()
    {
        $title = 'Category';
        $models = Masakan::where('status_masakan', 1)->get();

        return view('category', compact('title', 'models'));
    }
}
