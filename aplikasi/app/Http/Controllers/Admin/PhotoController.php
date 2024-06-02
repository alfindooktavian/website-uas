<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['photos.index', 'photos.create', 'photos.edit', 'photos.delete'])) {
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
        $photos = Photo::latest()->when(request()->q, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.photo.index', compact('photos'));
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
            'caption' => 'required',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath);

        $photo = Photo::create([
            'image' => $imageName,
            'caption' => $request->input('caption'),
        ]);

        if ($photo) {
            return redirect()->route('admin.photos.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('admin.photos.index')->with('error', 'Data Gagal Disimpan!');
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
        $photo = Photo::findOrFail($id);
        $imagePath = 'public/images/' . $photo->image;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $photo->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
    
}
