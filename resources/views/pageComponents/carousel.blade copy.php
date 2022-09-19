<section id="home" class="fde">
    <div id="carouselExampleControls" class="carousel fade-carousel slide" data-ride="carousel">
        <div class="carousel-inner ">
          @foreach ($slider as $image)
              <a href="storage/siteImages/Gallery/{{$image->image_path}}" class="fancybox" rel="gallery1">
                  <img src="storage/siteImages/Gallery/{{$image->image_path}}" class="zoom img-fluid "  alt="">
              </a>
              <div class=" carousel-item slides active">
                <div class="slide-1" style="background:linear-gradient( rgba( 52, 152, 219, 0.35), rgba( 52, 152, 219, 0.35)), url(storage/siteImages/Gallery/{{$image->image_path}}) no-repeat fixed center; background-size: cover;"></div>
                <div class="hero">
                    <hgroup>
                    <h1>{{$image->title}}</h1>
                        <h2><font class="h-style">{!!$image->description!!}</font></h2>
                    </hgroup>
                    <!-- <button class="btn btn-hero btn-lg" role="button">See all features</button> -->
                </div>
              </div>
          @endforeach
          <div class=" carousel-item slides active">
            <div class="slide-1" style="background:linear-gradient( rgba( 52, 152, 219, 0.35), rgba( 52, 152, 219, 0.35)), url(/storage/siteImages/ma_ride.jpg) no-repeat fixed center; background-size: cover;"></div>
            <div class="hero">
                <hgroup>
                    <h1>We are Always</h1>
                    <h2><font class="h-style">dedicated & devoted</font></h2>
                </hgroup>
                <!-- <button class="btn btn-hero btn-lg" role="button">See all features</button> -->
            </div>
          </div>
          <div class="carousel-item slides">
            <div class="slide-1"></div>
            <div class="hero">
                <hgroup>
                    <h1>We are Always</h1>
                    <h2><font class="h-style">dedicated & devoted</font></h2>
                </hgroup>
                <!-- <button class="btn btn-hero btn-lg" role="button">See all features</button> -->
            </div>
          </div>
          <div class="carousel-item slides">
            <div class="slide-1"></div>
            <div class="hero">
                <hgroup>
                    <h1>We are Always</h1>
                    <h2><font class="h-style">dedicated & devoted</font></h2>
                </hgroup>
                <!-- <button class="btn btn-hero btn-lg" role="button">See all features</button> -->
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    

    
</section>