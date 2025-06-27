<?php

namespace App\Http\Controllers;

use App\Models\BusinessEntity;
use Illuminate\Http\Request;

class BusinessEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businessEntity = BusinessEntity::all();
        return response()->json($businessEntity,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=>"string|required|unique:business_entities",
            "type"=>"string|required",
            "rfc"=>"string|required",
            "phone"=>"string|required",
            "address"=>"string|required",
            "email"=>"email|required",
            "active"=>"boolean|required"
        ]);

        BusinessEntity::create($validated);

        return response()->json(["message"=>"entidad comercial creada"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $businessEntities = BusinessEntity::findOrFail($id);
        return response()->json($businessEntities);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $businessEntity = BusinessEntity::findOrFail($id);

        $validated = $request->validate([
            "name"=>"string|required|unique:business_entities,name,{$id}",
            "type"=>"string|required",
            "rfc"=>"string|required",
            "phone"=>"string|required",
            "address"=>"string|required",
            "email"=>"email|required",
            "active"=>"boolean|required"
        ]);

        $businessEntity->update($validated);
        return response()->json(['message'=>'entidad comercial actualizada']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $businessEntity = BusinessEntity::findOrFail($id);

        $businessEntity->update([
            'active' => false
        ]);

        return response()->json(['message'=>'entidad comercial desactivada'],200);
    }
}
