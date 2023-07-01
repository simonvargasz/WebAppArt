<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Perfil;
use App\Models\Imagen;
use Illuminate\Support\Facades\Hash;
use Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CuentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'logout', 'register', 'store', 'validateLogin', 'validateRegister']);
    }

    //login, register y logout
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = $request->user;
        $password = $request->password;
        if (Auth::attempt(['user' => $user, 'password' => $password])) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['credentials' => 'Credenciales inválidas'])->onlyInput('user');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
    //register
    public function register()
    {
        $perfiles = Perfil::all();
        return view('public/register', compact('perfiles'));
    }

    public function store(Request $requestRegister)
    {
        $this->validateRegister($requestRegister);

        $user = $requestRegister->user;
        $nombre = $requestRegister->nombre;
        $apellido = $requestRegister->apellido;
        $password = $requestRegister->password;
        $perfil = 2;

        $cuenta = new Cuenta();
        $cuenta->user = $user;
        $cuenta->nombre = $nombre;
        $cuenta->apellido = $apellido;
        $cuenta->password = Hash::make($password);
        $cuenta->perfil_id = $perfil;
        $cuenta->save();

        return redirect()->route('user.login');
    }
    
    public function show($user)
    {
        $cuenta = Cuenta::where('user', $user)->first();
        $user = Auth::user();
        return view('session/session', compact('cuenta', 'user'));
    }

    public function changePassword(Request $request)
    {
        //Cambiar contrasena de usuario
        $user = Auth::user();
        $actualPassword = $request->actualPassword;
        $newPassword = $request->newPassword;

        //validate
        $request->validate([
            'actualPassword' => 'required|string',
            'newPassword' => 'required|string|min:6',
        ], [
            'actualPassword.required' => 'La contraseña actual es requerida',
            'newPassword.required' => 'La nueva contraseña es requerida',
            'newPassword.min' => 'La nueva contraseña debe tener al menos 6 caracteres',
        ]);

        if (Hash::check($actualPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            Session::flash('message', 'Contraseña cambiada correctamente');
            return redirect()->route('session');
        } else {
            return back()->withErrors(['actualPassword' => 'Contraseña actual incorrecta']);
        }
        

    }


    public function index()
    {
        $user = Auth::user();
        return view('session/session', compact('user'));
    }

    public function destroy($id)
    {
        $archivo = Imagen::find($id)->archivo;
        //$archivo = public_path('images/' . $archivo); -> Funciona pero por ahora no lo usare

        //if (File::exists($archivo)) {
            //File::delete($archivo);
        //}

        $imagen = Imagen::find($id);
        $imagen->delete();

        return redirect()->back()->with('message', 'Imagen eliminada correctamente');
    }
    public function update(Request $request,$id)
    {
        
        $imagen = Imagen::find($id);
        $imagen->titulo = $request->titulo;
        $imagen->save();

        return redirect()->back()->with('message', 'Titulo cambiado correctamente');
    }

    public function showUsers()
    {
        $cuentas = Cuenta::where('perfil_id', '2')->get();
        $admins = Cuenta::where('perfil_id', '1')->get();
        return view('admin/users', compact('cuentas', 'admins'));
    }
    
    public function updateUser(Request $banRequest, $user)
    {
        if ($user == Auth::user()->user) {
            return redirect()->back()->withErrors(['ban' => 'No puedes banearte a ti mismo']);
        }


        $cuenta = Cuenta::where('user', $user)->first();
        $cuenta->eliminado = $banRequest->eliminado;
        $cuenta->save();

        $imagenes = Imagen::where('cuenta_user', $user)->get();
        foreach ($imagenes as $imagen) {
            $imagen->baneada = $banRequest->eliminado;
            $imagen->motivo_ban = 'Usuario baneado';
            $imagen->save();
        }

        return redirect()->back()->with('message', 'Usuario actualizado correctamente');
    }


    public function editUser(Request $requestEdit, $user)
    {
        //validar
        $requestEdit->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
        ]);

        $cuenta = Cuenta::where('user', $user)->first();
        $cuenta->nombre = $requestEdit->nombre;
        $cuenta->apellido = $requestEdit->apellido;
        $cuenta->save();

        return redirect()->back()->with('message', 'Usuario actualizado correctamente');
    }









    //Validaciones de login, register, logout y forgotPassword
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'user' => [
                'required',
                'string',
                Rule::exists('cuentas')->where(function ($query) {
                    $query->where('eliminado', 0);
                }),
            ],
            'password' => 'required|string',
        ], [
            'user.required' => 'El usuario es requerido',
            'password.required' => 'La contraseña es requerida',
            'user.exists' => 'Tu cuenta ha sido eliminada',
        ]);
    }
    protected function validateRegister(Request $requestRegister)
    {
        $requestRegister->validate([
            'user' => 'required|string|unique:cuentas',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'user.required' => 'El usuario es requerido',
            'user.unique' => 'Nombre de usuario no disponible',
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El apellido es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);
    }

}
