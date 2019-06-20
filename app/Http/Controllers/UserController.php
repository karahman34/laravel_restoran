<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Audit;

class UserController extends Controller
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
        $title = 'User';
        $models = User::all();

        return view('user.userTable', compact('title', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new User;
        $roles = Role::all();

        return view('user.userForm', compact('model', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar')->store('img/avatars', 'public');
        }

        $model = User::create([
            'nama_user' => $request->get('nama_user'),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
            'avatar' => $avatar,
        ]);

        $model->assignRole($request->get('roles'));

        if($model){
            return 'User berhasil ditambahkan.';
        }

        return 'User gagal ditambahkan.';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $model = $user;
        $roles = Role::all();

        return view('user.userForm', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->except('avatar', 'password');

        if($request->has('password') && $request->get('password') != ""){
            $data['password'] = bcrypt($request->get('password'));
        }

        if($request->hasFile('avatar')){
            Storage::disk('public')->delete($user->avatar);

            $avatar = $request->file('avatar')->store('img/avatars', 'public');
            $data['avatar'] = $avatar;
        }

        if($request->has('roles') && $request->get('roles') != ""){
            $user->syncRoles($request->get('roles'));
        }

        if($user->update($data)){
            return "User berhasil diupdate.";
        }

        return "User gagal diupdate.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Storage::disk('public')->delete($user->avatar)){
            if($user->delete()){
                return 'User berhasil dihapus.';
            } else {
                return 'User gagal dihapus.';
            }
        }
    }

    public function getAll()
    {
        $model = User::with('roles')->get();

        return DataTables::of($model)
                            ->addColumn('action', function($model){
                                $str = '';

                                if(auth()->user()->can('user-edit')){
                                    $str .= '<a href="'. route('user.edit', $model->id) .'" class="btn btn-warning btn-show" data-toggle="tooltip" data-placement="bottom" title="Update User" data-title="Update User"><i class="fa fa-edit"></i></a> &nbsp;';
                                }

                                if(auth()->user()->can('user-delete')){
                                    $str .= '<a href="'. route('user.destroy', $model->id) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete User" data-title="Delete User"><i class="fa fa-trash"></i></a>';
                                }

                                return (empty($str)) ? '<span class="label label-danger">No Action</span>' : $str;
                            })
                            ->editColumn('avatar', function($model){
                                return '<img src="'. asset('storage/'.$model->avatar) .'" alt="'.$model->nama_user.'" height="95"></img>';
                            })
                            ->editColumn('roles', function($model){
                                $str = '';
                                foreach($model->roles as $role){
                                    $str .= '<span class="label label-success">'. $role->name .'</span>&nbsp;';
                                }

                                return $str;
                            })
                            ->rawColumns(['action', 'avatar', 'roles'])
                            ->addIndexColumn()
                            ->make(true);
    }

    public function log()
    {
        $title = 'User Log';

        return view('user.userLog', compact('title'));
    }

    public function logGet()
    {
        $models = Audit::where('auditable_type', 'App\User')->with('user')->get();

        return DataTables::of($models)
                            ->addIndexColumn()
                            ->make(true);
    }
}
