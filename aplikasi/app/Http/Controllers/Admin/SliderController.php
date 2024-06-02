<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['sliders.index', 'sliders.create', 'sliders.edit', 'sliders.delete'])) {
                abort(403, 'This action is unauthorized.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->when(request()->q, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('public/sliders');
        $imageName = basename($imagePath);

        $slider = Slider::create([
            'image' => $imageName,
        ]);

        if ($slider) {
            return redirect()->route('admin.sliders.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('admin.sliders.index')->with('error', 'Data Gagal Disimpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete image from storage
        Storage::delete('public/sliders/' . $slider->image);

        // Delete slider record
        $slider->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}


