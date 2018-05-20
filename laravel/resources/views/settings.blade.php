@extends('layout.header')

<html>

    @section('content')

        <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <strong>Change</strong> Password 
                      </div>
                      <div class="card-body card-block">
                        @if(session('changed'))
                            
                            <div class="alert alert-success" role="alert">{{session('changed')}}</div>

                        @elseif(session('failed'))
                            
                            <div class="alert alert-danger" role="alert">{{session('failed')}}</div>

                        @endif
                        <form action="/changepwd" method="post" enctype="multipart/form-data" class="form-horizontal">
                          
                          {{csrf_field()}}
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Current Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="text-input" name="current-pwd" placeholder="Current Password" class="form-control" ></div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">New Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="text-input" name="new-pwd" placeholder="New Password" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Confirm New Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="text-input" name="confirm-pwd" placeholder="Confirm New Password" class="form-control"></div>
                          </div>
                          
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Change
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </div>
                        </form>
                      </div>
                      
    @endsection


</html>