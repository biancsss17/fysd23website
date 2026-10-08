<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function edit()
    {
        return view('admin.account');
    }

    public function update(Request $r)
    {
        $data = $r->validate(['current_password' => 'required|current_password', 'password' => ['required', 'confirmed', Password::min(12)->mixedCase()->numbers()]]);
        $r->user()->password = $data['password'];
        $r->user()->save();
        $r->session()->regenerate();

        return back()->with('success', 'Password changed successfully.');
    }
}
