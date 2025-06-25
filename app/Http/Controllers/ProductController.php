<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = isset($request->limit)?$request->limit:'2';
        $warehouse = isset($request->warehouse)?$request->warehouse:'';
        $products = Product::orderby('id','asc');    
        if(isset($request->search)){
            $products = Product::where("name","LIKE","%$search%")
                                ->orwhere("description","LIKE","%$search%")
                                ->orderby('id','asc');  
        }
        if(isset($warehouse)){
            $products = $products->whereHas('warehouse',function($query) use($warehouse){
                $query->where('warehouse_id',$warehouse);
            });
        }
    
                         
        

        $products = $products->with(['category','warehouse'])->paginate($limit);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200|min:3',
            'description' => 'nullable|string|max:1000',
            'bar_code' => 'nullable|string|max:100|unique:products,bar_code',
            'umc' => 'nullable|string|max:50',
            'manufacturer_name' => 'nullable|string|max:100',
            'category_id' => 'required|integer|exists:categories,id',
            'sale_price' => 'required|decimal:2|min:0.00',
            'min_stock' => 'required|integer|min:0',
            'url_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'active' => 'required|boolean'
        ]);

        if($request->hasFile('url_image')){
            $path = $request->file('url_image')->store('products','public');
            $validated['url_image'] = $path;
        }

        Product::create($validated);

        return response()->json(["message"=>"producto creado"]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:200|min:3',
            'description' => 'nullable|string|max:1000',
            "bar_code" => "nullable|string|max:100|unique:products,bar_code,{$id}",
            'umc' => 'nullable|string|max:50',
            'manufacturer_name' => 'nullable|string|max:100',
            'category_id' => 'required|integer|exists:categories,id',
            'sale_price' => 'required|decimal:2|min:0.00',
            'min_stock' => 'required|integer|min:0',
            'url_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'active' => 'required|boolean'
        ]);

        if($request->hasFile('url_image')){
            $path = $request->file('url_image')->store('products','public');
            $validated['url_image'] = $path;
        }

        $product->update($validated);
        return response()->json(["message"=>"Producto Actualizado","producto"=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(["message"=>"producto eliminado"]);
    }
}
