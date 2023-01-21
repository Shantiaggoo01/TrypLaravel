<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use App\Http\Controllers\redirect;
use Illuminate\support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Host;
use Illuminate\support\Arr;
use App\Http\Models\User;




class UsuarioController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario|ver-MenuConfiguracion|ver-MenuCompras|ver-Menuproduccion|ver-MenuReportes|ver-MenuVentas')->only('index');
        $this->middleware('permission:crear-usuario' , ['only' => ['create','store']]);
        $this->middleware('permission:editar-usuario' , ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuario' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
     {
            $users = ModelsUser::paginate();
    
            return view('usuarios.index', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        }
    

        return view('usuarios.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::pluck('name', 'name')->all();
        return view('usuarios.create', compact('role'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
// agrego esto
  public function store(Request $request)
    {
        $this->validate($request, [
            'documento' => 'required|max:12|unique:users',
            'name' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = ModelsUser::create($input);
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('usuarios.index')->with('success', 'Se registró correctamente');
    }
    /*public function store(Request $request)
    {

        $this->validate($request, [
            'documento' => 'required|unique:users',
            'name' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = ModelsUser::create();
        $user->assignRole($request->input('role'));

        return redirect()->route('usuarios.index');

    }*/

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = ModelsUser::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','roles','userRole');

        return view('usuarios.edit', compact ('user','roles','userRole'));
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
        $user = ModelsUser::find($id);
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required| email|unique:users,email,'.$id,
            'password' =>'same:confirm-password',
            'roles' => 'required',
            'image' => 'required|image',
        ]);

        

        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
        $user->update(['image' => $imagePath]);


        $input = $request->all();
        if(!empty($input['password'])){

            $input['password'] = Hash::make($input['password']);
        }else {
            $input = Arr::except($input, array('password'));

        }

        
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')->with('success', 'Se Actualizo Correctamente'); 
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

        /*ModelsUser::find($id);
        return redirect()->route('usuarios.index');*/

        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('usuarios.index')->with('success', 'Se Elimino Correctamente');
    }

    public function show($id){

        $user = ModelsUser::findOrFail($id);

        //dd($user);

        return view('usuarios.show', compact('user'));
    }
}
