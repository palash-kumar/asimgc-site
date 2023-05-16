@extends('layouts.app')

@section('title')
    <h4>Users Settings</h4>
@endsection
@section('styles')

@endsection
@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-12"><!-- services list start -->
        <div class="card">
          <div class="card-header"><h4>Users List</h4></div>
          <div class="card-body">
            <table class="table table-sm table-striped table-responsive-sm w-100" id="usersList">
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
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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

    <!-- Role -->
    <div class="modal fade" id="edit-role" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Current Assigned Role : <span id="current-role" class="text-primary"></span> </h3>
                </div>
                <div class="modal-body">
                    <input id="usr" type="hidden" />
                    <select id='new-role' name='new-role' class="form-control" style="max-width:45%;" required>
                        <option value=''>Select Role</option>
                    @foreach ($roles as $item)
                        <option value='{{$item->id}}' >{{$item->name}}</option>
                    @endforeach

                    </select>
                    <button class="btn btn-success" id="update-role">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- .Role -->
    <!-- Designation -->
    <div class="modal fade" id="edit-desig" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Current Designation : <span id="current-desig" class="text-primary"></span> </h3>
                </div>
                <div class="modal-body">
                    <input id="desg-usr" type="hidden" />
                    <select id='new-desig' name='new-desig' class="form-control" style="max-width:45%;" required>
                        <option value=''>Select Designation</option>
                        @foreach ($designations as $item)
                            <option value='{{$item->id}}' >{{$item->title}}</option>
                        @endforeach

                    </select>
                    <button class="btn btn-success" id="update-desig">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- .Designation -->

@endsection

@section('script')

<script type="text/javascript">
$(document).ready(function() {

    $('#usersList').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            { data: "id",
            render: function ( data, type, row, meta ) {
                    return '<img style="max-height: 150px; max-width: 100px; " src="/storage/siteImages/UserImages/'+row.user_image+'" alt="">';
                },
            },
            { data: "name",
            render: function ( data, type, row, meta ) {

                    return  '<span>'+data+'</span><br><span><i>'+row.username+'</i></span><br>'+(row.mobile? '<span>'+row.mobile+'</span><br>' : "")+'<span>'+row.email+'</span>';
                },
            },
            { data: "designation",
            render: function ( data, type, row, meta ) {
                var ul = '<ul class="list-inline">';
                    ul+='<li class="list-inline-item"><span class="text-primary px-1"><i class="fas fa-id-badge"></i> '+(data? data.title : "Not Assigned")+'</span></li>';
                    ul+='<li class="list-inline-item"><span class="btn btn-outline-primary rounded btn-sm mr-2" title="Change Designation" onclick="changeDesignation(\''+row.uuid+'\',\''+(data? data.title : "Not Assigned")+'\')" ><i class="fas fa-retweet"></i></span></li>';
                    return ul+'</ul>';
                    //return '<span class="text-info  px-1"><i class="fas fa-id-badge"></i> '+(data? data.title : "Not Assigned")+'</span>';
                }, },
            { data: "user_role",
            render: function ( data, type, row, meta ) {
                var ul = '<ul class="list-inline">';
                    ul+='<li class="list-inline-item"><span class="text-primary px-1"><i class="fas fa-user-secret"></i> '+(data? data.name : "Not Assigned")+'</span></li>';
                    ul+='<li class="list-inline-item"><span class="btn btn-outline-info rounded btn-sm mr-2" title="Change Role" onclick="changeRole(\''+row.uuid+'\',\''+(data? data.name : "Not Assigned")+'\')" ><i class="fas fa-retweet"></i></span></li>';
                    return ul+'</ul>';
                },
            },
            {data: "status",
            render: function ( data, type, row, meta ) {
                if(data)
                    return '<span class="btn btn-outline-success btn-sm" id="'+row.uuid+'-stat" name="'+row.uuid+'-stat" onclick="updateStatus(\''+row.uuid+'\')">ACTIVE</span>';
                else
                    return '<span class="btn btn-outline-danger btn-sm" id="'+row.uuid+'-stat" name="'+row.uuid+'-stat" onclick="updateStatus(\''+row.uuid+'\')">INACTIVE</span>';
                },
            },
            {data: "status",
            render: function ( data, type, row, meta ) {
                var lnk='';
                var ul = '<ul class="list-inline">';
                    ul+='<li class="list-inline-item"><button type="button" class="btn btn-outline-primary rounded btn-sm mr-2" onclick="getUser(\''+row.uuid+'\')" title="Edit"><i class="fas fa-edit"></i></button></li>'

                    lnk= '{{route("manageSkills",":user")}}';

                    ul+='<li class="list-inline-item">'+buildFormWithUser(lnk.replace(':user',row.uuid), "PUT", '<i class="fas fa-cogs"></i>', 'btn-outline-info')+'</li>';
                    lnk= '{{route("users.destroy",":user")}}';
                    ul+='<li class="list-inline-item" title="Delete User">'+buildFormWithUser(lnk.replace(':user',row.uuid), "DELETE", '<i class="fas fa-user-times"></i>', 'btn-outline-danger')+'</li>';

                    return ul+='</ul>';
                },
            },
        ],
    });
});

function buildFormWithUser(url, method, action, style){
    var form='<form method="POST" action="'+url+'" accept-charset="UTF-8">'
                    +'<input name="_token" type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'">'
                    +'<input name="_method" type="hidden" value="'+method+'">'
                    +'<button class="btn '+style+' rounded btn-sm" type="submit" >'+action+'</button>'
                +'</form>';

                return form;
}

</script>
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
           $("#edit-setting").modal('show');
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
            var response = data.original;
            if (data.statusCode==200) {
                toastr[response.status](response.remarks)
            } else {
                toastr[response.status](response.remarks)
            }

         }
      });
  }

function changeRole(user, current){
    $("#current-role").text(current);
    $("#usr").val(user);
    $("#edit-role").modal('show');
}

function changeDesignation(user, current){
    $("#current-desig").text(current);
    $("#desg-usr").val(user);
    $("#edit-desig").modal('show');
}

$('#update-role').on('click', function(){
    var lnk= '{{route("updateUserRole",":user")}}';
    $.ajax({
         type:'PUT',
         url: lnk.replace(':user',$("#usr").val()),
         data:{role:$("#new-role").val()},
         success:function(data){
            var response = data.original;
            if (data.statusCode==200) {
                toastr[response.status](response.remarks)
            } else {
                toastr[response.status](response.remarks)
            }

         }
      });
})

$('#update-desig').on('click', function(){
    var lnk= '{{route("updateUserDesignation",":user")}}';
    $.ajax({
         type:'PUT',
         url: lnk.replace(':user',$("#desg-usr").val()),
         data:{desig:$("#new-desig").val()},
         success:function(data){
            var response = data.original;

            //showToast(success, data.statusCode);
            if (data.statusCode==200) {
                toastr[response.status](response.remarks)
                //$("#"+data.user.uuid+"-stat").addClass("btn-success");
                //$("#"+data.user.uuid+"-stat").text("ACTIVE");
                //$("#"+data.user.uuid+"-stat").removeClass("btn-danger");
            } else {
                toastr[response.status](response.remarks)
                //$("#"+data.user.uuid+"-stat").addClass("btn-danger");
                //$("#"+data.user.uuid+"-stat").text("INACTIVE");
                //$("#"+data.user.uuid+"-stat").removeClass("btn-success");
            }

         }
      });
})
</script>
@endsection
