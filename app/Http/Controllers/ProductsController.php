<?php

namespace App\Http\Controllers;

use App\Models\AddonProduct;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $category_slug, $sub_category_slug = null, $city_slug = null)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        $query = Product::query();
        $title = null;

        $query->where('category_id', $category->id);

        if ($sub_category_slug != null) {
            $sub_category_id = SubCategory::where('sub_category_slug', $sub_category_slug)->first()->id;
            $query->where('sub_category_id', $sub_category_id);
        }
        
        $sort = $request->input('sort');
        if($sort != null){
            if ($sort == 'high-to-low') { // Price: High to Low
                $query->orderBy('price', 'DESC');
            } elseif ($sort == 'low-to-high') { // Price: Low to High
                $query->orderBy('price', 'ASC');
            } else {
                $query->orderBy('popularity', 'DESC'); // Assuming `popularity` is a column
            }
        }

        $products = $query->where('status', 'Active')->get();
        return view('products', compact('products', 'category', 'title'));
    }
    public function detail(Request $request, $product_slug)
    {
        $product = Product::where('product_slug', $product_slug)->first();
        $similar_products = Product::where('category_id', $product->category_id)->limit(20)->get();
        $addon = AddonProduct::all();
        return view('decoration-details', compact('product', 'similar_products', 'addon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        //
    }

    public function cityDecoration(Request $request, $city_slug = null)
    {
        $sliders = Slider::where('status', 'Active')->get();
        $category = Category::where('status', 'Active')->get();

        if ($city_slug != null) {
            $city = City::where('city_slug', $request->city_slug)->first();
        }

        $products = Product::where('status', 'Active')->limit(20)->get();

        return view('city-detail', compact('city', 'products', 'sliders', 'category'));
    }
}
