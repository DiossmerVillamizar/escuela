<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
class AdminController extends Controller
{
    public function user()
    {
        //
        //where('name','like','%valor%')->orderBy('name','desc')->get(); Muestrame la letras v ordenada
        //$docente = User::where('name','>','b')->orderBy('name','desc')->paginate(5); Muestrame en mayor a menor el abecedario

        $docente = User::join('role_user', function ($join) {
            $join->on('users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id','=',2);})
            ->select('users.*')
            ->get();
        return view('admin.demo',compact('docente'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //where('name','administrador')->orderBy('name','asc')->get(); Muestrame un valor
        /*join('role_user', 'users.id', '=', 'role_user.user_id')
        ->select('users.*','role_user.role_id')
        ->get();
        Join('roles', 'users.id', '=', 'roles.id') */


        $admin = User::join('role_user', function ($join) {
            $join->on('users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id','=',1);})
            ->select('users.*')
            ->get();
        // return $admin;
        return view('admin.inicio',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::pluck('name','id');
        return view('admin.crear',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->password == $request->passwords){
            $admin = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                ]);
            $admin->roles()->attach($request->role);
            return redirect('admin');
        }
        return redirect('admin')->with('admin','fallido');
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
        return view('admin.mostrar');
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
        $role=Role::find($id);
        $admin=User::find($id);
        return view('admin.editar',compact('admin','role'));
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
        $admin = User::find($id);
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->password=bcrypt($request->password);
        $admin->save();
        $admin->roles()->attach($request->role);
        return redirect('admin/user')->with('admin','Con exito');

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
        User::destroy($id);
        return redirect('admin');
    }
}
