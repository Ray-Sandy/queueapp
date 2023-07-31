<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Login_Controller extends Controller
{

    public function index()
    {
        $message = "please login !!";
        return view('User.login', compact('message'));
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function postlogin(Request $request){

        $credentials = $request->validate([
            'name'      => 'required',
            'password'  => 'required'
        ]);

        if(Auth::attempt($credentials)){

            $request->session()->regenerateToken();

            return redirect()->intended('cs')->with('success', 'login berhasil !!');
        }else{

            return redirect()->intended('login')->with('failed', 'Login fail');
        }
    }

    // public function postlogout(){

    //     Auth::logout();

    //     request()->session()->invalidate();

    //     Session::forget('name');
    //     request()->session()->flush();



    //     return redirect('/login')->with('success', 'Logout Success');

    // }


    public function postlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/login')->with('success', 'Logout Success');
    }

    public function register(){
        return view('User.register');

    }

    public function saveregister(Request $request){

        $validatedata = $request->validate([
            'name'      => 'required|min:3|max:255|unique:users',
            'email'     => 'required|email:dns|unique:users',
            'password'  => 'required',
        ]);

        $validatedata['password'] = Hash::make($validatedata['password']);

        User::create($validatedata);



        return redirect('/login')->with('success', 'Register Success, Please Login !!');
    }
}
