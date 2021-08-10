<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\{Auth, DB, Hash};
use App\Models\User;

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
    public function edit($userId)
    {
        $user = DB::table('users')->where('id', $userId)->first();
        return view('admins.profile', compact('user'));
    }
    public function update(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|required_with:password_confirmatino|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $all = $request->all();
        $all['password'] = Hash::make($request->password);
        $update = $user->update($all);
        if ($update) {
            Session::flash('success', 'Profile Berhasil Di Ubah!');
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
