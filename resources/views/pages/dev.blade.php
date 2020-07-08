@extends('layouts.dev')

@section('content')

@include('pageComponents.carousel')
    
<!-- About================================================== -->
<section class="about-sec parallax-section fde" id="about" >
    <div class="container pt-5">
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
                        <h1>Our <font class="h-style">Services</font></h1>
                        <div class="category">
                            @foreach ($services as $service)
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
<section id="safety" class="fde">
    <div class="container pt-5">
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center shadow" style="background: transparent;">
                    <h2 >Our <font class="h-style">Commitment</font></h2>
                </div>
            </div>
        </div>
        <div class="row content-center" id="commitments">
            @foreach ($commitments as $commitment)
            <div class="col-md-6 col-sm-6  col-6 px-1" data-aos="flip-left">
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
                        <center><a href=" https://asimgc.com/quality/" class="btn btn-info w-100" role="button">More Details <i class="fas fa-angle-right"></i></a></center>
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
<section id="self" class="fde">
    <div class="container pt-5">
        <div class="row ">
            <div class="col-md-12">
                <div class="well text-center shadow">
                    <h2>The <font class="h-style">Members</font></h2>
                </div>
            </div>
        </div>

        <div class="row content-center mt-2 mb-2" id="team">
            <div class="col-md-4">
                <div class="card team-card border-0 shadow">
                    <div class="row">
                        <div class="col-md-4 col-4 p-0">
                            <img class="w-100 rounded-left" src="http://asimgc.com/wp-content/themes/asimgc_html/images/Asim.jpg" alt="">
                        </div>
                        <div class="col-md-8 col-8 align-self-center text-light p-1">
                            <h6 class="title text-center h-style">Mr. Asim Chandra Nath</h6>
                            <p class="text-center" style="color: #add8e6;"><i>Chairman</i></p>
                            <p class="text-center">Email: <b>as.asim@ymail.com</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content-center mt-2 mb-2">
            <div class="col-md-4">
                <div class="card team-card border-0 shadow">
                    <div class="row">
                        <div class="col-md-4 col-4 p-0">
                            <img class="w-100 rounded-left" src="http://asimgc.com/wp-content/themes/asimgc_html/images/Subash.jpg" alt="">
                        </div>
                        <div class="col-md-8 col-8 align-self-center text-light p-1">
                            <h6 class="title text-center h-style">Mr. Subash Chandra Nath</h6>
                            <p class="text-center" style="color: #add8e6;"><i>Business Development Manager</i></p>
                            <p class="text-center">Email: <b>subash.asim@yahoo.com</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="row content-center mb-2" >

            <div class="col-md-3 col-sm-6  col-6">
                <div class="our-team" id="team">
                    <div class="pic" style="height: 250px">
                        <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Asim.jpg" alt="">
                        <!--    <ul class="social">
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            </ul> -- >
                    </div>
                    <div class="team-content">
                        <h5 class="title">Mr. Asim Chandra Nath</h5>
                        <small class="post"><i>Chairman</i></small>
                        <small>Email: <b>as.asim@ymail.com</b></small>
                    </div>
                    <div class="team-layer">
                        <a href="#">Mr. Asim Chandra Nath</a>
                        <span class="post">Chairman</span>
                    </div>
                </div>
            </div>

            
        </div>-->
        
        <!--<div class="row content-center mt-2">
            <div class="col-md-3 col-sm-6  col-6">
                <div class="our-team">
                    <div class="pic" style="height: 250px">
                        <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Subash.jpg" alt="">
                        <!--   <ul class="social">
                               <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                               <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                               <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                           </ul> -- >
                    </div>
                    <div class="team-content">
                        <h5 class="title">Mr. Subash Chandra Nath</h5>
                        <small class="post"><i>Business Development Manager</i></small>
                        <small>Email: <b>subash.asim@yahoo.com</b></small>
                    </div>
                    <div class="team-layer">
                        <a href="#">Mr. Subash Chandra Nath</a>
                        <span class="post">Business Development Manager</span>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</section>
