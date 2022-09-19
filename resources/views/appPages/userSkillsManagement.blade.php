@extends('layouts.app')

@section('title')
    <h4>Users Settings</h4>
@endsection

@section('content')
    <style>
        
        .services li{
            font-size: .75rem;
            text-decoration: none;
            color: #35404f;
            display: inline-block;
            padding: 5px 10px;
            margin: 1px;
                margin-top: 1px;
            border-radius: 4px;
            margin-top: 6px;
            background-color: transparent;
            border: outset 1px #35404f;
            transition: all 0.4s ease-in-out 0s;
            -webkit-transition: all 0.4s ease-in-out 0s;
        }
    </style>

    <div class="row"><!-- main .row -->

      <div class="col-md-5"><!-- services list start -->
        <div class="card">
            <div class="card-header">
              <img style="max-height: 150px; max-width: 100px; " src="/storage/siteImages/UserImages/{{$user->user_image}}" alt="">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-4">Name :</div>
                    <div class="col-md-8 col-8">{{$user->name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-4">Username :</div>
                    <div class="col-md-8 col-8">{{$user->username}}</div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-4">Mobile :</div>
                    <div class="col-md-8 col-8">{{$user->mobile}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-4">Email :</div>
                    <div class="col-md-8 col-8">{{$user->email}}</div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-6">
                        <button type="button" id="{{$user->uuid}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus('{{$user->uuid}}')">
                            ACTIVE
                        </button>
                    </div>
                    <div class="col-md-6 col-6">
                        @if ($user->status)
                            <button type="button" id="{{$user->uuid}}-stat" class="btn btn-success rounded btn-sm" onclick="updateStatus('{{$user->uuid}}')">
                                ACTIVE
                            </button>
                        @else 
                            <button type="button" id="{{$user->uuid}}-stat" class="btn btn-danger rounded btn-sm" onclick="updateStatus('{{$user->uuid}}')">
                                INACTIVE
                            </button>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="services" id="user-services">
                            @foreach ($user->userServices as $uService)
                                <li ><i class="{{$uService->services->icon}}"></i> {{$uService->services->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            
            
          </div>
        </div>
      </div><!-- services list End -->
    
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h4>Services List</h4></div>
                <div class="card-body">
                    <p id="resp"></p>
                  <table class="table table-striped">
                    <tr  class="thead-dark">
                      <th>Title</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($services as $service)
                        <tr>
                          <td><span><i class="{{$service->icon}}"></i></span> {{$service->title}}</td>
                          <td>{!!$service->description!!}</td>
                          <td>
                            <div class="btn-group">
                                @if(in_array( $service->id, $user->userServices->pluck('services_id')->toArray()))
                                    <button type="button" class="btn btn-warning rounded btn-sm mr-2" id="service-{{$service->id}}" onclick="assignService({{$service->id}}, '{{$user->uuid}}')">
                                        Un-Assign
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary rounded btn-sm mr-2" id="service-{{$service->id}}" onclick="assignService({{$service->id}}, '{{$user->uuid}}')">
                                        Assign
                                    </button>
                                @endif
                            </div>
                          </td>
                        </tr>
                    @endforeach
                  </table>
                </div>
            </div>
        </div><!-- services list End -->
    </div><!-- main .row END -->
    
@endsection

@section('script')
<script type="text/javascript">

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  
  function assignService(service, user){
    var req = "{{ route('users.index') }}";
    //console.log('url : '+req);
    var get = req+'/assignService/'+user;
    $.ajax({
         type:'POST',
         url: get,
         data:{service:service},
         success:function(data){
            console.log("data : "+data.data.flag);
            if (data.data.flag) {
                $("#service-"+service).addClass("btn-warning");
                $("#service-"+service).text("Un-Assign");
                $("#service-"+service).removeClass("btn-primary");
                $("#resp").removeClass("bg-warning");
                $("#resp").addClass("border rounded bg-success text-center");
                $("#resp").text(data.data.msg);
                console.log("@True : "+$("#service-"+service).text());
            } else {
                $("#service-"+service).addClass("btn-primary");
                $("#service-"+service).text("Assign");
                $("#service-"+service).removeClass("btn-warning");
                $("#resp").removeClass("bg-success");
                $("#resp").addClass("border rounded bg-warning text-center");
                $("#resp").text(data.data.msg);
                console.log("@False : #service-"+service+" - "+$("#service-"+service).text());
            }
           
         }
      });
  }
  
</script>
@endsection