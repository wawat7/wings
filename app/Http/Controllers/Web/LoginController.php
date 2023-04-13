<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Login\LoginVerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index()
    {
        return view('authentication.login');
    }

    public function verification(LoginVerificationRequest $request)
    {
        $credentials = $request->only('username', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('sales.index')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
