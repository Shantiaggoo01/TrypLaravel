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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;




class UsuarioController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario|Ver-Menu-Configuracion|Ver-Menu-Compras|Ver-Menu-Produccion|ver-Menu-Reportes|Ver-Menu-Ventas')->only('index');
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $userId = $request->route()->parameter('id');
            $user = Auth::user();
    
            if ($user->id != $userId) {
                abort(403, 'User does not have the right permissions.');
            }
    
            return $next($request);
        })->only('edit', 'update');
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
            'documento' => 'required|numeric|min:10|unique:users',
            'name' => ['required', 'regex:/^[\pL\s]+$/u'],
            'apellido' => ['required', 'regex:/^[\pL\s]+$/u'],
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image']);
        }

        $user = ModelsUser::create($input);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('usuarios.index')->with('success', 'Se agregó correctamente');
    }

    public function edit($id)
    {

        $user = Auth::user();

        if (Auth::check()) {
            $user = ModelsUser::findOrFail($id);
            if (Auth::user()->id == $user->id) {
                return view('usuarios.edit', compact('user'));
            } else {
                abort(403, 'User does not have the right permissions.');
            }
        } else {
            return redirect('login');
        }

        
        $user = ModelsUser::find($id);
        // Verifica si el usuario es el superadministrador
        if ($user->hasRole('Administrador')) {

            return redirect()->back()->with('error', 'No puedes editar al super administrador');
        }

        if ($user->hasRole('Empleado')) {

            return redirect()->back()->with('error', 'No puedes editar al empleado predetermindado');
        }

        $selectedRoles = $user->roles()->pluck('id')->toArray();

        $user = ModelsUser::find($id);
        $roles = Role::pluck('name', 'name')->all();



        unset($roles['Administrador']);
        $selectedRoles = $user->roles()->pluck('name')->toArray();

        $userRole = $user->roles->pluck('name', 'roles', 'userRole');

        return view('usuarios.edit', compact('user', 'roles', 'userRole', 'selectedRoles'));
    }

    public function update(Request $request, $id)
    {
        $user = ModelsUser::find($id);

        // Continúa con la edición del usuario
        $this->validate($request, [
            'name' => ['required', 'regex:/^[\pL\s]+$/u'],
            'apellido' => ['required', 'regex:/^[\pL\s]+$/u'],
            'email' => 'required| email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            //'roles' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        // Subir la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $input['image'] = $name;
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        $user->save();

        Session::flash('success', 'Se actualizó correctamente');
        return redirect()->route('usuarios.index');
    }

    // Codigo Original 
    //     public function update(Request $request, $id)
    //     {

    //         $user = ModelsUser::find($id);
    //         // Continúa con la edición del usuario
    //         $this->validate($request, [
    //             'name' => ['required', 'regex:/^[\pL\s]+$/u'],
    //             'apellido' => ['required', 'regex:/^[\pL\s]+$/u'],
    //             'email' => 'required| email|unique:users,email,' . $id,
    //             'password' => 'same:confirm-password',
    //             'roles' => 'required',
    //         ]);

    //         $input = $request->all();
    //         if (!empty($input['password'])) {

    //             $input['password'] = Hash::make($input['password']);
    //         } else {
    //             $input = Arr::except($input, array('password'));
    //         }


    //         $user->update($input);
    //         DB::table('model_has_roles')->where('model_id', $id)->delete();

    //         $user->assignRole($request->input('roles'));

    //         if ($request->hasFile('image')) {
    //             // Get the current image
    //             $currentImage = $user->image;

    //             // Get the new image
    //             $image = $request->file('image');

    //             // Generate a unique file name
    //             $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

    //             // Store the new image
    //             $path = $image->storeAs('public/images', $fileName);

    //             // Update the user image
    //             $user->image = $fileName;

    //             // Delete the current image
    //             Storage::delete("public/images/$currentImage");
    //         }

    //         $user->save();

    //         Session::flash('success', 'Se Actualizó Correctamente');
    //         return redirect()->route('usuarios.index');
    //     }


    public function destroy($id)
    {
        $user = ModelsUser::findOrFail($id);

        // Verifica si el usuario es el superadministrador
        if ($user->hasRole('Administrador')) {
            return redirect()->back()->with('error', 'No puedes eliminar al super administrador');
        } else

        

        if ($user->hasRole('Empleado')) {

            return redirect()->back()->with('error', 'No puedes eliminar al empleado predetermindado');
        } else {

            // Elimina la asociación de roles del usuario
            $user->roles()->detach();

            // Elimina al usuario
            $deleteSuccessful = $user->delete();

            if ($deleteSuccessful) {
                Session::flash('success', 'Se eliminó correctamente');
                return redirect()->route('usuarios.index');
            } else {
                Session::flash('error', 'Hubo un problema al eliminar');
                return redirect()->back();
            }
        }
    }

    public function show($id)
    {

        $user = ModelsUser::findOrFail($id);

        //dd($user);

        return view('usuarios.show', compact('user'));
    }

    // esto es el visualizar perfil 

    public function showUser($id)
    {

        $user = ModelsUser::findOrFail($id);

        //dd($user);

        return view('usuarios.showPerfil', compact('user'));
    }

    // Agregado para imagend e usuario // con este controlador se soluciona el problema de la imagen 

    //     public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'documento' => 'required|numeric|min:10|unique:users',
    //         'name' => ['required', 'regex:/^[\pL\s]+$/u'],
    //         'apellido' => ['required', 'regex:/^[\pL\s]+$/u'],
    //         'telefono' => 'required|numeric',
    //         'direccion' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|same:confirm-password',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $input = $request->all();
    //     $input['password'] = Hash::make($input['password']);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $input['image'] = $image->getClientOriginalName();
    //         $destinationPath = public_path('/images');
    //         $image->move($destinationPath, $input['image']);
    //     }

    //     $user = ModelsUser::create($input);
    //     $user->roles()->sync($request->input('roles'));

    //     return redirect()->route('usuarios.index')->with('success', 'Se Agrego Correctamente');
    // }

    public function showperfil($id)
    {

        $user = ModelsUser::findOrFail($id);

        //dd($user);

        return view('usuarios.showperfil', compact('user'));
    }

}
