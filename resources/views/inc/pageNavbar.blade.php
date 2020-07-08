

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-expand-lg fixed-top border-bottom"  id="navbar">
    <a class="navbar-brand" href="https://asimgc.com/"><img src="http://asimgc.com/wp-content/themes/asimgc_html/images/Asimgc_Logo_2.png" ></a>
    <button class="navbar-toggler border rounded" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="background-color: rgba(248, 248, 248, .75);">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="/app/dev" >Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('commitment') }}">Comitments</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#team" >Members</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#clients">Clients</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('gallery') }}" >Gallery</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#contact" >Contact</a>
        </li>
      </ul>

      <div id="sec-nav-to-side" style="visibility: hidden;">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#home" id="Home-m" >Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#about" id="about-m" >About</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#commitments" id="commitments-m">Comitments</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#team" id="team-m">Members</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#clients" id="clients-m" >Clients</a>
            </li>
    
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#gallery" id="gallery-m" >Gallery</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#contact" id="contact-m" >Contact</a>
            </li>
          </ul>
      </div>
      <!--
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        -->
    </div>
  </nav>