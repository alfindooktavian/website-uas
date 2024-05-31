<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EventController extends Controller
{
    /**
     * Constructor to apply middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['events.index', 'events.create', 'events.edit', 'events.delete'])) {
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
        $events = Event::latest()
            ->when(request()->q, function ($query) {
                $query->where('title', 'like', '%' . request()->q . '%');
            })
            ->paginate(10);

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
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
            'content' => 'required',
            'location' => 'required',
            'date' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');
        $originalSlug = $slug;
        $counter = 1;

        // Generate unique slug
        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $event = Event::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date,
        ]);

        return $event
            ? redirect()->route('admin.events.index')->with('success', 'Data Berhasil Disimpan!')
            : redirect()->route('admin.events.index')->with('error', 'Data Gagal Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'date' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');
        $originalSlug = $slug;
        $counter = 1;

        // Generate unique slug if it has changed
        if ($event->slug != $slug) {
            while (Event::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $event->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date,
        ]);

        return $event
            ? redirect()->route('admin.events.index')->with('success', 'Data Berhasil Diupdate!')
            : redirect()->route('admin.events.index')->with('error', 'Data Gagal Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'status' => $event ? 'success' : 'error',
        ]);
    }
}
