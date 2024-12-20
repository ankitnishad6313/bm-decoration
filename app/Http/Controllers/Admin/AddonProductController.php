<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddonProduct;
use Illuminate\Http\Request;

class AddonProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AddonProduct::paginate(10);
        return view('admin.addon.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            // 'image' => 'sometimes|mimes:png,jpeg,jpg,webp|dimensions:max_width=280,max_height=180,max:512',
            'price' => 'required',
            'is_popular' => 'required|boolean',
        ]);

        $category = new AddonProduct();

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            "is_popular" => $request->is_popular,
        ];

        if ($request->hasFile('image')) {
            $filePath = uploadFile($request, 'image', 'uploads/addon');
            $data['image'] = $filePath;
        }

        if ($category->create($data)) {
            return redirect()->back()->with('success', 'Addon Added Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Addon not Added!!');
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
        $data = AddonProduct::find($id);
        return view('admin.addon.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            // 'image' => 'sometimes|mimes:png,jpeg,jpg,webp|dimensions:max_width=280,max_height=180,max:512',
            'price' => 'required',
            'is_popular' => 'required|boolean',
        ]);


        $addon = AddonProduct::find($id);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            "is_popular" => $request->is_popular,
        ];

        if ($request->hasFile('image')) {
            $filePath = uploadFile($request, 'image', 'uploads/addon');
            $data['image'] = $filePath;
        }

        if ($addon->update($data)) {
            return redirect()->back()->with('success', 'Addon Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Addon not Updated!!');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addon = AddonProduct::find($id);
        if ($addon) {
            $imagePath = public_path("/uploads/addon/{$addon->image}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $addon->delete();
        }
        return back()->with('success', 'Addon Deleted.');
    }
}
