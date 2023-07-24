<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $data=Employee::find(Auth::user()->id);
        return view('profile.index',compact('data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'nullable|min:4|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $emp = Employee::find(Auth::user()->id);
            $emp->password = Hash::make($request->password);
            $emp->save();
            return redirect()->back()->with('success', 'Your profile has been updated');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }
}
