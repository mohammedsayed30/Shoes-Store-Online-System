<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    //get all products
    public function index()
    {
            $page = request()->get('page', 1);
            // Build a unique cache key per page
            $cacheKey = "products:page:{$page}";

            // Cache the paginated result in Redis for 10 minutes
            $products = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return Product::paginate(20);
            });

            // Return the cached (or freshly queried) paginated products
            return response()->json($products);
    }
    //get product by id
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    //get product by name
    public function showByName($name)
    {
        $product = Product::where('name', $name)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    //create product
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    //update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->update($request->all());
        return response()->json($product);
    }
    //delete product        
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
