<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\post;
use App\user;
use App\student;
use App\comment;
use App\notification;

use DB;

class PostController extends Controller
{
    public function SharePost(Request $request)
    {
        $post = new post();

        $post->text = $request['text'];
        $post->student_id = Auth::user()->id;
        $post->program = (DB::table('students')->where('id','=',$post->student_id)->first())->program;
            
        if( $request->hasFile('post-photo') )
        {
            $photo_id = Auth::user()->id ;
            $img_ext = $request['post-photo']->getClientOriginalExtension();
            $mytime =  date('Y_m_d  H_i_s');                            // getting the  date and time .

            $photo_name = $photo_id."_".$mytime.".".$img_ext;
            
            $photo = $request['post-photo']->move('images/post',$photo_name);
            $post->photo_name = $photo_name;

        }

        $post->save();
        return redirect('/home');
    }

    public function comment( Request $request , $id)
    {
        $comment = new comment();

        $comment->text       = $request['ctext'];
        $comment->student_id = Auth::user()->id;
        $comment->post_id    =  $id ;

        $post = DB::table('posts')->where('id','=',$id)->first();
        $student = DB::table('students')->where('id','=',$post->student_id)->first();

        if( Auth::user()->id != $post->student_id )
        {
            $notification = new notification();
            $notification->student_id = $student->id;
            $notification->post_id = $id;
            $notification->text = (string)$student->name."has commented on your post";
            $notification->save();
            
        }
        $comment->save();
        return redirect('/home');

    }

    public function PostPage($id)
    {
        $post = DB::table('posts')
                 ->join('students','students.id','=','posts.student_id')
                 ->join('users','students.id','=','users.id')
                 ->orderBy('posts.created_at','des')
                 ->select('posts.id','posts.text','posts.photo_name', 'users.name AS username','students.id AS student_id', 'students.img_ext')
                 ->first();

        $comments = DB::table('comments')
                    ->join('users','student_id','=','users.id')
                    ->join('students','students.id','=','comments.student_id')
                    ->select('comments.*','students.img_ext','users.name')
                    ->get();

        return view('post')->with('post',$post)->with('comments',$comments);
    }
}
