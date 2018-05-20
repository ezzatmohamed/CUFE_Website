<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Hashing\BcryptHasher;


use App\user;
use App\student;


class ProfileController extends Controller
{
    

    public function editpage(){
        
        $user = student::find(Auth::user()->id);
        return view('editprofile')->with('user',$user);
                
    }

    public function editprofile(Request $request){

        $user = student::find(Auth::user()->id);

        $user->first_name = $request['first-name'];
        $user->last_name = $request['last-name'];
        $user->city = $request['city'];
        $user->about_you = $request['about-you'];
        $user->facebook = $request['facebook'];
        $user->twitter = $request['twitter'];
        $user->linkdin = $request['linkdin'];

        $user->save();

        return redirect('/home');
    }
    public function changepwd(Request $request){

        $user = user::find(Auth::user()->id);

        if( password_verify($request['current-pwd'], $user->password ) )
        {
            if ( $request['new-pwd'] == $request['confirm-pwd']  )
            {
                $msg = "Password has been changed successfully !";
                $user->password = bcrypt($request['new-pwd']);
            }
            else
            {
                $msg = "Confirm Password is not correct !";
                return redirect('settings')->with('failed',$msg);
            }
        }
        else
        {
            $msg = "Current password is not correct";
            return redirect('settings')->with('failed',$msg);
        }


        $user->save();

        return redirect('/settings')->with('changed',$msg);
    }
    public function settingspage()
    {
        $user = student::find(Auth::user()->id);
        return view('settings')->with('user',$user);
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


}
