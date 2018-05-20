<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\project;
use App\student;
use App\user;


class ProjectController extends Controller
{

    public function addpage(){

        return view('addproject');
    }
    
    public function addproject(Request $request)
        {

        $project = new project();
    
        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->details = $request['details'];
        $project->student_id = Auth::user()->id;

        if ( $request->hasFile('file') )
        {
            $user_id = Auth::user()->id;
            $file_ext = $request['file']->getClientOriginalExtension();

            $file_name = $user_id.".".$file_ext;
            $request['file']->move( 'uploads/project' , $file_name );
            
            $project->file_name = $file_name;

            
            $project->save();
        
        }
            return redirect('home');
        
    }

    public function showprojects($id = null)
    {
        if ( $id == null )
        {
            $projects = student::find( Auth::user()->id )->projects;
        }
        else
        {
            $projects = student::find($id)->projects();
        }

        return view('/projects')->with('projects',$projects);
    }

    public function projectdetails($id)
    {
            $project = project::find($id);

            return view('project')->with('project',$project);
    }

}
