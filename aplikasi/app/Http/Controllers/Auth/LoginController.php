<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard'; // Ubah menjadi rute dashboard admin

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Periksa apakah pengguna dengan ID atau email tertentu
        if ($user->id == 1 || $user->email == 'admin@gmail.com') {
            // Periksa apakah password sudah menggunakan Bcrypt
            if (Hash::needsRehash($user->password)) {
                // Hash ulang password dan simpan
                $user->password = Hash::make($request->input('12345678'));
                $user->save();
            }
        }

        return redirect()->intended($this->redirectPath());
    }
}
