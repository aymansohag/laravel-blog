@extends('layouts.app')
@section('title', 'Contact')

@section('main-content')

<div class="container d-none" id="contactMain">
    <div class="row">
    <div class="col-md-12 p-5">
    <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width: 10%">SL</th>
          <th style="width: 32%">Email</th>
          <th class="th-sm">Message</th>
          <th style="width: 10%">Delete</th>
        </tr>
      </thead>
      <tbody id="contactTable">

      </tbody>
    </table>

    </div>
    </div>
</div>

{{-- Loader --}}
<div class="container text-center mt-5 pt-5" id="contactLoader">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <img src="{{ asset('assets/images/loader.svg') }}" alt="">
        </div>
    </div>
</div>

<div class="container text-center mt-5 pt-5 d-none" id="contactWrong">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <h3>Something Went Wrong !!</h3>
        </div>
    </div>
</div>


{{-- CONTACT DELETE MODAL --}}

<div class="modal fade" id="contactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 class="mt-4 d-none" id="contactDeleteId"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="contactDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection()


@section('script')
    <script>
        getContactData();



        /**
     * PROJECTS SCRIPTS
     */

    // GET PROJECTS DATA

    function getContactData(){
        axios.get('getContactData')
        .then(function(response){
            if(response.status == 200){
                $("#contactMain").removeClass('d-none');
                $("#contactLoader").addClass('d-none');

                // Table empty for delete and show and data table
                $('#contactDataTable').DataTable().destroy();
                $('tbody#contactTable').empty();
                var json_data = response.data;
                var n = 1;
                $.each(json_data, function(i){
                    $('<tr>').html(
                        '<td>'+n+'</td>'+
                        '<td>'+json_data[i].email+'</td>'+
                        '<td>'+json_data[i].message+'</td>'+
                        '</td>'+
                        '<td><a class="contactDeleteIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo('tbody#contactTable');
                    n++

                });

                // Delete icon click
                $('.contactDeleteIcon').click(function(){
                    var id = $(this).data('id');
                    $('#contactDeleteId').html(id);
                    $('#contactDeleteModal').modal('show');
                });

                // Data table
                $('#contactDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            }else{
                $("#contactLoader").addClass('d-none');
                $("#contactWrong").removeClass('d-none');
            }

        })

        .catch(function (error){
            $("#contactLoader").addClass('d-none');
            $("#contactWrong").removeClass('d-none');
        });
    }


// CONTACT DATA DELETE


// Contact delete cnfirm bnt click
$('#contactDeleteConfirmBtn').click(function(){
    var id = $('#contactDeleteId').html();
    contactDelete(id);
});


function contactDelete(deleteId){
    $('#contactDeleteConfirmBtn').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>'
    ); //Project delete confirm button animation....
    axios.post('contactDelete', {id:deleteId})
    .then(function(response){
        $('#contactDeleteConfirmBtn').html("Yes");
        if(response.status==200){
            if(response.data == 1){
                $('#contactDeleteModal').modal('hide');
                toastr.success('Data Deleted Successfull !!');
                getContactData();
            }else{
                $('#contactDeleteModal').modal('hide');
                toastr.error('Data Deleted Faield !!');
                getContactData();
            }
        }else{
            $('#contactDeleteModal').modal('hide');
            toastr.error('Something Went Wrong !!');
        }
    })
    .catch(function(error){
        $('#contactDeleteModal').modal('hide');
        toastr.error('Something Went Wrong !!');
    })
}



    </script>
@endsection()

