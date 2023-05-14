@extends('layouts.site')

@section('content')


<section id="gallery" style="padding-top: 120px;">
    <div class='container'>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center"><font class="h-style">Certifications</font></h2>
            </div>
        </div>
        <div class="row image-box justify-content-center gallery-show" id=”images-wrapper”>
            <ul class="list-inline gallery" id="certificates">

            </ul>
        </div>

        <div class="row justify-content-center pt-2">
            <div class="col-md-12">
                <h2 class="text-center"><font class="h-style">Photos</font></h2>
            </div>
        </div>

        <div class="row image-box justify-content-center" id=”images-wrapper”>

            <!-- Grid row -->
            <div class="gallery" id="images">

            </div>

        </div>


    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
     type:'GET',
     url:"{{ route('galleryImages') }}",
     data:{page:'index'},
     success:function(data){
       $.each(data.certificates, function(key, val){
            $('#certificates').append(gallaryImageComponent(val.image_path))
       } )

       $.each(data.gallery, function(key, val){
            $('#images').append(gallaryImageComponent(val.image_path))
       } )
     }
  });
})


function gallaryImageComponent(image_path){
    return '<li class="list-inline-item mb-2 pics animation all 2">'
                +'<a href="storage/siteImages/Gallery/'+image_path+'" class="fancybox" rel="gallery1">'
                    +'<img class="img-fluid" src="storage/siteImages/Gallery/'+image_path+'">'
                +'</a>'
            +'</li>';
}
</script>
@endsection
