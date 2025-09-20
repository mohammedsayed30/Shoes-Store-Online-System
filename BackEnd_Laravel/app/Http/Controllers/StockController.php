<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariation;

class StockController extends Controller
{
    //get a stock by product id and color  and size
    public function getStock(Request $request)
    {
        // Validate the request
       $validatedData= $request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
        ]);

        // Extract the validated data
        $productId = $validatedData['product_id'];
        $color = $validatedData['color'];
        $size = $validatedData['size'];

        // Fetch the stock from the database
        $stock = ProductVariation::where('product_id', $productId)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        // Check if the stock exists
        if ($stock) {
            return response()->json($stock->stock, 200);
        } else {
            return response()->json(['error' => 'Stock not found'], 404);
        }

    }


    //store a stock by product id and color  and size
    public function storeStock(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Check if the product already has a variant with the same color and size
        $existingVariant = ProductVariation::where('product_id', $validatedData['product_id'])
            ->where('color', $validatedData['color'])
            ->where('size', $validatedData['size'])
            ->first();

        if ($existingVariant) {
            return response()->json(['error' => 'Product variant already exists'], 409);
        }
        // Validate the stock value
        if ($validatedData['stock'] < 0) {
            return response()->json(['error' => 'Stock cannot be negative'], 422);
        }

        // Extract the validated data
        $productId = $validatedData['product_id'];
        $color = $validatedData['color'];
        $size = $validatedData['size'];
        $stock = $validatedData['stock'];

        // Create a new stock entry in the database
        ProductVariation::create([
            'product_id' => $productId,
            'color' => $color,
            'size' => $size,
            'stock' => $stock,
        ]);

        return response()->json(['message' => 'Stock added successfully'], 201);
    }

    //update a stock by product id and color  and size
    public function updateStock(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Extract the validated data
        $productId = $validatedData['product_id'];
        $color = $validatedData['color'];
        $size = $validatedData['size'];
        $stock = $validatedData['stock'];

        // Fetch the stock from the database
        $existingVariant = ProductVariation::where('product_id', $productId)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        // Check if the stock exists
        if ($existingVariant) {
            // Update the stock value (increment or decrement)
            $existingVariant->stock += $stock;
            $existingVariant->save();
            return response()->json(['message' => 'Stock updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Stock not found'], 404);
        }

    }

    //delete a stock by product id and color  and size
    public function destroyStock(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
        ]);

        // Extract the validated data
        $productId = $validatedData['product_id'];
        $color = $validatedData['color'];
        $size = $validatedData['size'];

        // Fetch the stock from the database
        $stock = ProductVariation::where('product_id', $productId)
            ->where('color', $color)
            ->where('size', $size)
            ->delete();

        // Check if the stock exists
        if ($stock) {
            return response()->json(['message' => 'Stock deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Stock not found'], 404);
        }

    }

}

