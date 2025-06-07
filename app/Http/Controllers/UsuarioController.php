<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function funListar(){
        $users = User::get();
        return $users;
    }

    public function funGuardar(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:50,confirmed'
        ]);

        User::create($validated);

        return response()->json(['message'=>'usuario creado']);
    }

    public function funMostrar($id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function funModificar($id, Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user = User::findOrFail($id);

        if(!empty($validated['password'])){
            $validated['password'] = bcrypt($validated['password']);
        }else{
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(["message"=>"usuario actualizado"]);
    }

    public function funEliminar($id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message'=>'usuario eliminado']);
    }
}
