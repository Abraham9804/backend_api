<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return $permissions;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|max:255|string|unique",
            "description" => "nullable|string",
            "subject" => "nullable|string",
            "action" => "nullable|string"
        ]);

        Permission::create($validated);
        return response()->json(['message'=>'permiso creado']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $permission = Permission::findOrFail($id);
        $validated = $request->validate([
            "name" => "required|max:255|string|unique:permissions,name,{$id}",
            "description" => "nullable|string",
            "subject" => "nullable|string",
            "action" => "nullable|string"
        ]);

        $permission->update($validated);
        return response()->json(['message'=>'permiso editado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
