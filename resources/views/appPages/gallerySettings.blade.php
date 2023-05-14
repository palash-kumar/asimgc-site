@extends('layouts.app')

@section('title')
      <h4>Gallery Settings</h4>
@endsection

@section('content')

    <div class="row"><!-- main .row -->

      <div class="col-md-12"><!-- services list start -->

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Gallery</h4>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-to-gallery"><i class="far fa-image"></i><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-body">
              <table class="table table-sm table-striped table-responsive-sm w-100" id="galleryLs">
                <thead class="thead-dark">
                  <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Detail</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <thead>

                </thead>
              </table>
            </div>
        </div>

      </div><!-- services list End -->

      {{-- <div class="col-md-4"><!-- create service form -->
        <div class="card">
          <div class="card-header">
            <h3>Add Image to Gallery</h3>
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
      </div><!-- create service form end --> --}}
    </div><!-- main .row END -->

    <div class="modal fade" id="add-to-gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
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
        </div>
    </div>
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

  var option = '<option value="null">Select Category</option>';

$(document).ready(function() {
    var imgCat = {!! json_encode($cats) !!};

    $.each(imgCat, function (key, val){
        console.log('cats: '+val.title);
        option +='<option value="'+val.id+'">'+val.title+'</option>'
    })

    var table = $('#galleryLs').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('gallery.index') }}",
        columns: [
            { data: "image_path",
            render: function ( data, type, row, meta ) {
                    return '<ul class="list-inline gallery"<img class="fancybox" rel="gallery1" style="max-height: 150px; max-width: 100px; " src="/storage/siteImages/Gallery/'+row.user_image+'" alt=""></ul>';
                },
            },
            { data: "title",
            render: function ( data, type, row, meta ) {

                    return  data;
                },
            },
            { data: "cat",
            render: function ( data, type, row, meta ) {
                    //console.log('row: '.data)
                    var lnk= '{{route("updateImageCat",":user")}}';
                    return buildFormWithCats(row.id, lnk.replace(':user',row.id), "PUT", '<i class="fas fa-cogs"></i>', 'btn-outline-info');//row.cat;
                    //return '<span class="text-info  px-1"><i class="fas fa-id-badge"></i> '+(data? data.title : "Not Assigned")+'</span>';
                }, },
            { data: "description",
            render: function ( data, type, row, meta ) {
                    return data? data.replaceAll('&amp;amp;','&').replaceAll('&gt;','>').replaceAll('&lt;','<'):data;
                },
            },
            {data: "detail",
            render: function ( data, type, row, meta ) {
                return data? data.replaceAll('&amp;amp;','&').replaceAll('&gt;','>').replaceAll('&lt;','<'):data;
                },
            },
            {data: "id",
            render: function ( data, type, row, meta ) {
                var lnk='';
                var ul = '<ul class="list-inline">';
                    ul+='<li class="list-inline-item"><button type="button" class="btn btn-outline-primary rounded btn-sm mr-2" onclick="getGalleryImage(\''+data+'\')" title="Edit"><i class="fas fa-edit"></i></button></li>'
                    $('#cat-'+data+' option:eq('+row.image_category_id+')').prop('selected', true)
                    //lnk= '{{route("gallery.index",":user")}}';
                    //console.log('lnk: '+lnk);
                    //ul+='<li class="list-inline-item">'+buildFormWithImage(lnk.replace(':user',data), "PUT", '<i class="fas fa-cogs"></i>', 'btn-outline-info')+'</li>';
                    lnk= '{{route("gallery.destroy",":user")}}';
                    ul+='<li class="list-inline-item" title="Delete User">'+buildFormWithImage(lnk.replace(':user',data), "DELETE", '<i class="fas fa-user-times"></i>', 'btn-outline-danger')+'</li>';

                    return ul+='</ul>';
                },
            },
        ],
    });

    $('tbody').on('click', 'tr', function() {
        $(this).children('td:eq(4)').text(table.row( this ).data()[4]);
        table.cell(this, 4).invalidate('dom');
    })
});




function buildFormWithImage(url, method, action, style){
    var form='<form method="POST" action="'+url+'" accept-charset="UTF-8">'
                    +'<input name="_token" type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'">'
                    +'<input name="_method" type="hidden" value="'+method+'">'
                    +'<button class="btn '+style+' rounded btn-sm" type="submit" >'+action+'</button>'
                +'</form>';

                return form;
}

function buildFormWithCats(id, url, method, action, style){
    var form='<form method="POST" action="'+url+'" accept-charset="UTF-8">'
                    +'<input name="_token" type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'">'
                    +'<input name="_method" type="hidden" value="'+method+'">'
                    +'<div class="input-group">'
                        +'<select class="form-control" id="cat-'+id+'" name="category">'+option+'</select>'
                        +'<button class="btn '+style+' rounded btn-sm input-group-text" type="submit" >'+action+'</button>'
                    +'</div>'

                +'</form>';

                return form;
}


</script>
@endsection
