<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Agregamos

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\support\Facades\DB;

class RolController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol')->only('index');
        $this->middleware('permission:crear-rol' , ['only' => ['create','store']]);
        $this->middleware('permission:editar-rol' , ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-rol' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('roles.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $permission =  Permission::get();
         return view('roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles', 
            'permission' => 'required'
            ] );
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('success', 'Se REGISTRO Con Exito');;

    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $role = DB::table('roles')->where('id',$id)->first();
        if ($role->name == 'Administrador') {
            return redirect()->route('roles.index')->with('error', 'No se puede Editar el rol de administrador');
        } 

       
       $permission = Permission::get();
       $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
       ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
       ->all();

       return view('roles.edit', compact('role','permission','rolePermissions'));
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

        $this->validate($request, ['name' => 'required', 'permission' => 'required'] );
        $role = Role::find($id);
        $role -> name= $request->input('name');
        $role ->save();

        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('success', 'Se ACTUALIZO  Con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = DB::table('roles')->where('id',$id)->first();
    if ($role->name == 'Administrador') {
        return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol de administrador');
    }

        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success', 'Se ELIMINO Con Exito');;
    }
}
