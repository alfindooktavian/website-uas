<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PostController extends Controller
{
    /**
     * Constructor to apply middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['posts.index', 'posts.create', 'posts.edit', 'posts.delete'])) {
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
        $posts = Post::latest()
            ->when(request()->q, function ($query) {
                $query->where('title', 'like', '%' . request()->q . '%');
            })
            ->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.post.create', compact('tags', 'categories'));
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
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title' => 'required|unique:posts',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        // Assign tags
        $post->tags()->attach($request->tags);

        return $post
            ? redirect()->route('admin.post.index')->with('success', 'Data Berhasil Disimpan!')
            : redirect()->route('admin.post.index')->with('error', 'Data Gagal Disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'content' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // Remove old image
            Storage::disk('local')->delete('public/posts/' . $post->image);

            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post->image = $image->hashName();
        }

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        // Sync tags
        $post->tags()->sync($request->tags);

        return $post
            ? redirect()->route('admin.posts.index')->with('success', 'Data Berhasil Diupdate!')
            : redirect()->route('admin.posts.index')->with('error', 'Data Gagal Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        // Remove image
        Storage::disk('local')->delete('public/posts/' . $post->image);

        $post->delete();

        return response()->json([
            'status' => $post ? 'success' : 'error',
        ]);
    }
}
