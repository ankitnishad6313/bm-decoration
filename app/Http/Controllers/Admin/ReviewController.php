<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Review::orderBy('id', 'desc')->paginate(15);
        return view('admin.review.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.review.add',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'star' => 'required|numeric|min:1|max:5',
            'comment' => 'required'
        ]);

        $review = $request->all();
        $review['user_id'] = auth()->user()->id;
        
        if(Review::create($review)){
            return redirect()->back()->with('success', 'Review Created');
        }else{
            return redirect()->back()->with('error', 'Review not Created');
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
        $data = Review::find($id);
        $products = Product::all();
        return view('admin.review.edit', compact('data', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'star' => 'required|numeric|min:1|max:5',
            'comment' => 'required'
        ]);
        
        if(Review::find($id)->update($request->all())){
            return redirect()->back()->with('success', 'Review Updated');
        }else{
            return redirect()->back()->with('error', 'Review not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Review::find($id)->delete();
        return redirect()->back()->with('success', 'Review deleted');
    }
}
