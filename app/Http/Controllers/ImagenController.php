<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Cuenta;

class ImagenController extends Controller
{
    public function index()
    {
        $imagenes = Imagen::all();
        $cuentas = Cuenta::all();
        $artistas = Cuenta::where('perfil_id', '2')->get();
        return view('public/home', compact('imagenes','cuentas','artistas'));
    }
    public function redirect()
    {
        return redirect()->route('home');
    }
    public function show($user)
    {   
        
        $imagenes = Imagen::where('cuenta_user', $user)->get();
        $artistas = Cuenta::where('perfil_id', '2')->get();
        return view('public/filtered', compact('imagenes','artistas'));
    }

    public function store(Request $imageUploadRequest, $user)
    {
        $this->validate($imageUploadRequest, [
            'titulo' => 'required',
            'archivo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $imageUploadRequest->file('archivo');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);

        $imagen = new Imagen();
        $imagen->titulo = $imageUploadRequest->titulo;
        $imagen->archivo = $imageName;
        $imagen->cuenta_user = $user;
        $imagen->save();

        if ($imagen->save()) {
            return redirect()->route('home')->with('success', 'Imagen subida correctamente');
        }
        else {
            return redirect()->route('session')->with('error', 'Error al subir la imagen');
        }
    }

    public function update(Request $requestBan, $id)
    {

        
        $this->validate($requestBan, [
            'baneada' => 'required',
            'motivo_ban' => 'required_if:baneada,1',
        ], [
            'motivo_ban.required_if' => 'El motivo es obligatorio si se banea la imagen',
        ]);

        //No se puede desbanear una imagen si el usuario esta baneado
        if($requestBan->baneada == 0){
            $imagen = Imagen::find($id);
            $cuenta = Cuenta::where('user', $imagen->cuenta_user)->first();
            if($cuenta->eliminado == 1){
                return redirect()->route('home')->withErrors([
                    'imageUnban' => 'No se puede desbanear una imagen si el usuario esta baneado',
                ]);
            }
        }


        $imagen = Imagen::find($id);
        $imagen->baneada = $requestBan->baneada;
        if($requestBan->baneada == 0){
            $imagen->motivo_ban = null;
        }
        else{
            $imagen->motivo_ban = $requestBan->motivo_ban;
        }



        $imagen->save();
        return redirect()->route('home')->with('success', 'Imagen actualizada correctamente');
    }
}
