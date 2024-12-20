<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::paginate(10);
        return view('admin.product.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }
    public function getSubCategory(Request $request)
    {
        $data = SubCategory::where('category_id', $request->cat_id)->get();
        return response()->json(['data' => $data, 'status' => 200 ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'sometimes|exists:sub_categories,id',
            'title' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'product_slug' => 'required|string|unique:products,product_slug',
            'thumb_img' => 'sometimes|mimes:png,jpeg,jpg,webp',
            'images.*' => 'sometimes|mimes:png,jpeg,jpg,webp',
            'price' => 'required|min:1',
            'discount_percentage' => 'sometimes|numeric',
            'inclusion' => 'sometimes|array',
            'exclusion' => 'sometimes|array',
            'status' => 'required|in:Active,Inactive',
            'is_trending' => 'required|boolean',
            'is_popular' => 'required|boolean',
        ]);
        $data = [
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'title' => $request->title,
            'name' => $request->name,
            'product_slug' => $request->product_slug,
            "price" => $request->price,
            "discount_percentage" => $request->discount_percentage,
            "discount_price" => discountPrice($request->price, $request->discount_percentage),
            "inclusion" => $request->inclusion,
            "exclusion" => $request->exclusion,
            'status' => $request->status,
            "is_trending" => $request->is_trending,
            "is_popular" => $request->is_popular,
            "description" => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description
        ];

        if ($request->hasFile('thumb_img')) {
            $filePath = uploadFile($request, 'thumb_img', 'uploads/products');
            $data['thumb_img'] = $filePath;
        }

        if ($product = Product::create($data)) {
            if ($request->hasFile('images')) {
                $filePaths = uploadMultipleFile($request, $request->file('images'), 'uploads/products');
                foreach ($filePaths as $key => $value) {
                    $img_data = ['product_id' => $product->id, 'image' => $value];
                    ProductImage::create($img_data);
                }
            }
            return redirect()->back()->with('success', 'Product Added Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Product not Added!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);
        return view('admin.product.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::find($id);
        $category = Category::all();
        $subcategory = SubCategory::where('category_id', $data->category_id)->get();
        return view('admin.product.edit', compact('data', 'category', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'sometimes|exists:sub_categories,id',
            'title' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'product_slug' => 'required|string|unique:products,product_slug,' . $id,
            'thumb_img' => 'sometimes|mimes:png,jpeg,jpg,webp',
            'images.8' => 'sometimes|mimes:png,jpeg,jpg,webp',
            'price' => 'required|numeric|min:1',
            'discount_percentage' => 'sometimes|numeric',
            'inclusion' => 'sometimes|array',
            'exclusion' => 'sometimes|array',
            'status' => 'required|in:Active,Inactive',
            'is_trending' => 'required|boolean',
            'is_popular' => 'required|boolean',
        ]);

        $product = Product::find($id);

        $data = [
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'title' => $request->title,
            'name' => $request->name,
            'product_slug' => $request->product_slug,
            "price" => $request->price,
            "discount_percentage" => $request->discount_percentage,
            "discount_price" => discountPrice($request->price, $request->discount_percentage),
            "inclusion" => $request->inclusion,
            "exclusion" => $request->exclusion,
            'status' => $request->status,
            "is_trending" => $request->is_trending,
            "is_popular" => $request->is_popular,
            "description" => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description
        ];

        if ($request->hasFile('thumb_img')) {
            $filePath = uploadFile($request, 'thumb_img', 'uploads/products');
            $data['thumb_img'] = $filePath;
        }

        if ($product->update($data)) {
            if ($request->hasFile('images')) {
                $filePaths = uploadMultipleFile($request, $request->file('images'), 'uploads/products');
                foreach ($filePaths as $key => $value) {
                    $img_data = ['product_id' => $product->id, 'image' => $value];
                    ProductImage::create($img_data);
                }
            }
            return redirect()->back()->with('success', 'Product Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Product not Updated!!');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        Order::where('product_id', $id)->delete();
        return back()->with('success', 'Product Deleted.');
    }


    public function checkSlug(Request $request)
    {
        $data = Product::where('product_slug', $request->product_slug)->first();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'product not found'], 404);
        }
    }

    public function deleteProductImage(Request $request)
    {
        $product = ProductImage::find($request->id);
        if ($product) {
            $imagePath = public_path("/uploads/products/{$product->image}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $product->delete();
        }
        return response()->json(['Image has been Deleted'], 200);
    }
}
