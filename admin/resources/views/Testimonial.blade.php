@extends('layouts.app')
@section('title', 'Testimonial')


@section('main-content')

<div class="container d-none" id="testimonialMain">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewTestimonial" class="btn btn-primary btn-sm my-3">Add New</button>
            <table id="testimonialDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%">SL</th>
                        <th style="width: 15%">Image</th>
                        <th style="width: 20%">Name</th>
                        <th>Description</th>
                        <th style="width: 10%">Edit</th>
                        <th style="width: 10%">Delete</th>
                    </tr>
                </thead>
                <tbody id="testimonialTable">


                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="container text-center mt-5 pt-5" id="testimonialLoader">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <img src="{{ asset('assets/images/loader.svg') }}" alt="">
        </div>
    </div>
</div>

<div class="container text-center d-none mt-5 pt-5" id="testimonialwrong">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <h3>Something Went Wrong !!</h3>
        </div>
    </div>
</div>




{{-- TESTIMONIAL Add --}}

<div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header px-5">
        <h3>Add New Testimonial</h3>
     </div>
      <div class="modal-body p-5 text-center">

        <div id="testimonialAddForm" class="w-100">
            <input id="testimonialNameId" type="text" id="" class="form-control mb-4" placeholder="Service Name">
            <input id="testimonialDesId" type="text" id="" class="form-control mb-4" placeholder="Service Description">
            <input id="testimonialImgId" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

      </div>
      <div class="modal-footer px-5">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="testimonialAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
      </div>
    </div>
  </div>
</div>

{{-- SERVICE DELETE MODAL --}}

<div class="modal fade" id="testimonialDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 class="mt-4 d-none" id="testimonialDeleteId"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="testimonialDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

{{-- TESTIMONIAL EDIT MODAL --}}

<div class="modal"id="testimonialEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
          <div class="modal-header px-5">
              <h3>Testimonial Edit</h3>
          </div>
        <h5 id="testimonialEditId" class="mt-4 d-none"> </h5>

        <div id="testimonialEditForm" class="w-100 d-none p-5">
            <input id="testimonialEditNameId" type="text" id="" class="form-control mb-4" placeholder="Service Name">
            <input id="testimonialEditDesID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
            <input id="testimonialEditImgId" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

        <img style="width: 100px" id="testimonialEditLoader" src="{{ asset('assets/images/loader.svg') }}" alt="">

        <h4 class="mt-5 d-none" id="testimonialEditWrong">Something Went Wrong !!</h4>

      </div>
      <div class="modal-footer px-5">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="testimonialUpdateSave" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection()


@section('script')
<script>

getTestimonialData();

</script>
@endsection()
