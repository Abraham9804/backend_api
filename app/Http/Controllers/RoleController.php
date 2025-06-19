<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        Gate::authorize('visualizar');
        $roles = Role::with(['permission'])->get();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:roles,name',
            'description' => 'required'
        ]);

        Role::create($validated);
        return response()->json(['message'=>'Rol creado']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol = Role::findOrFail($id);

        return response()->json($rol);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rol = Role::findOrFail($id);
        $validated = $request->validate([
            'name' => "required|max:50|unique:roles,name,{$id}",
            'description' => 'required'
        ]);

        $rol->update($validated);
        return response()->json(['message'=>'rol actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message'=>'rol eliminado']);
    }

    public function assingPermission(Request $request, $id){
        $role = Role::findOrFail($id);
        $role->permission()->sync($request['permission_id']);
        return response()->json(['message'=>'permiso actualizado']);
    }
}
