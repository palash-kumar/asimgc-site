@extends('layouts.app')

@section('title')
      <h4>Projects Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <!--
        <div class="card">
          <div class="card-header"><h4>Gallery Images</h4></div>
          <div class="card-body">
            @if (count($projects) > 0)
            <table class="table table-striped">
              <tr  class="thead-dark">
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
              </tr>
              @foreach ($projects as $project)
                  <tr>
                    <td> <img class="w-100" src="/storage/siteImages/Projects/{{$project->image_path}}"></td>
                    <td>
                      {{$project->title}}
                      {!!$project->description!!}
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getService({{$project->id}})">
                          Edit
                        </button>
                        {!! Form::open(['action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
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
        @if (count($projects) > 0)
          <div class="row">
            @foreach ($projects as $project)
            <div class="col-md-4 col-6 ">
              <div class="card w-100" style="width: 18rem;">
                <img class="card-img-top" src="/storage/siteImages/Projects/{{$project->image_path}}" alt="{{$project->title}}">
                <div class="card-body px-2">
                    <h5 class="card-title">{{$project->title}}</h5>
                    <p class="card-title">{{$project->type}}</p>
                    <p class="card-title">({{$project->year}}, {{$project->month}})</p>
                    <div class="btn-group">
                        @if ($project->projectStatus)
                            <button type="button" id="{{$project->id}}-pstat" class="btn btn-success rounded btn-sm mr-2" onclick="updateProjectStatus({{$project->id}})">
                                COMPLETE
                            </button>
                        @else
                            <button type="button" id="{{$project->id}}-pstat" class="btn btn-info rounded btn-sm mr-2" onclick="updateProjectStatus({{$project->id}})">
                                ONGOING
                            </button>
                        @endif

                        @if ($project->status)
                            <button type="button" id="{{$project->id}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus({{$project->id}})">
                                SHOW
                            </button>
                        @else
                            <button type="button" id="{{$project->id}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus({{$project->id}})">
                                HIDDEN
                            </button>
                        @endif
                    </div>
                  <p class="card-text">{!!$project->description!!}</p>
                  
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getClientDetail({{$project->id}})">
                      Edit
                    </button>
                    {!! Form::open(['action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
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
            {!! Form::open(['action'=>'ProjectsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
              <div class="row mb-2">
                <div class="col-md-12 col-12 pb-2">
                  <div class="fom-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="fom-group pb-2">
                        {{Form::label('type', 'Type of work')}}
                        {{Form::text('type', '', ['class'=>'form-control', 'placeholder'=>'Type of Work'])}}
                    </div>
                </div>
                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('year', 'Project Start Year')}}
                        <select id='year' name='endYear' class="form-control">
                                <option value=''>Select Year</option>
                            @foreach ($years as $key => $value) 
                                <option value='{{$value}}'>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('month', 'Project Start Month')}}
                        <select id='month' name='month' class="form-control">
                                <option value=''>Select Month</option>
                            @foreach ($months as $key => $value) 
                                <option value='{{$value}}'>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('endYear', 'Project Complete Year')}}
                        <select id='endYear' name='endYear' class="form-control">
                                <option value=''>Select End Year</option>
                            @foreach ($years as $key => $value) 
                                <option value='{{$value}}'>{{$value}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('endMonth', 'Project Complete Month')}}
                        <select id='endMonth' name='endMonth' class="form-control">
                                <option value=''>Select End Month</option>
                            @foreach ($months as $key => $value) 
                                <option value='{{$value}}'>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-12 pb-2">
                    <div class="fom-group">
                        {{Form::label('clientName', 'Client Name')}}
                        {{Form::text('clientName', '', ['class'=>'form-control', 'placeholder'=>'Client Name'])}}
                    </div>
                </div>

                <div class="col-md-12 col-12 pb-2">
                    <div class="fom-group">
                        {{Form::label('mainContractor', 'Main Contractor')}}
                        {{Form::text('mainContractor', '', ['class'=>'form-control', 'placeholder'=>'Main Contractor'])}}
                    </div>
                </div>

                <div class="col-md-12 col-12 pb-2">
                    <div class="fom-group">
                        {{Form::label('consultant', 'Consultant')}}
                        {{Form::text('consultant', '', ['class'=>'form-control', 'placeholder'=>'Consultant'])}}
                    </div>
                </div>

                <div class="col-md-12 col-12 pb-2">
                    <div class="fom-group">
                        {{Form::label('subContractor', 'Sub Contractor')}}
                        {{Form::text('subContractor', '', ['class'=>'form-control', 'placeholder'=>'Contractor'])}}
                    </div>
                </div>

                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('projectStatus', 'Project Status')}}
                        {{ Form::checkbox('projectStatus',null,null)  }}
                    </div>
                </div>
                <div class="col-md-6 col-6 pb-2">
                    <div class="fom-group">
                        {{Form::label('status', 'Show in website?')}}
                        {{ Form::checkbox('status',null,null) }}
                    </div>
                </div>
              </div>

                <div class="fom-group">
                    {{Form::label('description', 'Work Description')}}
                    {{Form::textarea('description', '', ['id'=>'description-ckeditor','class'=>'form-control', 'placeholder'=>'Work Description'])}}
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
            {!! Form::open(['action'=>'ProjectsController@index', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-gallery-form']) !!}
            <div class="col-md-12 col-12 pb-2">
                <div class="fom-group">
                  {{Form::label('etitle', 'Title')}}
                  {{Form::text('etitle', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
                </div>
              </div>

              <div class="col-md-12 col-12">
                  <div class="fom-group pb-2">
                      {{Form::label('etype', 'Type of work')}}
                      {{Form::text('etype', '', ['class'=>'form-control', 'placeholder'=>'Type of Work'])}}
                  </div>
              </div>
              <div class="col-md-6 col-6 pb-2">
                  <div class="fom-group">
                      {{Form::label('eyear', 'Project Start Year')}} <p class="text-primary">Current:<span class="text-bold"  id="seyear"></span></p>
                      <select id='eyear' name='eyear' class="form-control">
                            <option value=''>Select Year</option>
                        @foreach ($years as $key => $value) 
                            <option value='{{$value}}'>{{$value}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-md-6 col-6 pb-2">
                  <div class="fom-group">
                      {{Form::label('emonth', 'Project Start Month')}} <p class="text-primary">Current:<span class="text-bold"  id="semonth"></span></p>
                      <select id='emonth' name='emonth' class="form-control">
                            <option value=''>Select Month</option>
                        @foreach ($months as $key => $value) 
                            <option value='{{$value}}'>{{$value}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="col-md-6 col-6 pb-2">
                  <div class="fom-group">
                      {{Form::label('eendYear', 'Project Complete Year')}} <p class="text-primary">Current:<span class="text-bold"  id="seendYear"></span></p>
                      <select id='eendYear' name='endYear' class="form-control">
                            <option value=''>Select End Year</option>
                        @foreach ($years as $key => $value) 
                            <option value='{{$value}}'>{{$value}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="col-md-6 col-6 pb-2">
                  <div class="fom-group">
                      {{Form::label('eendMonth', 'Project Complete Month')}} <p class="text-primary">Current:<span class="text-bold" id="seendMonth"></span></p>
                      <select id='eendMonth' name='eendMonth' class="form-control">
                                <option value=''>Select End Month</option>
                            @foreach ($months as $key => $value) 
                                <option value='{{$value}}'>{{$value}}</option>
                            @endforeach
                        </select>
                  </div>
              </div>

              <div class="col-md-12 col-12 pb-2">
                  <div class="fom-group">
                      {{Form::label('eclientName', 'Client Name')}}
                      {{Form::text('eclientName', '', ['class'=>'form-control', 'placeholder'=>'Client Name'])}}
                  </div>
              </div>

              <div class="col-md-12 col-12 pb-2">
                  <div class="fom-group">
                      {{Form::label('emainContractor', 'Main Contractor')}}
                      {{Form::text('emainContractor', '', ['class'=>'form-control', 'placeholder'=>'Main Contractor'])}}
                  </div>
              </div>

              <div class="col-md-12 col-12 pb-2">
                  <div class="fom-group">
                      {{Form::label('econsultant', 'Consultant')}}
                      {{Form::text('econsultant', '', ['class'=>'form-control', 'placeholder'=>'Consultant'])}}
                  </div>
              </div>

              <div class="col-md-12 col-12 pb-2">
                  <div class="fom-group">
                      {{Form::label('esubContractor', 'Sub Contractor')}}
                      {{Form::text('esubContractor', '', ['class'=>'form-control', 'placeholder'=>'Contractor'])}}
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
    
    var req = "{{ route('projects.index') }}",
    //console.log('url : '+req);
    get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url:get,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.projects.title);
           $('#etype').val(data.projects.type);
           $('#seyear').text(data.projects.year);
           $('#semonth').text(data.projects.month);
           $('#seendYear').text(data.projects.endYear);
           $('#seendMonth').text(data.projects.endMonth);

           $('#eclientName').val(data.projects.clientName);
           $('#emainContractor').val(data.projects.mainContractor);
           $('#econsultant').val(data.projects.consultant);
           $('#esubContractor').val(data.projects.subContractor);

           $('#edescription-ckeditor').val(data.projects.description);
           console.log("Description : "+data.projects.description);
           $("#edit-gallery-form").attr('action', req+'/'+id);
           $("#edit-gallery").modal();
         }
      });
  }

  function updateStatus(id){
    var req = "{{ route('projects.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data, status){
             console.log("Status code : "+status);
            //alert(data.setting.sName);
            if (data.projects.status) {
                $("#"+data.projects.id+"-stat").addClass("btn-success");
                $("#"+data.projects.id+"-stat").text("SHOW");
                $("#"+data.projects.id+"-stat").removeClass("btn-danger");
            } else {
                $("#"+data.projects.id+"-stat").addClass("btn-danger");
                $("#"+data.projects.id+"-stat").text("HIDDEN");
                $("#"+data.projects.id+"-stat").removeClass("btn-success");
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
  


  function updateProjectStatus(id){
    var req = "{{ route('projects.index') }}";
    //console.log('url : '+req);
    var get = req+'/updateProjectStatus/'+id;
    $.ajax({
         type:'POST',
         url: get,
         //data:{id:id},
         success:function(data, status){
             console.log("Status code : "+status);
            //alert(data.setting.sName);
            if (data.projects.projectStatus) {
                $("#"+data.projects.id+"-pstat").addClass("btn-success");
                $("#"+data.projects.id+"-pstat").text("COMPLETE");
                $("#"+data.projects.id+"-pstat").removeClass("btn-info");
            } else {
                $("#"+data.projects.id+"-pstat").addClass("btn-info");
                $("#"+data.projects.id+"-pstat").text("ONGOING");
                $("#"+data.projects.id+"-pstat").removeClass("btn-success");
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