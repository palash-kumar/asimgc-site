@extends('layouts.app')

@section('title')
    <h4>Designations Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <div class="card">
          <div class="card-header"><h4>Designations List</h4></div>
          <div class="card-body">
            <table class="table table-sm table-striped table-responsive-sm">
              <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Designation Sequence</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <thead>
                @foreach ($designations as $designation)
                    <tr>
                    <td><span></span> {{$designation->title}}</td>
                    <td>
                        {!! Form::open(['action'=>['DesignationsController@updateDisplaySeq', $designation->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','PUT')}}
                            <div class="fom-group">
                                <div class="input-group mb-3">
                                    {{Form::label('display_seq', 'Display Seq.')}}
                                    <select id='display_seq-{{$designation->id}}' name='display_seq-{{$designation->id}}' class="form-control w-50" required>
                                        
                                            <option value=''>Select Sequence of display</option>
                                        @for ($i = 1; $i <= 6; $i++)
                                            @if ($designation->display_seq == $i)
                                                <option value='{{$i}}' selected>{{$i}}</option>
                                            @else
                                                <option value='{{$i}}'>{{$i}}</option>
                                            @endif
                                            
                                        @endfor
                                            
                                        
                                    </select>
                                    <div class="input-group-append">
                                        
                                        {{Form::submit('Update',['class'=>'btn btn-success rounded btn-sm input-group-text'])}}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if ($designation->status)
                            <button type="button" id="{{$designation->id}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus({{$designation->id}})">
                                ACTIVE
                            </button>
                        @else 
                            <button type="button" id="{{$designation->id}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus({{$designation->id}})">
                                INACTIVE
                            </button>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getDesignation({{$designation->id}})">
                            Edit
                            </button>
                            {!! Form::open(['action'=>['DesignationsController@destroy', $designation->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
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
            <h4>Add Designation</h4>
          </div>
          <div class="card-body">
            {!! Form::open(['action'=>'DesignationsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-12 col-12 mb-2">
                        <div class="fom-group">
                            {{Form::label('title', 'Designation Title')}}
                            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Designation Title'])}}
                        </div>
                    </div>
                    <div class="col-md-12 col-12 mb-2">
                        <div class="fom-group">
                            {{Form::label('display_seq', 'Display Seq')}}
                            <select id='display_seq' name='display_seq' class="form-control" required>
                                <option value=''>Select Sequence of display</option>
                            @for ($i = 1; $i <= 6; $i++)
                                <option value='{{$i}}'>{{$i}}</option>
                            @endfor
                        </select>
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
            {!! Form::open(['action'=>['DesignationsController@index'], 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-setting-form']) !!}
                <div class="row mb-2">
                    <div class="col-md-6 col-6">
                      <div class="fom-group">
                          {{Form::label('etitle', 'Designation Name')}}
                          {{Form::text('etitle', '', ['class'=>'form-control', 'placeholder'=>'Designation Name'])}}
                      </div>
                    </div>
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

  function getDesignation(id){
    var req = "{{ route('designations.index') }}";
    //console.log('url : '+req);
    var get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url: get,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.designation.title);
           // alert(data.service.title);
           $("#edit-setting-form").attr('action', req+'/'+id);
           $("#edit-setting").modal();
         }
      });
  }

  function updateStatus(id){
    var req = "{{ route('designations.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data){
            //alert(data.setting.sName);
            if (data.designation.status) {
                $("#"+data.designation.id+"-stat").addClass("btn-success");
                $("#"+data.designation.id+"-stat").text("ACTIVE");
                $("#"+data.designation.id+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.designation.id+"-stat").addClass("btn-danger");
                $("#"+data.designation.id+"-stat").text("INACTIVE");
                $("#"+data.designation.id+"-stat").removeClass("btn-success");
            }
           
         }
      });
  }
  
</script>
@endsection