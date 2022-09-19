@extends('layouts.app')

@section('title')
    <h4>Users Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-12"><!-- services list start -->
        <div class="card">
          <div class="card-header"><h4>Users List</h4></div>
          <div class="card-body">
            <table class="table table-sm table-striped table-responsive-sm">
              <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <thead>
                @foreach ($users as $user)
                    <tr>
                    <td>
                        <img style="max-height: 150px; max-width: 100px; " src="/storage/siteImages/UserImages/{{$user->user_image}}" alt="">
                    </td>
                    <td>
                      <span>{{$user->name}}</span><br>
                      <span><i>{{$user->username}}</i></span><br>
                      <span>{{$user->mobile}}</span> 
                      <span>{{$user->email}}</span> 
                    </td>
                    <td><span></span> 
                        {!! Form::open(['action'=>['UsersController@updateUserDesignation', $user->uuid], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','PUT')}}
                            <div class="fom-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-preappend">
                                        <span class="input-group-text text-light bg-info px-1">{{$user->designation? $user->designation->title : "Not Designated"}}</span>
                                    </div>
                                    <select id='desig-{{$user->uuid}}' name='desig-{{$user->uuid}}' class="form-control" style="max-width:45%;" required>
                                        
                                            <option value=''>Select Designation</option>
                                          @foreach ($designations as $item)
                                            @if ($item->id == $user->designations_id)
                                              <option value='{{$item->id}}' selected>{{$item->title}}</option>
                                            @else
                                              <option value='{{$item->id}}' >{{$item->title}}</option>
                                            @endif
                                          @endforeach                                           
                                        
                                    </select>
                                    <div class="input-group-append px-1">
                                        
                                        {{Form::submit('Update',['class'=>'btn btn-success rounded btn-sm input-group-text'])}}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </td>
                    <td> 
                        {!! Form::open(['action'=>['UsersController@updateUserRole', $user->uuid], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','PUT')}}
                            <div class="fom-group">
                                <div class="input-group mb-3">
                                  <div class="input-group-preappend">
                                      <span class="input-group-text text-light bg-info px-1">{{$user->userRole? $user->userRole->name : "Not Assigned"}}</span>
                                  </div>
                                    <select id='role-{{$user->uuid}}' name='role-{{$user->uuid}}' class="form-control" style="max-width:45%;" required>
                                        
                                            <option value=''>Select Role</option>
                                          @foreach ($roles as $item)
                                            @if ($item->id == $user->user_roles_id)
                                              <option value='{{$item->id}}' selected>{{$item->name}}</option>
                                            @else
                                              <option value='{{$item->id}}' >{{$item->name}}</option>
                                            @endif
                                          @endforeach                                           
                                        
                                    </select>
                                    <div class="input-group-append px-1">
                                        
                                        {{Form::submit('Update',['class'=>'btn btn-success rounded btn-sm input-group-text'])}}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if ($user->status)
                            <button type="button" id="{{$user->uuid}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus('{{$user->uuid}}')">
                                ACTIVE
                            </button>
                        @else 
                            <button type="button" id="{{$user->uuid}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus('{{$user->uuid}}')">
                                INACTIVE
                            </button>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getUser('{{$user->uuid}}')">
                              S
                            </button>
                            {!! Form::open(['action'=>['UsersController@manageSkills', $user->uuid], 'method'=>'POST', 'class'=>'pull-right']) !!}
                                {{Form::hidden('_method','PUT')}}
                                {{Form::submit('Sett',['class'=>'btn btn-info rounded btn-sm'])}}
                            {!! Form::close() !!}

                            <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getUser('{{$user->uuid}}')">
                              Edit
                            </button>
                            {!! Form::open(['action'=>['UsersController@destroy', $user->uuid], 'method'=>'POST', 'class'=>'pull-right']) !!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    </tr>
                @endforeach
              </thead>
            </table>
          </div>
        </div>
      </div><!-- services list End -->
    </div><!-- main .row END -->

    

    <!-- Modal for edit -->
    
    <!-- Modal -->
    <div class="modal fade" id="edit-setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit User Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>['UsersController@index'], 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-setting-form']) !!}
                <div class="row mb-2">
                    <div class="col-md-12 col-12">
                      <div class="fom-group">
                          {{Form::label('etitle', 'Name')}}
                          {{Form::text('etitle', '', ['class'=>'form-control', 'placeholder'=>'Designation Name'])}}
                      </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6 col-12">
                      <div class="fom-group">
                          {{Form::label('emobile', 'Mobile')}}
                          {{Form::text('emobile', '', ['class'=>'form-control', 'placeholder'=>'Mobile Number'])}}
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="fom-group">
                          {{Form::label('eemail', 'E-Mail')}}
                          {{Form::text('eemail', '', ['class'=>'form-control', 'placeholder'=>'E-Mail'])}}
                      </div>
                    </div>
                </div>

                <div class="row mb-2">
                  <div class="col-md-12 col-12">
                    <div class="fom-group">
                        {{Form::file('user_image', ['class'=>'form-control'])}}
                    </div>
                  </div>
              </div>

                <div class="row mb-2">
                  <div class="col-md-6 col-6">
                      <div class="fom-group">
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}
                      </div>
                  </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for edit Exit -->
    
@endsection

@section('script')
<script type="text/javascript">

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  function getUser(id){
    var req = "{{ route('users.index') }}";
    //console.log('url : '+req);
    var get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url: get,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.user.name);
           $('#emobile').val(data.user.mobile);
           $('#eemail').val(data.user.email);
           // alert(data.service.title);
           $("#edit-setting-form").attr('action', req+'/updateUserInfo/'+id);
           $("#edit-setting").modal();
         }
      });
  }

  function updateStatus(id){
    var req = "{{ route('users.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data){
            //alert(data.setting.sName);
            if (data.user.status) {
                $("#"+data.user.uuid+"-stat").addClass("btn-success");
                $("#"+data.user.uuid+"-stat").text("ACTIVE");
                $("#"+data.user.uuid+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.user.uuid+"-stat").addClass("btn-danger");
                $("#"+data.user.uuid+"-stat").text("INACTIVE");
                $("#"+data.user.uuid+"-stat").removeClass("btn-success");
            }
           
         }
      });
  }
  
</script>
@endsection