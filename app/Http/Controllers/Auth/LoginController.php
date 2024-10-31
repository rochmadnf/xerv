<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function submit(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'min:5'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $credentials['email'] = User::where('username', $credentials['username'])->first()?->email;

        if (!is_null($credentials['email']) && Auth::attempt(Arr::only($credentials, ['email', 'password']))) {
            $request->session()->regenerate();

            return redirect()->intended('console');
        }

        return back()->withErrors([
            'status' => 'error',
            'account' => 'Nama Pengguna atau Katasandi.',
        ]);
    }
}
