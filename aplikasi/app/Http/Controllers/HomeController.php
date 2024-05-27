<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showWelcome']);
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
    public function showWelcome(): Renderable
    {
        return view('welcome');
    }

    // Metode lainnya...
    public function showBerita(): Renderable
    {
        return view('berita');
    }

    public function showAgenda(): Renderable
    {
        return view('agenda');
    }

    public function showAgendasingle(): Renderable
    {
        return view('agendasingle');
    }

    public function showFoto(): Renderable
    {
        return view('foto');
    }

    public function showVideo(): Renderable
    {
        return view('video');
    }

    public function showKontak(): Renderable
    {
        return view('kontak');
    }
}
