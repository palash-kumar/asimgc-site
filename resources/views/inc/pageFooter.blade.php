<footer class="clients fde footer pt-4" >
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="title"><font class="h-style">Asim</font> General Contracting L.L.C.</h4>
                <p>On Shore & Off Shore Oil & Gas Fields Services</p>

            </div>
            <div class="col-sm-4">
                <h4 class="title h-style">Services</h4>
                <div class="category" style="font-size: smaller;">

                    @foreach (Session::get('services') as $service)
                        <a href="#">{{$service['title']}}</a>

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
        {{-- <hr> --}}

       <!-- <div class="row text-center"> © 2017. Made with  by sumi9xm.</div> -->
    </div>


</footer>
