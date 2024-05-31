<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['videos.index', 'videos.create', 'videos.edit', 'videos.delete'])) {
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
        $videos = Video::latest()->when(request()->q, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'embed' => 'required',
        ]);

        $video = Video::create([
            'title' => $request->input('title'),
            'embed' => $request->input('embed'),
        ]);

        if ($video) {
            return redirect()->route('admin.videos.index')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->route('admin.videos.index')->with('error', 'Data Gagal Disimpan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Video $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'embed' => 'required',
        ]);

        $video->update([
            'title' => $request->input('title'),
            'embed' => $request->input('embed'),
        ]);

        if ($video) {
            return redirect()->route('admin.videos.index')->with('success', 'Data Berhasil Diupdate!');
        } else {
            return redirect()->route('admin.videos.index')->with('error', 'Data Gagal Diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['status' => 'success']);
    }
}
