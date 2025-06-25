<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branch = isset($request->branch)?$request->branch:'';
        if($branch){
            $warehouse = Warehouse::where('branch_id',$branch)->get();
        }else{
            $warehouse = Warehouse::all();
        }

        return response()->json([$warehouse],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:100|unique:warehouses',
            'code' => 'string|max:100|unique:warehouses',
            'description' => 'string|nullable',
            'branch_id' => 'integer'
        ]);

        Warehouse::create($validated);
        return response()->json(['message'=>'almacen creado'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse = Warehouse::findOrFail($id)->with('branch')->get();
        return response()->json([$warehouse],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $warehouse = Warehouse::findOrFail($id);
        $validated = $request->validate([
            'name' => "string|max:100|unique:warehouses,name,{$id}",
            'code' => "string|max:100|unique:warehouses,code,{$id}",
            'description' => 'string|nullable',
            'branch_id' => 'integer'
        ]);

        $warehouse->update($validated);
        return response()->json(['message'=>'producto actualizado'],200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return response()->json(['message'=>'almacen eliminado'],200);
    }
}
