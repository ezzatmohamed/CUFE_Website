<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Hashing\BcryptHasher;


use App\user;
use App\student;

use DB;

class ProfileController extends Controller
{
    

    public function editpage()                          // Showing the editing profile page 
    {
        
        $student = student::find(Auth::user()->id);        // Get the current user row 
        $user = user::find(Auth::user()->id);        // Get the current user row 
        
        return view('editprofile')->with('user',$user)->with('student',$student);
                
    }

    public function editprofile(Request $request)
    {

        $student = student::find(Auth::user()->id);            
        $user = user::find(Auth::user()->id);            

        $student->city = $request['city'];
        $student->about_you = $request['about-you'];
        $student->facebook = $request['facebook'];
        $student->twitter = $request['twitter'];
        $student->linkdin = $request['linkdin'];
    
        if ( $request->hasFile('resume') )
        {
            $user_id = Auth::user()->id;
            $file_ext = $request['resume']->getClientOriginalExtension();

            $file_name = $user_id.".".$file_ext;
            $request['resume']->move( 'uploads/resume' , $file_name );
            
            $student->cv = $file_name;
        }
        
        $user->name = $request['user-name'];
        $user->save();
        $student->save();

        return redirect('/home');
    }

    public function changepic(Request $request)
    {

        if ( $request->hasFile('profile-pic') )
        {
            $user_id = Auth::user()->id;
            $img_ext = $request['profile-pic']->getClientOriginalExtension();

            $pic_name = $user_id.".".$img_ext;
            $request['profile-pic']->move( 'images/profile_pic' , $pic_name );
            
            $user = student::find( $user_id );
            $user->img_ext = $pic_name;
            $user->save();
            
            $msg = "Image has been uploaded successfully !";
            return redirect('editprofile')->with('uploaded',$msg);
        }
        
        else
        {
            $msg = "Image couldn't be upload .Try again !";
            return redirect('editprofile')->with('notuploaded',$msg);
        }
    }
    public function ViewProfile($id)
    {
        
        $user = DB::table('users')->join('students','users.id','=','students.id')->where('students.id','=',$id)->select('students.*','users.name as username')->first();

        return view('Profile')->with('user',$user);
        
    }

}
