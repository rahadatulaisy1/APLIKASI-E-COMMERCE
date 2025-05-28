<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Pest\ArchPresets\Custom;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|string',
            'product_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);
        
        Category::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required|string',
            'product_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);


        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $category->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}