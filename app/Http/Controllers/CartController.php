<?php

namespace App\Http\Controllers;

use App\Masakan;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:cart-view')->only('index');
        $this->middleware('permission:cart-add')->only('store');
        $this->middleware('permission:cart-edit')->only('edit', 'update');
        $this->middleware('permission:cart-delete')->only('destroy');
    }

    public function index()
    {
        $title = 'Keranjang';
        $hartot = 0;

        if (!empty($ses= session()->get('cart')))
        {
            foreach($ses as $s)
            {
                $hartot += $s->jumlah*$s->harga;
            }
        }


        return view('cart.cartIndex', compact('title', 'hartot'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        if($this->checkIfItemExists($id)){
            session()->flash('warning', 'Pesanan sudah ada didalam keranjang.');

            return redirect()->back();
        }

        $model = Masakan::where('id', $id)->first();
        $model->keterangan = $request->get('keterangan');
        $model->jumlah = $request->get('jumlah');

        session()->push('cart', $model);
        session()->flash('success', 'Pesanan berhasil dimasukan kedalam keranjang!');

        return redirect('/');
    }

    public function edit($id)
    {
        $model = '';

        foreach(session('cart') as $cart){
            if($cart['id'] == $id){
                $model = $cart;
                break;
            }
        }

        return view('cart.cartForm', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['jumlah' => 'required']);

        $ses = array_values(session()->get('cart'));
        session()->forget('cart');
        session(['cart' => $ses]);
        $ses = session()->get('cart');

        for ($i=0; $i < count($ses); $i++){
            if (!empty($ses[$i]))
            {
                if ($ses[$i]['id'] == $id)
                {
                    $data = $ses[$i];
                    $data['jumlah'] = $request->get('jumlah');
                    $data['keterangan'] = $request->get('keterangan');

                    session()->forget('cart.' . $i);
                    session()->push('cart', $data);
                    session()->flash('success', 'Item berhasil diupdate.');
                    break;
                }
            }
        }
    }

    public function destroy($id)
    {
        $ses = array_values(session()->get('cart'));
        session()->forget('cart');
        session(['cart' => $ses]);
        $ses = session()->get('cart');

        for ($i=0; $i < count($ses); $i++){
            if (!empty($ses[$i]))
            {
                if ($ses[$i]['id'] == $id)
                {
                    session()->forget('cart.' . $i);
                    session()->flash('success', 'Item telah berhasil dihapus dari keranjang anda.');
                    break;
                }
            }
        }
    }

    private function checkIfItemExists($id)
    {
        if(!is_array($ses = session('cart'))){
            return false;
        } else {
            foreach($ses as $cart){
                if($cart['id'] == $id){
                    return true;
                }
            }
        }

        return false;
    }
}
