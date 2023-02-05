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
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario|Ver-Menu-Configuracion|Ver-Menu-Compras|Ver-Menu-Produccion|ver-Menu-Reportes|Ver-Menu-Ventas')->only('index');
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = ModelsUser::create($input);
        $user->roles()->sync($request->input('roles'));

// -----------------

    // Get the image
    $image = $request->file('image');

    // Generate a unique file name
    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

    // Store the image
    $path = $image->storeAs('public/images', $fileName);

    // Get the user

    // Update the user image
    $user->image = $fileName;
    $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Se REGISTRO correctamente');
    }
   
    public function edit($id)
    {
        $user = ModelsUser::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'roles', 'userRole');

        return view('usuarios.edit', compact('user', 'roles', 'userRole'));
    }

  
    public function update(Request $request, $id)
    {
        $user = ModelsUser::find($id);
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required| email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }


        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')->with('success', 'Se ACTUALIZO Correctamente');
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

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('usuarios.index')->with('success', 'Se ELIMINO Correctamente');
    }

    public function show($id)
    {

        $user = ModelsUser::findOrFail($id);

        //dd($user);

        return view('usuarios.show', compact('user'));
    }

    // Agregado para imagend e usuario 

    // public function uploadImage(Request $request, $id)
    // {
    //     // Validate the image
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Get the image
    //     $image = $request->file('image');

    //     // Generate a unique file name
    //     $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

    //     // Store the image
    //     $path = $image->storeAs('public/images', $fileName);

    //     // Get the user
    //     $user = ModelsUser::findOrFail($id);

    //     // Update the user image
    //     $user->image = $fileName;
    //     $user->save();

    //     return redirect()->route('usuarios.index')->with('success', 'Se Agrego Correctamente');
    // }
}
