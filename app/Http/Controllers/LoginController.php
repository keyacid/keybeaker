<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage(Request $request) {
        return view('login');
    }

    public function login(Request $request) {
        //
    }

    public function logout(Request $request) {
        return redirect('/');
    }
}