<!-- ./self ================================================== -->
<!-- Clients ================================================== -->
<section class="clients fde" id="clients" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-center shadow">
                    <h2>Our <font class="h-style">Clients</font></h2>
                </div>
            </div>
        </div>
        <div class="row" id="clientss">
            @foreach ($clients as $client)
            <div class="col-6 col-md-3 my-1">
                <div class="card">
                    <img class="card-img-top" src="/storage/siteImages/Clients/{{$client->image_path}}" height="100px">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ./Clients End ================================================== -->
<style>
    .mdb-lightbox.no-margin [class*="col-"] {
        padding: 0;
    }

    .mdb-lightbox figure {
        float: left;
        margin: 0;
    }
</style>
<section class="action-sec fde pt-5" id="gallery">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="well text-center shadow">
                    <h2><font class="h-style">Gallery</font></h2>
                </div>
            </div>
        </div>

        <!-- -->
        <div class="row">
            <div class="col-md-12">
          
              <div id="mdb-lightbox-ui"></div>
          
              <div class="mdb-lightbox no-margin">
                @if (count($frontGalery) > 0)
                    @foreach ($frontGalery as $image)
                        <figure class="col-md-3">
                            <a href="/storage/siteImages/Gallery/{{$image->image_path}}" data-size="1600x1067">
                                <img alt="picture" src="/storage/siteImages/Gallery/{{$image->image_path}}"
                                  class="img-fluid" />
                              </a>
                          </figure>
                    @endforeach

                    @foreach ($gallery as $image)
                        <figure class="col-md-3">
                            <a href="/storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox shadow" data-size="1600x1067" rel="gallery1">
                                <img alt="picture" src="/storage/siteImages/Gallery/{{$image->image_path}}"
                                  class=" img-fluid" />
                              </a>
                          </figure>
                    @endforeach
                @endif
              </div>
          
            </div>
        </div>
        <!-- -->
        
        <!--<div class="row image-box justify-content-center" id=”images-wrapper”>
            <div class="col-md-12 text-center">
                @if (count($frontGalery) > 0)
                    @foreach ($frontGalery as $image)
                        <a href="/storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox shadow" rel="gallery1">
                            <img src="/storage/siteImages/Gallery/{{$image->image_path}}" class="zoom img-fluid "  alt="">
                        </a>
                    @endforeach
                @endif
                
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ASIMGC 23MAY2021.jpg" class="fancybox shadow" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ASIMGC 23MAY2021.jpg" class="zoom img-fluid "  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO 14001-2015 14MAY2022-page-001.jpg" class="fancybox shadow" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO 14001-2015 14MAY2022-page-001.jpg" class="zoom img-fluid "  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO 9001.2015 04-APRIL-2022.jpg" class="fancybox shadow" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO 9001.2015 04-APRIL-2022.jpg" class="zoom img-fluid "  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO OHSAS 18001-2007  14MAY22EMS.jpg" class="fancybox shadow" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/cert-2k20/ISO OHSAS 18001-2007  14MAY22EMS.jpg" class="zoom img-fluid "  alt="">
                </a>
                <!--
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/License.jpg" class="fancybox" rel="ligthbox">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/License.jpg" class="zoom img-fluid "  alt="">
                </a>-- >
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/TRN.jpg" class="fancybox" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/TRN.jpg" class="zoom img-fluid "  alt="">
                </a><!--
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/Environment.jpg" class="fancybox" rel="ligthbox">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/Environment.jpg" class="zoom img-fluid "  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/OHS.jpg"  class="fancybox" rel="ligthbox">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/OHS.jpg" class="zoom img-fluid"  alt="">
                </a>-- >
                
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/site1.png" class="fancybox" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/site1.png" class="zoom img-fluid "  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190423_155014_C.jpg"  class="fancybox" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190423_155014_C.jpg" class="zoom img-fluid"  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190326_140154_C.jpg"  class="fancybox" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190326_140154_C.jpg" class="zoom img-fluid"  alt="">
                </a>
                <a href="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190326_140105_C.jpg"  class="fancybox" rel="gallery1">
                    <img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Gallery/20190326_140105_C.jpg" class="zoom img-fluid"  alt="">
                </a>
            </div>
        </div>-->


        

        


    </div>
</section>

<script>
    // MDB Lightbox Init
    $(function () {
        $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
    });
</script>
@endsection