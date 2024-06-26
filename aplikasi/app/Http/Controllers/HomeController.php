<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Video;
use App\Models\Slider;
use App\Models\Event;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import class Carbon

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showWelcome', 'showFoto','showBerita','showAgenda','showAgendasingle','showVideo','showKontak']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * Show the welcome page.
     *
     * @return Renderable
     */
    public function showWelcome(Request $request): Renderable
    {
        $sliders = Slider::all();
        $photos = Photo::latest()->take(2)->get();
        $videos = Video::latest()->take(2)->get();
        $events = Event::latest()->take(3)->get();
        $posts = Post::latest()->take(6)->get();
        $categories = Category::all();
        $tags = Tag::all();

        return view('welcome', compact('sliders', 'photos', 'videos', 'events', 'posts', 'categories','tags'));
    }

    // Metode lainnya...
    public function showBerita($id): Renderable
    {
        // Ambil data posting berdasarkan ID
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $events = Event::latest()->take(3)->get();
        $categories = Category::all();
        // Memformat tanggal dalam $post
        $post->formatted_date = Carbon::parse($post->created_at)->format('d-m-Y');

        // Kirim data posting ke view berita.blade.php
        return view('berita', compact('post','tags','events','categories'));
    }





     // Metode lainnya...
     public function showBeritas(Request $request): Renderable
{
    $query = Post::latest();

    if ($request->has('category_id')) {
        $category = Category::findOrFail($request->category_id);
        $query = $query->where('category_id', $category->id);
    }

    if ($request->has('tag_id')) {
        $tag = Tag::findOrFail($request->tag_id);
        $query = $query->whereHas('tags', function($q) use ($tag) {
            $q->where('id', $tag->id);
        });
    }

    $posts = $query->paginate(10);

    foreach ($posts as $post) {
        $post->formatted_date = Carbon::parse($post->date)->format('d-m-Y');
    }

    $categories = Category::all();
    $tags = Tag::all();

    return view('beritas', compact('posts', 'categories', 'tags'));
}





    public function showAgenda(): Renderable
    {
        $events = Event::latest()->paginate(10);
        $tags = Tag::all();
        // Memformat tanggal dalam $events sebelum mengirimkannya ke tampilan
        foreach ($events as $event) {
            $event->formatted_date = Carbon::parse($event->date)->format('d-m-Y');
        }

        return view('agenda', compact('events','tags'));
    }

    public function showAgendasingle($id): Renderable
    {
        // Ambil data agenda berdasarkan ID
        $event = Event::findOrFail($id);
        $tags = Tag::all();
        $events = Event::latest()->take(3)->get();
        $categories = Category::all();
    
        // Memformat tanggal dalam $event
        $event->formatted_date = Carbon::parse($event->date)->format('d-m-Y');
    
        // Kirim data agenda ke view agendasingle.blade.php
        return view('agendasingle', compact('event','tags','events','categories'));
    }
    

    public function showFoto()
    {
       // Ambil data foto dari database
       $photos = Photo::latest()->get();
       $tags = Tag::all();
        return view('foto', compact('photos','tags')); // Mengirim data foto ke view
    }

    public function showVideo(): Renderable
    {
        $videos = Video::latest()->paginate(10);
        $tags = Tag::all();
        return view('video', compact('videos','tags'));
    }

    public function showKontak(): Renderable
    {
        $tags = Tag::all();
        return view('kontak', compact('tags'));
    }
}
