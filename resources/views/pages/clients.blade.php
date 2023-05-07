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

        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <ul class="list-inline">
                    @foreach ($clients as $client)
                    <li class="list-inline-item mb-1">
                        <div class="card">
                            <img class="card-img-top" src="/storage/siteImages/Clients/{{$client->image_path}}" height="100px">
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

</section>
@endsection

@section('script')
<script>
    setTimeout(function(){
        // var completed = $("#completed").val();
        // console.log("completed : "+completed);
        // odometer.innerHTML = completed;

        // if(typeof odometerOngoing!='undefined')
        //     odometerOngoing.innerHTML = $("#ongoing").val();
        // odometerTotal.innerHTML = '';

        /*var completed = $("#completed").val();
        console.log("completed : "+completed);
        odometer.innerHTML = completed;*/
    }, 1000);

</script>
@endsection
