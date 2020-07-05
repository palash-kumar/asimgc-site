@extends('layouts.site')

@section('content')
<section id="safety" style="padding-top: 120px;">
    <div class='container'>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center">{{$companySettings->title}}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{$companySettings->description}}
            </div>
        </div>
    </div>
</section>
@endsection