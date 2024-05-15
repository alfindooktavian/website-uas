<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan tampilan welcome.
     *
     * @return \Illuminate\View\View
     */
    public function showWelcome()
    {
        return view('welcome');
    }

    /**
     * Menampilkan tampilan berita.
     *
     * @return \Illuminate\View\View
     */
    public function showBerita()
    {
        return view('berita');
    }

    /**
     * Menampilkan tampilan agenda.
     *
     * @return \Illuminate\View\View
     */
    public function showAgenda()
    {
        return view('agenda');
    }

    /**
     * Menampilkan tampilan agenda single.
     *
     * @return \Illuminate\View\View
     */
    public function showAgendasingle()
    {
        return view('agendasingle');
    }

     /**
     * Menampilkan tampilan foto.
     *
     * @return \Illuminate\View\View
     */
    public function showFoto()
    {
        return view('foto');
    }

     /**
     * Menampilkan tampilan video.
     *
     * @return \Illuminate\View\View
     */
    public function showVideo()
    {
        return view('video');
    }

    
     /**
     * Menampilkan tampilan kontak.
     *
     * @return \Illuminate\View\View
     */
    public function showKontak()
    {
        return view('kontak');
    }
}
