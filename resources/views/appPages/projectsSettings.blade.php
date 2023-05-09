@extends('layouts.app')

@section('title')
      <h4>Projects Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <div class="card quality-card w-100 mb-3" ><!-- style="max-width: 540px;" -->
                    <div class="card-body text-body">
                        <table class="table table-sm table-striped table-responsive-sm w-100 text-light" id="projectList" style="font-size: 0.8rem;">
                            <thead class="bg-dark">
                              <tr>
                                  {{-- <th></th> --}}
                                  <th>Project</th>
                                  <th>Status</th>
                                  <th>Client</th>
                                  <th>Main Contractor</th>
                                  <th>Description</th>
                                  <th>Detail</th>
                              </tr>
                            </thead>
                            <tbody class="text-dark">

                            </thead>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- {!! Form::open(['action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-outline-danger rounded btn-sm'])}}
                    {!! Form::close() !!} --}}
      </div><!-- services list End -->

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Project</h3>
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
                        <select id='year' name='year' class="form-control">
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>'ProjectsController@index', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-gallery-form']) !!}
            <div class="row">
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
    <!-- Modal -->


<div class="modal modal-lg fade" id="projectDet" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="h-style modal-title fs-5" id="ititle">title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 mb-1 ">
                    <p class="card-text text-justify"><small class="text-dark"><b>Client :</b> <span id="iclientName"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Consultant :</b> <span id="iconsultant"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Main Contractor :</b> <span id="imainContractor"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Sub-Contractor :</b> <span id="isubContractor"></span></small></p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <span class="card-text text-justify" id="idescription"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

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
    $('#projectList').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        order: [[1, 'desc']],

        ajax: { url:"{{ route('projectList') }}",
                type:'GET',
        },
        columns: [
            { data: "title",
            render: function ( data, type, row, meta ){
                    var element= '<h6 class="h-style text-center text-primary">'+data+'</h6>';
                    //console.log('month: '+row.month);
                    //if(row.month!='null')
                        element += '<p class="card-title text-center text-info">'+((row.month!='null')? ', '+row.month:'')+((row.year!='null')? ', '+row.year:'')+'</p>'
                    return element;//'<button class="ms-badge ms-badge-primary btn btn-outline-secondary border border-secondary" style="font-size: .9rem;" onclick="getRequestInfo(\''+data+'\')">'+data+'</button>';
                }
            },
            { data: "projectStatus",
            render: function ( data, type, row, meta ){


                var view = (row.status)? '<span id="'+row.proj_id+'-stat" class="badge bg-success btn-sm" onclick="updateStatus(\''+row.proj_id+'\')">SHOW </span>' : '<span id="'+row.proj_id+'-stat" class="badge bg-danger btn-sm" onclick="updateStatus(\''+row.proj_id+'\')">HIDDEN </span>'


                    return ((data)? '<span id="'+row.proj_id+'-pstat" class="badge bg-success btn-sm mr-2" onclick="updateProjectStatus(\''+row.proj_id+'\')"> COMPLETE</span>' : '<span id="'+row.proj_id+'-pstat" class="badge bg-info btn-sm mr-2" onclick="updateProjectStatus(\''+row.proj_id+'\')">ONGOING</span>') + view;
                }
            },
            { data: "clientName",
            render: function ( data, type, row, meta ){

                    return data;
                }
            },
            { data: "mainContractor",
            render: function ( data, type, row, meta ){

                    return data;
                }
            },
            { data: "description",
            render: function ( data, type, row, meta ){

                    return data.replaceAll('&amp;amp;','&').replaceAll('&gt;','>').replaceAll('&lt;','<');
                }
            },
            { data: "proj_id",
            render: function ( data, type, row, meta ){
                    var opt = '<button type="button" class="btn btn-outline-primary rounded btn-sm mr-2" onclick="getClientDetail(\''+data+'\')"><i class="fas fa-edit"></i></button>'
                    return '<button class="btn btn-outline-info rounded py-1 px-2" onClick="getProjectDetails(\''+data+'\')"><i class="fas fa-info"></i></button>'+opt;
                }
            },
        ],
    });
});

function getProjectDetails(project){
    var req = "{{ route('users.index') }}";
    //console.log('url : '+req);
    //var get = {{ route('projectDetails') }};
    $.ajax({
         type:'POST',
         url: "{{ route('projectDetails') }}",
         data:{project:project},
         success:function(data){
            //alert(data.setting.sName);
            console.log('title: '+data.title)
            $('#idescription').empty();
            $('#ititle').text(data.title);
            $('#iclientName').text(data.clientName);
            $('#iconsultant').text(data.consultant);
            $('#imainContractor').text(data.mainContractor);
            $('#isubContractor').text(data.subContractor);
            $('#idescription').append($.parseHTML( data.description.replaceAll('&amp;','&') ));

            $('#projectDet').modal('show');
            // var response = data.original;
            // if (data.statusCode==200) {
            //     toastr[response.status](response.remarks)
            // } else {
            //     toastr[response.status](response.remarks)
            // }

         }
      });
}

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
           $("#edit-gallery").modal('show');
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
                $("#"+data.projects.proj_id+"-stat").addClass("bg-success");
                $("#"+data.projects.proj_id+"-stat").text("SHOW");
                $("#"+data.projects.proj_id+"-stat").removeClass("bg-danger");
            } else {
                $("#"+data.projects.proj_id+"-stat").addClass("bg-danger");
                $("#"+data.projects.proj_id+"-stat").text("HIDDEN");
                $("#"+data.projects.proj_id+"-stat").removeClass("bg-success");
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
                $("#"+data.projects.proj_id+"-pstat").addClass("bg-success");
                $("#"+data.projects.proj_id+"-pstat").text("COMPLETE");
                $("#"+data.projects.proj_id+"-pstat").removeClass("bg-info");
            } else {
                $("#"+data.projects.proj_id+"-pstat").addClass("bg-info");
                $("#"+data.projects.proj_id+"-pstat").text("ONGOING");
                $("#"+data.projects.proj_id+"-pstat").removeClass("bg-success");
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
