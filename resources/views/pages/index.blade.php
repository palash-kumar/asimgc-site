@extends('layouts.site')

@section('styles')
<link href="{{ asset('assets/odometer/odometer-theme-default.css') }}" rel="stylesheet">
@endsection

@section('script-head')
<script src="{{ asset('assets/odometer/odometer.js') }}" ></script>
@endsection

@section('content')

@include('pageComponents.carousel')

<!-- About================================================== -->
<section class="about-sec parallax-section fde" id="about" >
    <div class="container py-3">
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in-left">
                <h2 class="animated bounceInRight delay-1s"><small style="color: rgba(35, 35, 35, .5) !important;">Who We Are</small> About
                    <p class="h-style">
                        US!
                    </p>
                </h2>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12" data-aos="zoom-in-left">

                        <p class="animated lightSpeedIn delay-2s"><span class="h-style">Asim</span> General Contracting LLC is established in 2006. The organization is focusing its service on Site facilities, plunving, fire fighting, fire sprinkler, electrical work, civil work, supply of materials, equipments and mechanical, undertaking sub-contracting works on contract basis.</p>
                        <p class="animated lightSpeedIn delay-2s">The team contains vast experience of knowledge on various major projects throughout U.A.E. with 100% successful rate and client satisfaction</p>
                        <a class="animated lightSpeedIn delay-2s" href="javascript:void(0);" data-toggle="modal" data-target="#asimgcProfile">Learn more about us...</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1><font class="h-style">Services</font></h1>
                        <div class="category">
                            @foreach (Session::get('services') as $service)
                                <p data-aos="zoom-in-left" data-aos-delay="450"><i class="{{$service->icon}}"></i> {{$service->title}}</p>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> -->

    <div class="modal fade bd-example-modal-lg h-100 " tabindex="-1" role="dialog" aria-labelledby="companyProfile" aria-hidden="true" id="asimgcProfile">
      <div class="modal-dialog modal-lg h-85">
        <div class="modal-content h-100">
          <div class="modal-header">
              <div class="row">
                  <div class="col-md-11 col-sm-11 col-xs-11">
                        <h2 class="modal-title">Company Profile</h2>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
              </div>
          </div>
          <div class="modal-body h-85">
            <object class="w-100 h-100" data="http://asimgc.com/wp-content/themes/asimgc_html/images/profile/ASIM GC LLC 2020-profile.pdf" type="application/pdf">
                <iframe class="pdf_documents" src="http://asimgc.com/wp-content/themes/asimgc_html/images/profile/ASIM GC LLC 2020-profile.pdf"></iframe>
            </object>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- ./About End ================================================== -->

<!-- safety ================================================== -->
<section id="safety" class="fde" data-aos="fade-left" >
    <div class="container py-3">
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center " style="background: transparent;">
                    <h2 ><font class="title-style shadow-sm">Commitment</font></h2>
                </div>
            </div>
        </div>
        <div class="row content-center" id="commitments">
            @foreach ($commitments as $commitment)
            <div class="col-md-6 col-sm-6  col-6 px-1" data-aos="flip-left" data-aos-delay="450">
                <div class="card quality-card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                    <div class="col-md-4 align-self-center">
                        <!-- class="w-50 shadow border-circle" -->
                        <img class="card-img" src="/storage/siteImages/Gallery/{{$commitment->image_path}}" alt="Quality" class="w-50 shadow border-circle" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-body">
                        <h5 class="card-title text-center"><span class="h-style">{{$commitment->title}}</span></h5>
                        <p class="card-text text-justify">{{$commitment->description}}</p>
                        <center><a href="{{ route('commitment') }}" class="btn btn-info w-100" role="button">More Details <i class="fas fa-angle-right"></i></a></center>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ./safety ================================================== -->
<!-- self ================================================== -->
<section id="self" class="fde" data-aos="fade-right">
    <div class="container py-3">
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center ">
                    <h2><font class="title-style shadow-sm">Members</font></h2>
                </div>
            </div>
        </div>
        <div class="row content-center mt-2 mb-2" id="team-1" data-aos="fade-left">

        </div>
        <div class="row content-center mt-2 mb-2" id="team-3" data-aos="fade-left">

        </div>
        <div class="row content-center mt-2 mb-2" id="team-2" data-aos="fade-left">

        </div>

    </div>
</section>
<!-- ./self ================================================== -->
<!-- Clients ================================================== -->
<section class="clients fde" id="clients" data-aos="fade-right">
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-center shadow">
                    <h2><font class="title-style ">Clients</font></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" id="clientss">
            <div class="col-md-11 mt-2">
                <ul class="list-inline" id="clientsls">

                </ul>
            </div>
        </div>
    </div>
</section>
<!-- ./Clients End ================================================== -->

