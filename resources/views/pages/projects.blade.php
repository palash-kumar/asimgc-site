@extends('layouts.site')

@section('styles')
<link href="{{ asset('assets/odometer/odometer-theme-default.css') }}" rel="stylesheet">
@endsection

@section('script-head')
<script src="{{ asset('assets/odometer/odometer.js') }}" ></script>
@endsection

@section('content')

<section id="clients" style="padding-top: 120px;">
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
            @foreach ($projects as $project)
            <div class="col-md-12 mb-2">
                <div class="card quality-card w-100 mb-3" ><!-- style="max-width: 540px;" -->
                    <div class="row no-gutters">

                        <div class="col-md-3 text-center align-self-center">
                            <!-- class="w-50 shadow border-circle"
                            /*<img class="card-img" src="/storage/siteImages/Gallery/{{$project->image_path}}" alt="Quality" class="w-50 shadow border-circle" >*/-->
                            <h5 class="h-style text-center text-primary">{{$project->title}}</h5>
                            <p class="card-title text-center text-info">@if ($project->month != null)<span>{{$project->month}},</span>@endif {{$project->year}}</p>
                            @if ($project->projectStatus)
                                <p class=" text-center badge badge-success">COMPLETE</p>
                            @else
                            <p class=" text-center badge badge-info">ONGOING</p>
                            @endif
                        </div>

                        <div class="col-md-8 ">
                            <div class="card-body text-body">
                                <div class="row justify-content-center ">
                                    @if ($project->clientName != null)
                                    <div class="col-md-6 mb-1 ">
                                        <p class="card-text text-justify"><small class="text-dark">Client : {!!$project->clientName!!}</small></p>
                                    </div>
                                    @endif

                                    @if ($project->consultant != null)
                                    <div class="col-md-6 mb-1">
                                        <p class="card-text text-justify"><small class="text-dark">Consultant : {!!$project->consultant!!}</small></p>
                                    </div>
                                    @endif

                                    @if ($project->mainContractor != null)
                                    <div class="col-md-6 mb-1">
                                        <p class="card-text text-justify"><small class="text-dark">Main Contractor : {!!$project->mainContractor!!}</small></p>
                                    </div>
                                    @endif

                                    @if ($project->subContractor != null)
                                    <div class="col-md-6 mb-1">
                                        <p class="card-text text-justify"><small class="text-dark">Sub Contractor : {!!$project->subContractor!!}</small></p>
                                    </div>
                                    @endif
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <p class="card-text text-justify">{!!$project->description!!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
@endsection

@section('script')
<script>
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

</script>
@endsection
