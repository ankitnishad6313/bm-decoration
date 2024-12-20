<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = City::paginate(10);
        return view('admin.city.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'phone' => 'required|digits:10',
            'image' => 'required',
            'city_slug' => 'required|string|unique:cities,city_slug',
            'is_popular' => 'required|boolean',
            'is_menu' => 'required|boolean',
            'status' => 'required|in:Active,Inactive',
            'map' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'city' => $request->city,
            'phone' => $request->phone,
            'city_slug' => $request->city_slug,
            'is_popular' => $request->is_popular,
            'is_menu' => $request->is_menu,
            'status' => $request->status,
            'map' => $request->map,
            'description' => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description
        ];

        if ($request->hasFile('image')) {
            $filePath = uploadFile($request, 'image', 'uploads/city');
            $data['image'] = $filePath;
        }

        if (City::create($data)) {
            return redirect()->back()->with('success', 'City Added Successfully!!');
        } else {
            return redirect()->back()->with('error', 'City not Added!!');
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
        $data = City::find($id);
        return view('admin.city.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'city' => 'required|string|max:50|unique:cities,city,'. $id,
            'phone' => 'required|digits:10',
            'city_slug' => 'required|string|unique:cities,city_slug,'. $id,
            'is_popular' => 'required|boolean',
            'is_menu' => 'required|boolean',
            'status' => 'required|in:Active,Inactive',
            'map' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'city' => $request->city,
            'phone' => $request->phone,
            'city_slug' => $request->city_slug,
            'is_popular' => $request->is_popular,
            'is_menu' => $request->is_menu,
            'status' => $request->status,
            'map' => $request->map,
            'description' => $request->description,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description
        ];

        if ($request->hasFile('image')) {
            $filePath = uploadFile($request, 'image', 'uploads/city');
            $data['image'] = $filePath;
        }

        if (City::find($id)->update($data)) {
            return redirect()->back()->with('success', 'City Updated Successfully!!');
        } else {
            return redirect()->back()->with('error', 'City not Updated!!');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::find($id)->delete();
        return back()->with('success', 'City Deleted.');
    }


    public function checkSlug(Request $request)
    {
        $data = City::where('city_slug', $request->city_slug)->first();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'City not found'], 404);
        }
    }
}
