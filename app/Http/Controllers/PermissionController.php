<?php

namespace App\Http\Controllers;

use App\Audit;
use App\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-view')->only('index', 'getAll');
        $this->middleware('permission:permission-add')->only('create', 'store');
        $this->middleware('permission:permission-edit')->only('edit', 'update');
        $this->middleware('permission:permission-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Permissions';

        return view('permission.permissionTable', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Permission;

        return view('permission.permissionForm', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $model = Permission::create($request->only('name'));

        if($model){
            return 'Permission successfully created.';
        }

        return "Cant't create Permission,try again later..";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $model = $permission;

        return view('permission.permissionForm', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        if($permission->update($request->only('name'))){
            return 'Permission successfully updated';
        }

        return "Cant't update Permission,try again later..";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if($permission->delete()){
            return 'Permission successfully deleted';
        }

        return "Cant't delete Permission,try again later..";
    }

    public function getAll()
    {
        $model = Permission::orderBy('name', 'ASC')->get();

        return DataTables::of($model)
                            ->addColumn('action', function($model){
                                $str = '';

                                if(auth()->user()->can('permission-edit')){
                                    $str .= '<a href="'. route('permission.edit', $model->id) .'" class="btn btn-warning btn-show" data-toggle="tooltip" data-placement="bottom" title="Update Permission" data-title="Update Permission"><i class="fa fa-edit"></i></a> &nbsp;';
                                }

                                if(auth()->user()->can('permission-delete')){
                                    $str .= '<a href="'. route('permission.destroy', $model->id) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Permission" data-title="Delete Permission"><i class="fa fa-trash"></i></a>';
                                }

                                return (empty($str)) ? '<span class="label label-danger">No Action</span>' : $str;
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
    }

    public function log()
    {
        $title = 'Permission Log';

        return view('permission.permissionLog', compact('title'));
    }

    public function logGet()
    {
        $models = Audit::where('auditable_type', 'App\Permission')->with('user')->get();

        return DataTables::of($models)
                            ->addIndexColumn()
                            ->make(true);
    }
}
