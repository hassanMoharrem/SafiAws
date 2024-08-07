<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function loginIndex()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
         $request->validate([
            'email' => 'required|email|exists:admins,email|max:100',
            'password' => 'required|min:6|max:50',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            $errors = new MessageBag();
            $errors->add('Error', __('The data is wrong'));
            return redirect()->route('admin.login.index')->withInput()->withErrors($errors);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.index');
    }
}
