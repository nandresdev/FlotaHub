<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AgregarUsuarioRequest;
use App\Http\Requests\EditarUsuarioRequest;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuarios = User::all();
        return view("web.usuarios.listadoUsuario", [
            "usuarios" => $usuarios
        ]);
    }

    public function create()
    {
        return view('web.usuarios.agregarUsuario');
    }

    public function store(AgregarUsuarioRequest $request)
    {
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
    
        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $usuario->foto_perfil = 'img/' . $filename;
        }
    
        $usuario->save();
    
        return response()->json($usuario);
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        return view('web.usuarios.editarUsuario', [
            "usuario" => $usuario
        ]);
    }

    public function update(EditarUsuarioRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->estado = $request->input('estado');
    
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->input('password'));
        }
    
        if ($request->hasFile('foto_perfil')) {
            if ($usuario->foto_perfil && file_exists(public_path($usuario->foto_perfil))) {
                unlink(public_path($usuario->foto_perfil));
            }
            $file = $request->file('foto_perfil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $usuario->foto_perfil = 'img/' . $filename;
        }
    
        $usuario->save();
    
        return response()->json($usuario);
    }
    

    public function destroy(User $usuario)
    {
        $nombre = $usuario->name; 
        $usuario->delete();
        return response()->json(['estado' => 'eliminado', 'nombre' => $nombre], 200);
    }
}
