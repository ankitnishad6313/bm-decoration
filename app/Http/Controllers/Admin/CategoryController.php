<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::paginate(10);
        return view('admin.category.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'cat_name' => 'required|string|max:50',
            'category_slug' => 'required|string|unique:categories,category_slug',
            'cat_image' => 'sometimes|mimes:png,jpeg,jpg,webp|dimensions:max_width=280,max_height=180,max:512',
            'status' => 'required|in:Active,Inactive',
            'is_trending' => 'required|boolean',
            'is_popular' => 'required|boolean',
            'is_menu' => 'required|boolean',
            'description' => 'required',
        ]);

        $category = new Category();

        $data = [
            'title' => $request->title,
            'cat_name' => $request->cat_name,
            'category_slug' => $request->category_slug,
            'status' => $request->status,
            "is_trending" => $request->is_trending,
            "is_popular" => $request->is_popular,
            "is_menu" => $request->is_menu,
            "description" => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description,
        ];

        if ($request->hasFile('cat_image')) {
            $filePath = uploadFile($request, 'cat_image', 'uploads/categories');
            $data['cat_image'] = $filePath;
        }

        if ($category->create($data)) {
            return redirect()->back()->with('success', 'Category Added Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Category not Added!!');
        }
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
        $data = Category::find($id);
        return view('admin.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'cat_name' => 'required|string|max:50',
            'category_slug' => 'required|string|unique:categories,category_slug,' . $id,
            'cat_image' => 'sometimes|mimes:png,jpeg,jpg,webp|dimensions:max_width=280,max_height=180',
            'status' => 'required|in:Active,Inactive',
            'is_trending' => 'required|boolean',
            'is_popular' => 'required|boolean',
            'is_menu' => 'required|boolean',
            'description' => 'required',
        ]);

        $category = Category::find($id);

        $data = [
            'title' => $request->title,
            'cat_name' => $request->cat_name,
            'category_slug' => $request->category_slug,
            'status' => $request->status,
            "is_trending" => $request->is_trending,
            "is_popular" => $request->is_popular,
            "is_menu" => $request->is_menu,
            "description" => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description,
        ];

        if ($request->hasFile('cat_image')) {
            $filePath = uploadFile($request, 'cat_image', 'uploads/categories');
            $data['cat_image'] = $filePath;
        }

        if ($category->update($data)) {
            return redirect()->back()->with('success', 'Category Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Category not Updated!!');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $orders = $category->products->flatMap->orders;
        foreach ($orders as $key => $value) {
            Order::find($value->id)->delete();
        }
        SubCategory::where('category_id', $id)->delete();
        Product::where('category_id', $id)->delete();
        $category->delete();
        
        return back()->with('success', 'Category Deleted.');
    }


    public function checkSlug(Request $request)
    {
        $data = Category::where('category_slug', $request->category_slug)->first();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
