@extends('layouts.app')

@section('title')
    <h4>Site Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <div class="card">
          <div class="card-header"><h4>Settings List</h4></div>
          <div class="card-body">
            <table class="table table-sm table-striped table-responsive-sm">
              <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
              </thead>
              <thead>
                @foreach ($settings as $setting)
                    <tr>
                    <td><span></span> {{$setting->sName}}</td>
                    <td>{!!$setting->sValue!!}</td>
                    <td>
                        @if ($setting->status)
                            <button type="button" id="{{$setting->id}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus({{$setting->id}})">
                                ACTIVE
                            </button>
                        @else 
                            <button type="button" id="{{$setting->id}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus({{$setting->id}})">
                                INACTIVE
                            </button>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getService({{$setting->id}})">
                            Edit
                            </button>
                            {!! Form::open(['action'=>['SiteSettingsController@destroy', $setting->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
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

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h4>Add Settings</h4>
          </div>
          <div class="card-body">
            {!! Form::open(['action'=>'SiteSettingsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-12 col-12 mb-2">
                        <div class="fom-group">
                            {{Form::label('sName', 'Settings Name')}}
                            {{Form::text('sName', '', ['class'=>'form-control', 'placeholder'=>'Settings Name'])}}
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <div class="fom-group">
                            {{Form::label('sValue', 'Settings Value')}}
                            {{Form::text('sValue', '', ['class'=>'form-control', 'placeholder'=>'Settings Value'])}}
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <div class="fom-group">
                            {{Form::file('cover_image')}}
                        </div>
                    </div>
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
    <div class="modal fade" id="edit-setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>['SiteSettingsController@index'], 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-setting-form']) !!}
                <div class="row mb-2">
                    <div class="col-md-6 col-6">
                    <div class="fom-group">
                        {{Form::label('esName', 'Settings Name')}}
                        {{Form::text('esName', '', ['class'=>'form-control', 'placeholder'=>'Settings Name'])}}
                    </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="fom-group">
                        {{Form::label('esValue', 'Settings Value')}}
                        {{Form::text('esValue', '', ['class'=>'form-control', 'placeholder'=>'Settings Value'])}}
                        </div>
                    </div>
                </div>
                <div class="fom-group  mb-2">
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

  function getService(id){
    var req = "{{ route('settings.index') }}";
    //console.log('url : '+req);
    var get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url: get,
         //data:{id:id},
         success:function(data){
           $('#esName').val(data.setting.sName);
           $('#esValue').val(data.setting.sValue);
           // alert(data.service.title);
           $("#edit-setting-form").attr('action', req+'/'+id);
           $("#edit-setting").modal();
         }
      });
  }

  function updateStatus(id){
    var req = "{{ route('settings.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data){
            //alert(data.setting.sName);
            if (data.setting.status) {
                $("#"+data.setting.id+"-stat").addClass("btn-success");
                $("#"+data.setting.id+"-stat").text("ACTIVE");
                $("#"+data.setting.id+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.setting.id+"-stat").addClass("btn-danger");
                $("#"+data.setting.id+"-stat").text("INACTIVE");
                $("#"+data.setting.id+"-stat").removeClass("btn-success");
            }
           
         }
      });
  }
  
</script>
@endsection