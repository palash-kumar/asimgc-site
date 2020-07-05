@extends('layouts.app')

@section('title')
    <h4>Services Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <div class="card">
          <div class="card-header"><h4>Services List</h4></div>
          <div class="card-body">
            <table class="table table-striped">
              <tr  class="thead-dark">
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
              @foreach ($services as $service)
                  <tr>
                    <td><span><i class="{{$service->icon}}"></i></span> {{$service->title}}</td>
                    <td>{!!$service->description!!}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getService({{$service->id}})">
                          Edit
                        </button>
                        {!! Form::open(['action'=>['ServicesController@destroy', $service->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div><!-- services list End -->

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Service</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['action'=>'ServicesController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
              <div class="row mb-2">
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('icon', 'Iconn Name')}}
                    {{Form::text('icon', '', ['class'=>'form-control', 'placeholder'=>'icon name Eg. fas fa-address-card'])}}
                    <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Please get the icon name from here</a>
                  </div>
                </div>
              </div>

                
                <div class="fom-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['id'=>'description-ckeditor','class'=>'form-control', 'placeholder'=>'Service Description'])}}
                </div>
                <!-- <div class="fom-group">
                    {{Form::file('cover_image')}}
                </div>
                -->
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
    <div class="modal fade" id="edit-service" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>'ServicesController@index', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-service-form']) !!}
              <div class="row">
                <div class="col-md-6 col-6">
                  <div class="fom-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['id'=>'etitle','class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="fom-group">
                    {{Form::label('icon', 'Iconn Name')}}
                    {{Form::text('icon', '', ['id'=>'eicon','class'=>'form-control', 'placeholder'=>'icon name Eg. fas fa-address-card'])}}
                    <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Please get the icon name from here</a>
                  </div>
                </div>
              </div>

                
                <div class="fom-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['id'=>'edescription-ckeditor','class'=>'form-control', 'placeholder'=>'Service Description'])}}
                </div>
                <!-- <div class="fom-group">
                    {{Form::file('cover_image')}}
                </div>
                -->
                <div class="row justify-content-center mt-2">
                  <div class="col-md-6">{{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}</div>
                </div>
            {!! Form::close() !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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

  CKEDITOR.replace( 'edescription-ckeditor' );

  function getService(id){
    var req = "{{ route('services.index') }}",
    //console.log('url : '+req);
    req = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url:req,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.service.title);
           $('#eicon').val(data.service.icon);
           $('#edescription-ckeditor').val(data.service.description);
           // alert(data.service.title);
           $("#edit-service-form").attr('action', req+'/'+id);
           $("#edit-service").modal();
         }
      });
  }
  
</script>
@endsection