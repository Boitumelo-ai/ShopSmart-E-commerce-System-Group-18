<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        return category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        return category::create($request->all());
    }

    public function show(category $category)
    {
        return $category;
    }

    public function update(Request $request, category $category)
    {
        $category->update($request->all());

        return $category;
    }

    public function destroy(category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}