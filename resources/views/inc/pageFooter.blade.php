<section class="clients fde footer pt-5"  id="contact">
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="title"><font class="h-style">Asim</font> General Contracting L.L.C.</h4>
                <p>On Shore & Off Shore Oil & Gas Fields Services</p>

            </div>
           <!-- <div class="col-sm-3">
                <h4 class="title">My Account</h4>
                <span class="acount-icon">
            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> Wish List</a>
            <a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i> Cart</a>
            <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
            <a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Language</a>
          </span>
            </div>-->
            <div class="col-sm-4">
                <h4 class="title h-style">Activities</h4>
                <div class="category" style="font-size: smaller;">
                    @foreach ($services as $service)
                        <a href="#">{{$service->title}}</a>
                    @endforeach
                    
                </div>
            </div>
            <div class="col-sm-4">
                <h4 class="title">Contact <font class="h-style">Us</font></h4>
                <p></p>
                <ul class="payment disabled">
                    <li><a href=""><i class="fas fa-mobile-alt" aria-hidden="true"></i>&nbsp; +97150-5429536</a></li>
                    <li><a href=""><i class="fas fa-phone" aria-hidden="true"></i> +9712-5833254</a></li>
                    <li><a href=""><i class="fas fa-fax" aria-hidden="true"></i> +9712-5833278</a></li>
                    <li><a href=""><i class="far fa-envelope" aria-hidden="true"></i> Po Box: 25780, Abu Dhabi U.A.E</a></li>
                    <li><a href="mailto:as@asimgc.com"><i class="fas fa-at" aria-hidden="true"></i> as@asimgc.com</a></li>
                    <li><a href="mailto:as.asim@ymail.com"><i class="fas fa-at" aria-hidden="true"></i> as.asim@ymail.com</a></li>
                </ul>
            </div>
        </div>
        <hr>

       <!-- <div class="row text-center"> © 2017. Made with  by sumi9xm.</div> -->
    </div>


</section>