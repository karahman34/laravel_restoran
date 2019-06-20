<?php

namespace App\Http\Controllers;

use App\Masakan;
use App\detOrder;
use App\Http\Requests\MasakanRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Audit;

class MasakanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-view')->only('index', 'getAll');
        $this->middleware('permission:user-add')->only('create', 'store');
        $this->middleware('permission:user-edit')->only('edit', 'update');
        $this->middleware('permission:user-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Masakan::all();

        $title = "Masakan";

        return view('masakan.masakanTable', compact('title', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Masakan();

        return view('masakan.masakanForm', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MasakanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasakanRequest $request)
    {
        $img_path = $request->file('image')->store('img/masakans', 'public');

        $data = $request->all();
        $data['image'] = $img_path;

        $model = Masakan::create($data);

        if($model){
            return 'Masakan Berhasil ditambahkan.';
        }

        return 'Masakan gagal ditambahkan.';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Masakan::where('id', $id)->first();
        $title = $model->nama_masakan;

        return view('masakan.masakanDetail', compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Masakan::where('id', $id)->first();

        return view('masakan.masakanForm', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MasakanRequest  $request
     * @param  \App\Masakan $masakan
     * @return \Illuminate\Http\Response
     */
    public function update(MasakanRequest $request, Masakan $masakan)
    {
        $data = $request->all();

        if($request->hasFile('image')){
            Storage::disk('public')->delete($masakan->image);

            $img_path = $request->file('image')->store('img/masakans', 'public');
            $data['image'] = $img_path;
        }

        if($masakan->update($data)){
            return 'Masakan berhasil dirubah.';
        }

        return 'Masakan gagal dirubah.';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Masakan::find($id);
        $path = public_path('img/masakan'.$model->image);

        if(unlink($path)){
            if($model->delete()){
                return "Masakan berhasil didelete.";
            }
        }
    }

    public function search($key = null)
    {
        $key = strtolower($key);
        $models = Masakan::whereRaw("lower(nama_masakan) LIKE '%$key%' ")
                            ->where('status_masakan', 1)
                            ->orderBy('id', 'DESC')
                            ->paginate(6);

        return view('_feed', compact('models'));
    }

    public function getAll()
    {
        $model = Masakan::query();

        return DataTables::of($model)
                            ->addColumn('action', function($model){
                                $str = '';

                                if(auth()->user()->can('masakan-edit')){
                                    $str .= '<a href="'. route('masakan.edit', $model->id) .'" class="btn btn-warning btn-show" data-toggle="tooltip" data-placement="bottom" title="Update Makanan" data-title="Update Makanan"><i class="fa fa-edit"></i></a> &nbsp;';
                                }

                                if(auth()->user()->can('masakan-delete')){
                                    $str .= '<a href="'. route('masakan.destroy', $model->id) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Makanan" data-title="Delete Makanan"><i class="fa fa-trash"></i></a>';
                                }

                                return (empty($str)) ? '<span class="label label-danger">No Action</span>' : $str;
                            })
                            ->editColumn('nama_masakan', function($model){
                                return ucwords($model->nama_masakan);
                            })
                            ->editColumn('image', function($model){
                                return '<img src="'. asset('storage/'.$model->image) .'" alt="'.$model->nama_masakan.'" height="95"></img>';
                            })
                            ->editColumn('status_masakan', function($model) {
                                if($model->status_masakan == 1){
                                    return '<span class="label label-success">Ready</span>';
                                } else {
                                    return '<span class="label label-danger">Empty</span>';
                                }
                            })
                            ->editColumn('harga', function($model){
                                return 'Rp.'. number_format($model->harga,0,',','.');
                            })
                            ->rawColumns(['action', 'image', 'status_masakan'])
                            ->addIndexColumn()
                            ->make(true);
    }

    public function chart()
    {
        $model = detOrder::join('masakans', 'detail_orders.masakan_id', 'masakans.id')
                            ->select(\DB::raw('sum(detail_orders.jumlah) AS jumlah_masakan'), 'nama_masakan')
                            ->orderBy('jumlah_masakan', "DESC")
                            ->groupBy("masakan_id")
                            ->get();

        return $model;
    }

    public function log()
    {
        $title = 'Masakan Log';

        return view('masakan.masakanLog', compact('title'));
    }

    public function logGet()
    {
        $models = Audit::where('auditable_type', 'App\Masakan')->with('user')->get();

        return DataTables::of($models)
                            ->addIndexColumn()
                            ->make(true);
    }
}
