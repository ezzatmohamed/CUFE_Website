<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\post;
use App\user;
use App\student;
use App\comment;
use App\notification;


class HomeController extends Controller
{
    public function homepage()
    {
        $program = (DB::table('students')->where('id','=',Auth::user()->id)->first())->program;

        $posts = DB::table('posts')
                 ->join('students','students.id','=','posts.student_id')
                 ->join('users','students.id','=','users.id')
                 ->where('posts.program','=',$program)
                 ->orderBy('posts.created_at','des')
                 ->select('posts.id','posts.text','posts.photo_name', 'users.name AS username','students.id AS student_id', 'students.img_ext')
                 ->get();

        $comments = DB::table('comments')
                    ->join('users','student_id','=','users.id')
                    ->join('students','students.id','=','comments.student_id')
                    ->select('comments.*','students.img_ext','users.name')
                    ->get();

        return view('home')->with('posts',$posts)->with('comments',$comments);
    }

    public function SearchUser( Request $request)
    {
        $text = $request['SearchText'];
        $id = Auth::user()->id;
        $users = DB::table('users')->join('students','users.id','=','students.id')->where('students.id','<>',$id)->where('users.name', 'LIKE', '%'.$text.'%')->get();

        return view('SearchResult')->with('users',$users);

    }



    public function TimeTable()
    {
     
        $timetables = DB::table('timetables')->where('student_id','=',Auth::user()->id)->get();
        return view('timetable')->with('timetables',$timetables);
    }
  
}
