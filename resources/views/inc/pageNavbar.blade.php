

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-expand-lg fixed-top border-bottom "  id="navbar">
    <a class="navbar-brand" href="https://dev.asimgc.com/"><img src="/storage/siteImages/{{Session::get('companySettigs')['logo']}}" alt="{{ config('app.name', 'Laravel') }}"></a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


    <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="/" >Home</a>
        </li>
        <!--
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
        </li>
        -->
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('commitment') }}">Comitments</a>
        </li>
        <!--
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#team" >Members</a>
        </li>
        -->
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('clients') }}">Clients</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('projects') }}">Projects</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ route('gallery') }}" >Gallery</a>
        </li>
        <!--
        <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="#team" >Members</a>
        </li>
        -->
      </ul>
      <!--
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

            <li class="nav-item active">
                <a class="nav-link js-scroll-trigger" href="#contact" id="contact-m" >Contact</a>
            </li>
          </ul>
      </div>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        -->
    </div>
  </nav>
