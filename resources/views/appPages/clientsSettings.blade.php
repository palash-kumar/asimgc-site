@extends('layouts.app')

@section('title')
      <h4>Clients Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <!--
        <div class="card">
          <div class="card-header"><h4>Gallery Images</h4></div>
          <div class="card-body">
            @if (count($clients) > 0)
            <table class="table table-striped">
              <tr  class="thead-dark">
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
              </tr>
              @foreach ($clients as $client)
                  <tr>
                    <td> <img class="w-100" src="/storage/siteImages/Clients/{{$client->image_path}}"></td>
                    <td>
                      {{$client->title}}
                      {!!$client->description!!}
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getService({{$client->id}})">
                          Edit
                        </button>
                        {!! Form::open(['action'=>['ClientsController@destroy', $client->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
              @endforeach
            </table>
            @else
                <p>No Images Found</p>
            @endif
          </div>
        </div>
        -->
        @if (count($clients) > 0)
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
        @endif
      </div><!-- services list End -->

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Service</h3>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
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
           $("#edit-gallery").modal();
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
                $("#"+data.clients.id+"-stat").addClass("btn-success");
                $("#"+data.clients.id+"-stat").text("ACTIVE");
                $("#"+data.clients.id+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.clients.id+"-stat").addClass("btn-danger");
                $("#"+data.clients.id+"-stat").text("INACTIVE");
                $("#"+data.clients.id+"-stat").removeClass("btn-success");
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