<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function funLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:50'
        ]);

        if(!Auth::attempt($credentials))
        {
            return response()->json(["message"=>"credenciales incorrectas"]);
        }

        $token = $request->user()->createToken('Auth token')->plainTextToken;

        $user = $request->user();
        $permissions = [];
        if(count($user->role)>0){
            $permissions = $user->role()
                            ->with('permission')
                            ->get()
                            ->pluck('permission')
                            ->flatten()
                            ->map(function($permiso){
                                return array(['id'=>$permiso->id,'name'=>$permiso->name]);
                            });
        }
        return response()->json(["token"=>$token, "user"=>$request->user(),'permisos'=> $permissions]);
    }

    public function funRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:50',
            'password2' =>  'required|same:password'
        ]);

        User::create($validated);
        return response()->json(["message"=>"usuario registrado"]);
    }

    public function funPerfil(Request $request)
    {
        $perfil = $request->user();
        return response()->json($perfil,200);
    }

    public function funLogout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(["message"=>"sesion cerrada"]);
    }
}
