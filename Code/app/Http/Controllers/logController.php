<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use App\student;
use App\timetable;

class logController extends Controller
{

    private $soap ;

    public function __construct()
    {
        $this->soap = new SoapController();
    }

    public function logpage()                                           
    {                                                               
    
        return view('login');
    }

    public function login(Request $request)
    {
        if(  $this->soap->CheckLog($request['log-usr'] ,$request['log-pwd'])  )
        {
            $user = user::where('id', '=', $request['log-usr'])->first();
            if( $user === null)
            {
                $user = new user();
                $user->id = $request['log-usr'] ;
                $user->name = $request['log-usr'];
                $user->password = $request['log-pwd'];
                $user->save();

                $info =  $this->soap->PersonalInfo($user->id,$user->password);

                $student = new student();
                $student->id = $user->id;
                $student->gpa = $info[2];
                $student->program = $info[1];
                $student->name = $info[0];
                $student->img_ext = "unknown.jpg";
                $student->save();

                $tables =  $this->soap->TimeTable($user->id,$user->password);

                
                foreach( $tables as $table )
                {
                    $timetable = new timetable();
                    $timetable->student_id = $user->id;
                    $timetable->course_name = $table[0];
                    $timetable->course_code = $table[1];
                    $timetable->type = $table[2];
                    $timetable->location = DB::connection()->getPdo()->quote(utf8_encode($table[3]));
                    $timetable->time = $table[4];
                    $timetable->day  = $table[5];
                    $timetable->save(); 
                }

            }
            Auth::login($user);            
           return redirect('/home');
        }
        else                                                            // if username or password is not correct.                                                                      
        {
            echo $msg = "Username or Password are not correct .Try again !";
            return redirect('/')->witherrors($msg);
        }

    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
