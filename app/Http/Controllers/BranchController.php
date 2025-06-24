<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();

        return response()->json($branches,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:50|required|unique:branches,name',
            'address' => 'string|max:255',
            'phone' => 'string|max:255',
            'city'  => 'string|max:50|required'
        ]);

        Branch::create($validated);

        return response()->json(['message'=>'sucursal creada']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branch::findOrFail($id);
        return response()->json($branch,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $branch = Branch::findOrFail($id);
        $validated = $request->validate([
            'name' => "string|max:50|required|unique:branches,name,{$id}",
            'address' => 'string|max:255',
            'phone' => 'string|max:255',
            'city'  => 'string|max:50|required'
        ]);

        $branch->update($validated);
        return response()->json(['message'=>'sucursal actualizada'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return response()->json(['message'=>'sucursal eliminada']);
    }
}
