<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slider::paginate(10);
        return view('admin.slider.list', compact('data'));
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
            'image' => 'required',
        ]);

        $data = [
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            $filePath = uploadFile($request, 'image', 'uploads/slider');
            $data['image'] = $filePath;
        }

        if(Slider::create($data)){
            return redirect()->back()->with('success', 'Slider Uploaded.');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $imagePath = public_path("/uploads/slider/{$slider->image}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $slider->delete();
        }
        return back()->with('success', 'Slider has been Deleted.');            
    }
}