<!-- Projects ================================================== -->
<section class="  fde" data-aos="fade-left" id="projects" >
    <div class="container py-5" id="projects-div">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-center ">
                    <h2><font class="title-style shadow-sm">Projects</font></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-12 mb-2">
                <div class=" w-100 mb-3 py-3 background-dot" ><!-- style="max-width: 540px;" -->
                    <div class="row no-gutters  justify-content-center text-dark" id="project-stats">


                        @foreach ($projectsStatus as $key => $value)
                            <div class="col-md-2 mb-2 text-center">
                                <input type="hidden" id="total" value="{{$value}}" />
                                <h1 id="odometerTotal" class="odometer font-weight-bold px-2">0</h1>
                                <p class="mb-0 text-secondary font-weight-bold">Total</p>
                            </div>
                            @if ($key == 1)
                            <div class="col-md-2 mb-2 text-center text-center">
                                <input type="hidden" id="completed" value="{{$value}}" />
                                <h1 id="odometer" class="odometer font-weight-bold text-success px-2">0</h1>
                                <p class="mb-0 text-secondary font-weight-bold">Completed</p>

                            </div>
                            @endif

                            {{-- @if ($key == 0)
                            <div class="col-md-2 mb-2 text-center">
                                <input type="hidden" id="ongoing" value="{{$value}}" />
                                <h1 id="odometerOngoing" class="odometer font-weight-bold text-info px-2">0</h1>
                                <p class="mb-0 text-secondary font-weight-bold">Ongoing</p>
                            </div>
                            @endif --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ./Projects End ================================================== -->
<section class="action-sec fde" id="gallery" data-aos="fade-right">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center ">
                    <h2><font class="title-style shadow-sm">Gallery</font></h2>
                </div>
            </div>
        </div>

        <!-- -->
        <div class="row">
            <div class="col-md-12">

              <div id="mdb-lightbox-ui"></div>

              <div class='container'>
                @if (count($certificates) > 0)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2 class="text-center"><font class="h-style shadow-sm">Certifications</font></h2>
                    </div>
                </div>
                <div class="row image-box justify-content-center" id=”images-wrapper”>
                    <ul class="list-inline gallery" id="certificates">

                    </ul>

                </div>
                @endif

                @if (count($frontGalery) > 0)
                <div class="row justify-content-center pt-2">
                    <div class="col-md-12">
                        <h2 class="text-center"><font class="h-style">Photos</font></h2>
                    </div>
                </div>
                <div class="row image-box justify-content-center" id=”images-wrapper”>

                    <!-- Grid row -->
                    <div class="gallery" >
                        <!-- Grid column -->
                        @foreach ($frontGalery as $image)
                        <div class="mb-2 pics animation all 2">
                            <a href="/storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox" rel="gallery1">
                                <img class="img-fluid" src="/storage/siteImages/Gallery/{{$image->image_path}}">
                            </a>
                        </div>
                        @endforeach
                        <!-- Grid column -->
                    </div>

                </div>
                @endif


            </div>


    </div>
</section>

@endsection

@section('script')
<script>
    // MDB Lightbox Init
    $(function () {
        $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });

    $(window).scroll(function() {
        var hT = $('#project-stats').offset().top,
            hH = $('#project-stats').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
            //console.log((hT-wH) , wS);
        if (wS > (hT+hH-wH)){
            //$('#project-stats').fadeIn(3500);
            setTimeout(function(){
                var completed = $("#completed").val();
                //console.log("completed : "+completed);
                //console.log("totalProjects : "+{{$totalProjects}});
                odometer.innerHTML = completed;
                odometerTotal.innerHTML = {{$totalProjects}};
                //odometerOngoing.innerHTML = $("#ongoing").val();
                //odometerTotal
                /*var completed = $("#completed").val();
                console.log("completed : "+completed);
                odometer.innerHTML = completed;*/
            }, 500);
        }
    });

    $(document).ready(function() {
        var req = "{{ route('clientsls') }}"
    //console.log('url : '+req);
    //get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url:req,
         //data:{id:id},
         success:function(data){
            var element = '';
            $.each( data, function( key, value ) {
                element = '<li class="list-inline-item mb-1">'
                            +'<div class="card">'
                            +'<img class="card-img-top" src="/storage/siteImages/Clients/'+value.image_path+'" height="100px">'
                            +'</div>'
                        +'</li>';

                        $('#clientsls').append(element);
            });

         }
      });
    })

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
        },
        complete: function(data){
            console.log('Images are loaded');
            $(".fancybox").fancybox();

            $("[rel='tooltip']").tooltip();
            $(".fde").css('display', 'none');
            $(".fde").fadeIn(2000);

        }
    });

        $.ajax({
                type:'GET',
                url:"{{ route('index') }}",
                success:function(data){
                $.each(data, function(key, val){
                    $('#team-'+val.order_by).append(memberCard(val));
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

    function loadMembers(){

    }

    function memberCard(member){
        return '<div class="col-md-4">'
            +'<div class="card team-card border-0 shadow">'
                +'<div class="row">'
                    +'<div class="col-md-4 col-4 p-0">'
                        +'<img class="w-100 rounded-left" src="/storage/siteImages/UserImages/'+member.user_image+'" alt="">'
                    +'</div>'
                    +'<div class="col-md-8 col-8 align-self-center p-1">'
                    +'<h6 class="title text-center h-style">'+member.name+'</h6>'
                        +'<p class="text-center mb-1" ><i>'+((member.designations_id != 'null')? member.designation.title: 'Not Designated')+'</i></p>'
                        +'<p class="text-center mb-1"><b>'+member.email+'</b></p>'
                    +'</div>'
                +'</div>'
            +'</div>'
        +'</div>'
    }

</script>
@endsection
