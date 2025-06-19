<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        
        $limit = $request->input('limit',2);
        //$users = User::orderBy('id','asc')->paginate($limit);
        $search = $request->search;
        if(isset($search)){
            $users = User::where('name','LIKE',"%$search%")->orderBy('id','asc');
        }else{
            $users = User::orderBy('id','asc');
        }

        $users = $users->with('role')->paginate($limit);
       
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:50,confirmed'
        ]);

        User::create($validated);

        return response()->json(['message'=>'usuario creado']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message'=>'usuario eliminado']);
    }

    public function assingRoles(Request $request, $id){
        $user = User::findOrFail($id);
        $user->role()->sync($request['roles_id']);

        return response()->json(['message'=>'roles actualizados']);
    }
}
