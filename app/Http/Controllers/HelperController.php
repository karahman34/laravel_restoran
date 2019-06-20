<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function canExport(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $condition = auth()->user()->can($request->get('context')."-export");

        return response()->json($condition, 200);
    }
}
