<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Employee::where('username', $request->username)->where('user_type','!=','E')->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return Redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', 'Password is invalid');
            }
        } else {
            return redirect()->back()->with('error', 'Username is invalid');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect()->route('login');
    }
}
