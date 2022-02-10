<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
class AuthController extends Controller
{
    public function show(){
        if (auth()->check()){
            return redirect('/products');
        }
            
        return view('backoffice.login');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt(['email'=>$request->email,'password' =>$request->password])) {
            $request->session()->regenerate();
            
            return redirect()->intended('products');
        }
 
        return back()->withErrors([
            'email' => 'Email & Password Belum Benar',
        ])->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
