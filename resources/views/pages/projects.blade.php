@extends('layouts.site')

@section('styles')
<link href="{{ asset('assets/odometer/odometer-theme-default.css') }}" rel="stylesheet">
@endsection

@section('script-head')
<script src="{{ asset('assets/odometer/odometer.js') }}" ></script>
@endsection

@section('content')

<section id="projects" style="padding-top: 120px;">
    <div class='container'>
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center shadow" style="background: transparent;">
                    <h2 ><font class="h-style">{{$title}}</font></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-12 mb-2">
                <div class="card background-dot w-100 mb-3 py-3" ><!-- style="max-width: 540px;" -->
                    <div class="row no-gutters justify-content-center text-dark">
                        <div class="col-md-2 mb-2 text-center">
                            <h1 id="odometerTotal" class="odometer font-weight-bold px-2">0</h1>
                            <p class="mb-0 text-secondary font-weight-bold">Total</p>
                        </div>

                        @foreach ($projectsStatus as $key => $value)
                            @if ($key == 1)
                            <div class="col-md-2 mb-2 text-center text-center">
                                <input type="hidden" id="completed" value="{{$value}}" />
                                <h1 id="odometer" class="odometer font-weight-bold text-success px-2">0</h1>
                                <p class="mb-0 text-secondary font-weight-bold">Completed</p>

                            </div>
                            @endif

                            @if ($key == 0)
                            <div class="col-md-2 mb-2 text-center">
                                <input type="hidden" id="ongoing" value="{{$value}}" />
                                <h1 id="odometerOngoing" class="odometer font-weight-bold text-info px-2">0</h1>
                                <p class="mb-0 text-secondary font-weight-bold">Ongoing</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


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


    </div>

</section>
<!-- Modal -->


<div class="modal modal-lg fade" id="projectDet" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="h-style modal-title fs-5" id="title">title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 mb-1 ">
                    <p class="card-text text-justify"><small class="text-dark"><b>Client :</b> <span id="clientName"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Consultant :</b> <span id="consultant"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Main Contractor :</b> <span id="mainContractor"></span></small></p>
                </div>

                <div class="col-md-6 mb-1">
                    <p class="card-text text-justify"><small class="text-dark"><b>Sub-Contractor :</b> <span id="subContractor"></span></small></p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <span class="card-text text-justify" id="description"></span>
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
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    setTimeout(function(){
        var completed = $("#completed").val();
        console.log("completed : "+completed);
        odometer.innerHTML = completed;

        if(typeof odometerOngoing!='undefined')
            odometerOngoing.innerHTML = $("#ongoing").val();
        odometerTotal.innerHTML = {{$totalProjects}};

        /*var completed = $("#completed").val();
        console.log("completed : "+completed);
        odometer.innerHTML = completed;*/
    }, 1000);

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

                    return (data)? '<p class="badge text-bg-success">COMPLETE</p>' : '<p class="badge  text-bg-info">ONGOING</p>';//'<button class="ms-badge ms-badge-primary btn btn-outline-secondary border border-secondary" style="font-size: .9rem;" onclick="getRequestInfo(\''+data+'\')">'+data+'</button>';
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

                    return '<button class="btn btn-outline-info rounded py-1 px-2" onClick="getProjectDetails(\''+data+'\')"><i class="fas fa-info"></i></button>';
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
            $('#description').empty();
            $('#title').text(data.title);
            $('#clientName').text(data.clientName);
            $('#consultant').text(data.consultant);
            $('#mainContractor').text(data.mainContractor);
            $('#subContractor').text(data.subContractor);
            $('#description').append($.parseHTML( data.description.replaceAll('&amp;','&') ));

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
</script>
@endsection
