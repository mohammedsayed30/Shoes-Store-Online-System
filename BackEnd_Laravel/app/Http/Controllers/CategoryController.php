<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    //retrieve all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    //retrieve a single category by name
    public function show($name)
    {
        $category = Category::where('name', $name)->first();
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }
    //retrieve a single category by id
    public function showById($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }
    //create a new category
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|max:255',
        ]);
        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }
    //update an existing category by name 
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'required|string|max:255',
        ]);
        $category->update($validatedData);
        return response()->json($category);
    }
    //delete a category by id
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
   
 
}
