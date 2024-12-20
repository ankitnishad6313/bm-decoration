<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SubCategory::paginate(10);
        return view('admin.subcategory.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.subcategory.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'sub_cat_name' => 'required|string|max:50',
            'sub_category_slug' => 'required|string|unique:sub_categories,sub_category_slug',
            'status' => 'required|in:Active,Inactive',
        ]);

        if (SubCategory::create($request->all())) {
            return redirect()->back()->with('success', 'Sub Category Added Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Sub Category not Added!!');
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
        $category = Category::all();
        $data = SubCategory::find($id);
        return view('admin.subcategory.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'sub_cat_name' => 'required|string|max:50',
            'sub_category_slug' => 'required|string|unique:sub_categories,sub_category_slug,' .$id,
            'status' => 'required|in:Active,Inactive',
        ]);

        if (SubCategory::find($id)->update($request->all())) {
            return redirect()->back()->with('success', 'Sub Category Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Sub Category not Updated!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::find($id);
        $orders = $subcategory->products->flatMap->orders;
        foreach ($orders as $key => $value) {
            Order::find($value->id)->delete();
        }
        Category::where('sub_category_id', $id)->delete();
        Product::where('sub_category_id', $id)->delete();
        $subcategory->delete();
        return back()->with('success', 'Sub Category has been Deleted.');
    }


    public function checkSlug(Request $request)
    {
        $data = SubCategory::where('subcategory_slug', $request->subcategory_slug)->first();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }
    }
}
