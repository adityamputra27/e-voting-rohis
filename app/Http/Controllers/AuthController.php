<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('siswa.auth.login');
    }
    public function login()
    {
        return view('admins.login');
    }
    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ],
        [
            'username.required' => 'Username Harus Diisi!',
            'password.min' => 'Password Minimal 6 Karakter!',
            'password.required' => 'Password Harus Diisi!'
        ] 
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended('admin/dashboard');
        }
        Session::flash('error', 'Email Atau Password Salah!');
        return redirect('admin/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
