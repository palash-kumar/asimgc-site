@extends('layouts.site')

@section('content')
<section id="safety" style="padding-top: 100px;">
    <div class="container pt-2">
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center shadow" style="background: transparent;">
                    <h2 >Our <font class="h-style">Commitment</font></h2>
                </div>
            </div>
        </div>
        <div class="row content-center" id="commitments">
            @php ($i = 0)
            @foreach ($commitments as $commitment)
            <div class="col-md-12 col-sm-12  col-12 order-last px-2" data-aos="flip-left">
                <div class="card quality-card w-100 mb-3" ><!-- style="max-width: 540px;" -->
                    <div class="row no-gutters">
                    
                        <div class="col-md-3  align-self-center @if ($i%2 == 0)order-md-1 @endif @if ($i%2 != 0)order-md-2 offset-md-1 @endif">
                            <!-- class="w-50 shadow border-circle" -->
                            <img class="card-img" src="/storage/siteImages/Gallery/{{$commitment->image_path}}" alt="Quality" class="w-50 shadow border-circle" >
                        </div>
                    
                    
                        <div class="col-md-8 @if ($i%2 == 0)offset-md-1  order-md-2 @endif @if($i%2 != 0) order-md-1 @endif ">
                    
                            <div class="card-body text-body">
                                <h5 class="card-title text-center"><span class="h-style">{{$commitment->title}}</span></h5>
                                <p class="card-text text-justify">{{$commitment->description}}</p>
                                <p class="card-text text-justify">{!!$commitment->detail!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php ($i ++)
            @endforeach
        </div>
    </div>
</section>
@endsection