@extends('layout.header')
@extends('layout.header')

<html>

    @section('content')

        <div class="col-lg-6">
               
               @if( count($projects) )
                    @foreach( $projects as $project)
                        <div class="card">
                          <div class="card-header">
                            <strong>{{$project->name}}</strong> 
                          </div>
                          <div class="card-body card-block">
                            
                              <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label"><strong> Description  </strong></label></div>
                                <p>{{$project->description}}</p>
                              </div>

                          </div>
                         <div class="card-footer">
                           <a href = "/project/{{$project->id}}" >
                            <button  class="btn btn-primary btn-sm">
                              <i class="fa fa-dot-circle-o"></i> More info
                            </button>
                          </a>    
                        </div>
                    </div>
                    @endforeach
              @endif
        </div>
                      
    @endsection


</html>