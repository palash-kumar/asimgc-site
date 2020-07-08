@extends('layouts.site')

@section('content')


<section id="gallery" style="padding-top: 120px;">
    <div class='container'>
        @if (count($certificates) > 0)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center"><font class="h-style">Certifications</font></h2>
            </div>
        </div>
        <div class="row image-box justify-content-center gallery-show" id=”images-wrapper”>
            <!-- Grid row -->
            <div class="gallery" id="gallery">
                <!-- Grid column -->
                @foreach ($certificates as $image)
                <div class="mb-3 pics animation all 2">
                    <a href="storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox" rel="gallery1">
                        <img class="img-fluid" src="storage/siteImages/Gallery/{{$image->image_path}}">
                    </a>
                </div>
                @endforeach
                <!-- Grid column -->
            </div> 
            
        </div>
        @endif

        @if (count($gallery) > 0)
        <div class="row justify-content-center pt-2">
            <div class="col-md-12">
                <h2 class="text-center"><font class="h-style">Photos</font></h2>
            </div>
        </div>
        <div class="row image-box justify-content-center" id=”images-wrapper”>

            <!-- Grid row -->
            <div class="gallery" id="gallery">
                <!-- Grid column -->
                @foreach ($gallery as $image)
                <div class="mb-3 pics animation all 2">
                    <a href="storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox" rel="gallery1">
                        <img class="img-fluid" src="storage/siteImages/Gallery/{{$image->image_path}}">
                    </a>
                </div>
                @endforeach
                <!-- Grid column -->
            </div>                    
            
        </div>
        @endif

        
    </div>
</section>
@endsection