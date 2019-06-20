<?php

namespace App\Http\Controllers;

use App\Role;
use App\Audit;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RoleImport;
use App\Exports\RoleExport;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-view')->only('index', 'getAll');
        $this->middleware('permission:role-add')->only('create', 'store');
        $this->middleware('permission:role-edit')->only('edit', 'update');
        $this->middleware('permission:role-delete')->only('destroy');
        $this->middleware('permission:role-export')->only('export');
        $this->middleware('permission:role-import')->only('show_import', 'store_import');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Role';

        return view('role.roleTable', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Role;

        return view('role.roleForm', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $model = Role::create($request->only('name'));

        if($model){
            return 'Role successfully created.';
        }

        return "Cant't create Role,try again later..";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $model = $role;

        return view('role.roleForm', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        if($role->update($request->only('name'))){
            return 'Role successfully updated.';
        }

        return "Cant't update role,try again later..";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->delete()){
            return 'Role successfully deleted.';
        }

        return "Cant't delete Role,try again later..";
    }

    public function getAll()
    {
        $model = Role::all();

        return DataTables::of($model)
                            ->addColumn('action', function($model){
                                $str = '';

                                if(auth()->user()->can('role-edit')){
                                    $str .= '<a href="'. route('role.permissions', $model->id) .'" class="btn btn-success btn-show" data-toggle="tooltip" data-placement="left" title="Role Permissions" data-title="Role Permissions"><i class="fa fa-user"></i></a>&nbsp;';

                                    $str .= '<a href="'. route('role.edit', $model->id) .'" class="btn btn-warning btn-show" data-toggle="tooltip" data-placement="bottom" title="Update Role" data-title="Update Role"><i class="fa fa-edit"></i></a>&nbsp;';
                                }

                                if(auth()->user()->can('role-delete')){
                                    $str .= '<a href="'. route('role.destroy', $model->id) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Role" data-title="Delete Role"><i class="fa fa-trash"></i></a>&nbsp;';
                                }

                                return (empty($str)) ? '<span class="label label-danger">No Action</span>' : $str;
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
    }

    public function permissions($id)
    {
        $role = Role::where('id', $id)->with(['permissions' => function($model){
            return $model->select('id');
        }])->first();

        $my_permissions = [];
        foreach($role->permissions as $val){
            $my_permissions[] = $val->id;
        }

        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('role.hasPermissions', compact('role', 'permissions', 'my_permissions'));
    }

    public function give_permissions(Request $request, $id)
    {
        $role = Role::findById($id);

        if($role->syncPermissions($request->get('name'))){
            return "Permission has been changed.";
        }

        return "Can't change Permissions,please try again later..";
    }

    public function log()
    {
        $title = 'Role Log';

        return view('role.roleLog', compact('title'));
    }

    public function logGet()
    {
        $models = Audit::where('auditable_type', 'App\Role')->with('user')->get();

        return DataTables::of($models)
                            ->addIndexColumn()
                            ->make(true);
    }

    public function show_import()
    {
        $url = route('role.store_import');

        return view('import_excel', compact('url'));
    }

    public function store_import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx'
        ]);

        $excel = Excel::import(new RoleImport, $request->file('excel')->getRealPath());

        if($excel){
            return 'Roles successfully imported.';
        }

        return "Cant't import Roles,try again later..";
    }
}
