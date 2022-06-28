<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    // public function admin(Request $request)
    // {
    //     $attributes = $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     User::create($attributes);
    //     return redirect('/');
    // }


    public function admin(Request $request)
    {
        $attributes = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($attributes)) {
            return redirect('/');
        }
        return back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}