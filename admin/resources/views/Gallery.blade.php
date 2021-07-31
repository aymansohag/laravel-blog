@extends('layouts.app')
@section('title', 'Gallery')


@section('main-content')


<div class="container">
    <div class="row">
        <div class="col-md-12 pt-3 pb-3">
            <button id="addPhotoGallery" data-target="#addNewGalleryModal" data-toggle="modal" class="btn btn-primary btn-sm my-3">Add New</button>
        </div>
    </div>
</div>
{{-- Phot Load --}}
<div class="container">
    <div class="row" id="galeryRow">

    </div>

    <div class="d-flex justify-content-center">
      <button id="galeryLoadMore" class = "btn btn-primary">Load More</button>
    </div>
</div>


{{-- GALERY ADD --}}

<div class="modal fade" id="addNewGalleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4>Add New Photo</h4>
      </div>
      <div class="modal-body p-3">
          <img style="width: 100%; height: 320px" src="{{ asset('assets/images/default.png') }}" id="addNewImageLoad" alt="">
          <label for="imageInput" id="imagInputIcon"> 
            <i class="fas fa-image" style="font-size: 60px; cursor: pointer; color: tomato"></i>
          </label>
          <input class="d-none" type="file" id="imageInput"><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="addNewGallerySave" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection()


@section('script')
<script>
    $('#imageInput').change(function(event){
        event.preventDefault();
        let imageUrl = URL.createObjectURL(event.target.files[0]);
        $('#addNewImageLoad').attr('src', imageUrl);
    });

    $('#addNewGallerySave').on('click', function(){
        $('#addNewGallerySave').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>');
        var photoFile = $('#imageInput').prop('files')[0];
        var formData = new FormData();
        formData.append('photo', photoFile);

        axios.post('galleryStore', formData)
        .then(function(response){
            $('#addNewGallerySave').html("Save");
            if(response.status == 200 && response.data==1){
                toastr.success('Photo Upload Successfull !!');
                $('#addNewGalleryModal').modal('hide');
            }
            else{
                toastr.error('Photo Upload Failed !!');
                $('#addNewGalleryModal').modal('hide');
            }
        })
        .catch(function(error){
            $('#addNewGallerySave').html("Save");
            toastr.error('Photo Upload Faield !!');
            $('#addNewGalleryModal').modal('hide');
        })
    });

    // Galery Show

    galeryShow();

    function galeryShow(){
        axios.get('galeryShow')
        .then(function(response){
            var data = response.data;
            $.each(data, function(i, item){
                $('<div class="col-md-3 pb-4">').html(
                    '<img data-id="'+item['id']+'" class="imgGallery" src="'+item['location']+'" alt=""> <button data-id="'+item['id']+'" data-path="'+item['location']+'" class="deletePhoto btn btn-sm btn-block btn-danger">Delete</button>'
                ).appendTo('#galeryRow')
            })
            $('.deletePhoto').on('click', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                let path = $(this).data('path');

                photoDelete(id, path);
            })
        })
        .catch(function(error){

        })
    }

    var imageId = 0;
    function loadById(id, loadMoreBtn){
        imageId = imageId + 12; //3,6
        var id = id + imageId;//379
        var URL = "galeryShowByLoad/"+id;
        loadMoreBtn.html('<div class="spinner-border spinner-border-sm">'+
        '</div>');
        axios.get(URL)
        .then(function(response){
            loadMoreBtn.html('Load More');
            var data = response.data;
            $.each(data, function(i, item){
                $('<div class="col-md-3 pb-4">').html(
                    '<img data-id="'+item['id']+'" class="imgGallery" src="'+item['location']+'" alt=""> <button data-id="'+item['id']+'" data-path="'+item['location']+'" class="deletePhoto btn btn-sm btn-block btn-danger">Delete</button>'
                ).appendTo('#galeryRow')
            });
        })
        .catch(function(error){
            loadMoreBtn.html('Load More');
        })
    }

    $('#galeryLoadMore').on('click', function(){
        var first_id = $('#galeryRow').find('img').data('id');
        var loadMoreBtn = $(this);
        loadById(first_id, loadMoreBtn);
    })

    // PHOTO DELETE

    function photoDelete(id, path){
        let URL = "galeryDelete";
        let myFormdata = new FormData();
        myFormdata.append('oldPhotoUrl', path);
        myFormdata.append('oldPhotoId', id);

        axios.post(URL, myFormdata)
        .then(function(response){
            if(response.status == 200 && response.data == 1){
                toastr.success('Photo Delete Successfull !!');
                imageId = 0
                $('#galeryRow').empty();
                galeryShow();
            }else{
                toastr.error('Photo Delete Faild !!');
            }
        })
        .catch(function(error){
            toastr.error('Photo Delete Faild !!');
        })
    }

</script>
@endsection()

