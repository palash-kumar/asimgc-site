@extends('layouts.app')

@section('title')
      <h4>Gallery Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-8"><!-- services list start -->
        <!--
        <div class="card">
          <div class="card-header"><h4>Gallery Images</h4></div>
          <div class="card-body">
            @if (count($gallery) > 0)
            <table class="table table-striped">
              <tr  class="thead-dark">
                <th>Image</th>
                <th>Description</th>
                <th>Marked As</th>
                <th>Status</th>
              </tr>
              @foreach ($gallery as $image)
                  <tr>
                    <td> <img class="w-100" src="/storage/siteImages/Gallery/{{$image->image_path}}"></td>
                    <td>
                      {{$image->title}}
                      {!!$image->description!!}
                    </td>
                    <td>
                      {{$image->imageCategory->title}}
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getService({{$image->id}})">
                          Edit
                        </button>
                        {!! Form::open(['action'=>['ServicesController@destroy', $image->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                            {{Form::hidden('_method','DELETE')}}
                            {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                        {!! Form::close() !!}
                      </div>
                    </td>
                  </tr>
              @endforeach
            </table>
            @else
                <p>No Images Found</p>
            @endif
          </div>
        </div>
        -->
        @if (count($gallery) > 0)
          <div class="row">
            @foreach ($gallery as $image)
            <div class="col-md-4 col-6 ">
              <div class="card w-100" style="width: 18rem;">
                <img class="card-img-top" src="/storage/siteImages/Gallery/{{$image->image_path}}" alt="{{$image->title}}">
                <div class="card-body px-2">
                <h5 class="card-title">{{$image->title}} <small class="text-info">({{$image->imageCategory->title}})</small></h5>
                    {!! Form::open(['action'=>['GallerySettingsController@updateImageCategory', $image->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                        {{Form::hidden('_method','PUT')}}
                        <div class="input-group mb-3">
                          {!! Form::select('image_cat-'.$image->id, $imageCategory ?? 'Select Option',$image->imageCategory->id, ['class' => 'form-control']) !!}
                          {{Form::submit('Update',['class'=>'btn btn-success rounded btn-sm input-group-text'])}}
                        </div>
                    {!! Form::close() !!}
                  <p class="card-text">{!!$image->description!!}</p>

                  <div class="btn-group">
                    <button type="button" class="btn btn-primary rounded btn-sm mr-2" onclick="getGalleryImage({{$image->id}})">
                      Edit
                    </button>
                    {!! Form::open(['action'=>['GallerySettingsController@destroy', $image->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger rounded btn-sm'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @else
            <p>No Images Found</p>
        @endif
      </div><!-- services list End -->

      <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Service</h3>
          </div>
          <div class="card-body">
            {!! Form::open(['action'=>'GallerySettingsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
              <div class="row mb-2">
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('image_cat', 'Image Category')}}
                    {!! Form::select('image_cat', $imageCategory ?? 'Select Option',null, ['class' => 'form-control']) !!}
                  </div>
                </div>
              </div>

              <div class="fom-group">
                  {{Form::label('description', 'Description')}}
                  {{Form::textarea('description', '', ['class'=>'form-control', 'placeholder'=>'Service Description'])}}
              </div>
              <div class="fom-group">
                  {{Form::label('detail', 'Detail')}}
                  {{Form::textarea('detail', '', ['id'=>'description-ckeditor','class'=>'form-control', 'placeholder'=>'Detail'])}}
              </div>
              <div class="fom-group">
                  {{Form::file('cover_image')}}
              </div>

              <div class="row justify-content-center mt-2">
                <div class="col-md-6">{{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}</div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div><!-- create service form end -->
    </div><!-- main .row END -->

    <!-- Modal for edit -->

    <!-- Modal -->
    <div class="modal fade" id="edit-gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </div>
          <div class="modal-body">
            {!! Form::open(['action'=>'GallerySettingsController@index', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'id'=>'edit-gallery-form']) !!}
              <div class="row">
                <div class="col-md-12 col-12">
                  <div class="fom-group">
                    {{Form::label('etitle', 'Title')}}
                    {{Form::text('etitle', '', ['id'=>'etitle','class'=>'form-control', 'placeholder'=>'Title'])}}
                  </div>
                </div>
              </div>


                <div class="fom-group">
                    {{Form::label('edescription', 'Description')}}
                    {{Form::textarea('edescription', '', ['class'=>'form-control', 'placeholder'=>'Service Description'])}}
                </div>
                <div class="fom-group">
                  {{Form::label('edetail', 'Detail')}}
                  {{Form::textarea('edetail', '', ['class'=>'form-control', 'placeholder'=>'Detail'])}}
              </div>
                <div class="fom-group">
                    {{Form::file('ecover_image')}}
                </div>
                <div class="row justify-content-center mt-2">
                  {{Form::hidden('_method','PUT')}}
                  <div class="col-md-6">{{Form::submit('Submit',['class'=>'btn btn-primary w-100'])}}</div>
                </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for edit Exit -->

@endsection

@section('script')
<script type="text/javascript">

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  function getGalleryImage(id){

    var req = "{{ route('gallery.index') }}",
    //console.log('url : '+req);
    get = req+'/'+id+'/edit';
    $.ajax({
         type:'GET',
         url:get,
         //data:{id:id},
         success:function(data){
           $('#etitle').val(data.gallery.title);
           $('#edescription').val(data.gallery.description);
           $('#edetail').val(data.gallery.detail);
           $("#edit-gallery-form").attr('action', req+'/'+id);
           $("#edit-gallery").modal('show');
         }
      });
  }

</script>
@endsection
