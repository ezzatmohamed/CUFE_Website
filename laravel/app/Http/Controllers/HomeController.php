<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\post;
use App\user;



class HomeController extends Controller
{
    public function homepage(){
    
        //$userss= user::where('id',Auth::user()->id)->with('posts')->get();
        //$userss = DB::select('SELECT P.*,U.name FROM users U,posts P WHERE U.id =:ID AND U.id = P.user_id',['ID' => Auth::user()->id]);
       // $posts = post::all();
     
        return view('home');
    }

    public function posting(Request $request){

        $post = new post();
        $post->text = $request['sharing'];
        $request->user()->posts()->save($post);
        
        return redirect('/home');
    }
    
}
