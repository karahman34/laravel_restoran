<?php

namespace App\Http\Controllers;

use App\Order;
use App\detOrder;
use App\Masakan;
use Illuminate\Http\Request;

class detOrderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:detail_order-edit')->only('status');
    }

    public function status(Request $request)
    {
        $request->validate(['ids' => 'required']);

        $detOrder = detOrder::whereIn('id', $request->get('ids'));

        $detOrder->update([
            'status_detail_order' => 1
        ]);

        session()->flash('success', 'Data Berhasil Dirubah.');
    }
}
