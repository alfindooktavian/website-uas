<?php

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Handle the POST request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePost(Request $request)
    {
        // Tangani permintaan POST di sini
        // Misalnya, Anda dapat memproses data yang dikirimkan dalam permintaan POST

        // Contoh: validasi dan pengolahan data
        $request->validate([
            'data' => 'required|string',
        ]);

        // Lakukan sesuatu dengan data
        $data = $request->input('data');

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard.index')->with('status', 'POST request handled successfully');
    }
}
