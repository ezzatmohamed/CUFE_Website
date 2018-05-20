<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\project;
use App\student;
use App\user;


class ProjectController extends Controller
{

    public function addpage(){                        //Adding project Form Page

        return view('addproject');
    }
    
    public function addproject(Request $request)
        {

        $project = new project();

        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->details = $request['details'];
        $project->student_id = Auth::user()->id;


        
        
            $user_id = Auth::user()->id;
            $file_ext = $request['file']->getClientOriginalExtension();
            
            $mytime =  date('Y_m_d  H_i_s');                            // getting the  date and time .

            $file_name = $user_id."_".$mytime.".".$file_ext;           // File name is userID + the data&time + file extension
            $request['file']->move( 'uploads/project' , $file_name );  // move the file to a specific directory
            
            $project->file_name = $file_name;
          
              $project->save();
        
            return redirect('/home');
        
    }

    public function showprojects($id = null)
    {
        if ( $id == null )                                      // That case if the user is openening his projects
        {
            $projects = student::find( Auth::user()->id )->projects;    // Search in the students table a student with user's id and returs his projects.
        }
        else                                                    // The user wants to open another user's projects
        {
            $projects = student::find($id)->projects;         // Search in the students table a student with this id and returs his projects.
            
        }

        return view('projects')->with('projects',$projects);
    }

    public function projectdetails($id)                         // a function shows the projects with its details .
    {
            $project = project::find($id);                      // Search in the database a project  with this id .

            return view('project')->with('project',$project); 
    }

}
