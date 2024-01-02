<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderby("id", "desc")->get();
        return view("admin.category", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "slug" => "required|string|unique:categories",
            "description" => "required|string",
        ]);
        $slug = Str::slug($request->slug);
        $category = Category::create([
            "name"=> $request->name,
            "slug"=> $slug,
            "description"=> $request->description,
            "status" => $request->status,
            ]);
        $notify = [
            'message' => 'Category created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //table
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if ($category->slug == $request->slug )
        {
            $request->validate([
                "name" => "required|string",
                "slug" => "required|string",
                "description" => "required|string",
            ]);
        }else{
            $request->validate([
                "name" => "required|string",
                "slug" => "required|string|unique:categories",
                "description" => "required|string",
            ]);
        }

        $slug = Str::slug($request->slug);
        $category->update([
            "name"=> $request->name,
            "slug"=> $slug,
            "description"=> $request->description,
            "status" => $request->status,
        ]);
        $notify = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        $notify = [
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }
}
