<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\student;


class logController extends Controller
{

    public function signpage(){

        return view('signup');
    }

    public function signup(Request $request){
        
        $user = new user();
        $user->name = $request['usr'];
        $user->password = bcrypt($request['pwd']);
        $user->save();
        Auth::login($user);

        $student = new student();
        $student->id = $user->id;
        $student->save();
     return  redirect('Home');
        
    }

    public function logpage()
    {
    
        return view('login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['name' => $request['log-usr'] ,'password'=> $request['log-pwd']]))
        {
            $user_id = Auth::user()->id;

            $student = student::find($user_id);
            if( $student )
            {
                $user_img = $student->id.".".$student->img_ext;
            }
            return redirect('/home');
        }
        else{
            $msg = "Username or Password are not correct .Try again !";
            return redirect('/')->witherrors($msg);
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
