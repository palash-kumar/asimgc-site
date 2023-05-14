@extends('layouts.site')

@section('styles')
<link href="{{ asset('assets/odometer/odometer-theme-default.css') }}" rel="stylesheet">
@endsection

@section('script-head')
<script src="{{ asset('assets/odometer/odometer.js') }}" ></script>
@endsection

@section('content')

<section id="clients" style="padding-top: 120px;">
    <div class='container'>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="well text-center shadow" style="background: transparent;">
                    <h2 ><font class="h-style">{{$title}}</font></h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <ul class="list-inline" id="clientsls">

                </ul>
            </div>
        </div>
    </div>

</section>
@endsection

@section('script')
<script>
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

</script>
@endsection
