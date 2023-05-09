@extends('layouts.app')

@section('title')
      <h4>Clients Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <div class="card quality-card w-100 mb-3" ><!-- style="max-width: 540px;" -->
                    <div class="card-body text-body">
                        <table class="table table-sm table-striped table-responsive-sm w-100 text-light" id="clientList" style="font-size: 0.8rem;">
                            <thead class="bg-dark">
                              <tr>
                                  <th>Logo</th>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody class="text-dark">

                            </thead>
                          </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if (count($clients) > 0)
          <div class="row">
            @foreach ($clients as $client)
            <div class="col-md-4 col-6 ">
              <div class="card w-100" style="width: 18rem;">
                <img class="card-img-top" src="/storage/siteImages/Clients/{{$client->image_path}}" alt="{{$client->title}}">
                <div class="card-body px-2">
                    <h5 class="card-title">{{$client->title}}</h5><span>
                        @if ($client->status)
                            <button type="button" id="{{$client->id}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus({{$client->id}})">
                                ACTIVE
                            </button>
                        @else
                            <button type="button" id="{{$client->id}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus({{$client->id}})">
                                INACTIVE
                            </button>
                        @endif
                    </span>
                  <p class="card-text">{!!$client->description!!}</p>

                  <div class="btn-group">
                    <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getClientDetail({{$client->id}})">
                      Edit
                    </button>
                    {!! Form::open(['action'=>['ClientsController@destroy', $client->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @else
            <p>No Images Found</p>
        @endif --}}
      </div><!-- services list End -->

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Client</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['action'=>'ClientsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
              <div class="row mb-2">
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
              </div>


                <div class="fom-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['id'=>'description-ckeditor','class'=>'form-control', 'placeholder'=>'Clients Description'])}}
                </div>
                <div class="fom-group">
                    {{Form::file('cover_image')}}
                </div>

                <div class="row justify-content-center mt-2">
                  <div class="col-md-6">{{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}</div>
                </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div><!-- create service form end -->
    </div><!-- main .row END -->

    <!-- Modal for edit -->

    <!-- Modal -->
    <div class="modal fade" id="edit-gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>'ClientsController@index', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-gallery-form']) !!}
              <div class="row">
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('etitle', 'Title')}}
                    {{Form::text('etitle', '', ['id'=>'etitle','class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
              </div>


                <div class="fom-group">
                    {{Form::label('edescription', 'Description')}}
                    {{Form::textarea('edescription', '', ['id'=>'edescription-ckeditor','class'=>'form-control', 'placeholder'=>'Service Description'])}}
                </div>
                <div class="fom-group">
                    {{Form::file('ecover_image')}}
                </div>
                <div class="row justify-content-center mt-2">
                  {{Form::hidden('_method','PUT')}}
                  <div class="col-md-6">{{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}</div>
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
  $(document).ready(function() {
    //console.log("datatables called")
    $('#clientList').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[1, 'desc']],

        ajax: { url:"{{ route('clientList') }}",
                type:'GET',
        },
        columns: [
            { data: "image_path",
            render: function ( data, type, row, meta ){
                    //var element= '<h6 class="h-style text-center text-primary">'+data+'</h6>';

                    return data;
                }
            },
            { data: "title",
            render: function ( data, type, row, meta ){
                    return '<h6 class="h-style text-center text-primary">'+data+'</h6>';//((data)? '<span id="'+row.proj_id+'-pstat" class="badge bg-success btn-sm mr-2" onclick="updateProjectStatus(\''+row.proj_id+'\')"> COMPLETE</span>' : '<span id="'+row.proj_id+'-pstat" class="badge bg-info btn-sm mr-2" onclick="updateProjectStatus(\''+row.proj_id+'\')">ONGOING</span>') + view;
                }
            },
            { data: "description",
            render: function ( data, type, row, meta ){

                    return data.replaceAll('&amp;amp;','&').replaceAll('&gt;','>').replaceAll('&lt;','<');
                }
            },
            { data: "client_id",
            render: function ( data, type, row, meta ){
                    var opt = (row.status)? '<span id="'+row.proj_id+'-stat" class="badge bg-success btn-sm" onclick="updateStatus(\''+row.client_id+'\')">SHOW </span>' : '<span id="'+row.proj_id+'-stat" class="badge bg-danger btn-sm" onclick="updateStatus(\''+row.proj_id+'\')">HIDDEN </span>'
                    opt += '<button type="button" class="btn btn-outline-primary rounded btn-sm mr-2" onclick="getClientDetail(\''+data+'\')"><i class="fas fa-edit"></i></button>'

                    return '<button class="btn btn-outline-info rounded py-1 px-2" onClick="getProjectDetails(\''+data+'\')"><i class="fas fa-info"></i></button>'+opt;
                }
            },
        ],
    });
});

  function getClientDetail(id){

    var req = "{{ route('clients.index') }}",
    //console.log('url : '+req);
    get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url:get,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.clients.title);
           $('#edescription-ckeditor').val(data.clients.description);
           console.log("Description : "+data.clients.description);
           $("#edit-gallery-form").attr('action', req+'/'+id);
           $("#edit-gallery").modal('show');
         }
      });
  }

  function updateStatus(id){
    var req = "{{ route('clients.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data, status){
             console.log("Status code : "+status);
            //alert(data.setting.sName);
            if (data.clients.status) {
                $("#"+data.clients.client_id+"-stat").addClass("btn-success");
                $("#"+data.clients.client_id+"-stat").text("ACTIVE");
                $("#"+data.clients.client_id+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.clients.client_id+"-stat").addClass("btn-danger");
                $("#"+data.clients.client_id+"-stat").text("INACTIVE");
                $("#"+data.clients.client_id+"-stat").removeClass("btn-success");
            }

         },
         error:function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            $('#error-alert').text("Sorry Somethig Went Wrong. Please contact ADMIN.");
            $('#error-alert').show();
            setTimeout(function() {
                $("#error-alert").hide();
            }, 5000);
        }
      });
  }

</script>
@endsection
