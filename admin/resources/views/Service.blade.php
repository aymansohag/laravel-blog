@extends('layouts.app')
@section('title', 'Service')

@section('main-content')

<div class="container d-none" id="service_main">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewServiceBtn" class="btn btn-primary btn-sm my-3">Add New</button>
            <table id="serviecDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width: 7%">SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="service_table">


                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="container text-center mt-5 pt-5" id="service_loader">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <img src="{{ asset('assets/images/loader.svg') }}" alt="">
        </div>
    </div>
</div>

<div class="container text-center d-none mt-5 pt-5" id="service_wrong">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <h3>Something Went Wrong !!</h3>
        </div>
    </div>
</div>



{{-- SERVICE DELETE MODAL --}}

<div class="modal fade" id="service_delete_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 class="mt-4 d-none" id="service_delete_id"></h5>
        <h5 id="serviceDeleteId" class="mt-4 d-none">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="service_delete_confirm_btn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

{{-- SERVICE EDIT MODAL --}}

<div class="modal"id="service_edit_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
          <div class="modal-header px-5">
              <h3>Service Edit</h3>
          </div>
        <h5 id="serviceEditId" class="mt-4 d-none"> </h5>

        <div id="serviceEditForm" class="w-100 d-none p-5">
            <input id="serviceNameID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
            <input id="serviceDesID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
            <input id="serviceImgID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

        <img style="width: 100px" id="serviceEditLoader" src="{{ asset('assets/images/loader.svg') }}" alt="">

        <h4 class="mt-5 d-none" id="serviceEditWrong">Something Went Wrong !!</h4>

      </div>
      <div class="modal-footer px-5">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="service_update_confirm_btn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


{{-- SERVICE Add --}}

<div class="modal fade" id="addNewServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header px-5">
        <h3>Add New Service</h3>
     </div>
      <div class="modal-body p-5 text-center">

        <div id="serviceAddForm" class="w-100">
            <input id="serviceNameAddID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
            <input id="serviceDesAddID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
            <input id="serviceImgAddID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
        </div>

      </div>
      <div class="modal-footer px-5">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="ServiceAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add Service</button>
      </div>
    </div>
  </div>
</div>

@endsection()


@section('script')
<script>
    getServiceData();

	/**
     * SERVICE SCRIPTS
     */

    // GET SERVICE DATA

function getServiceData(){
	axios.get('getServiceData')
	.then(function(response){
        if(response.status == 200){
            $("#service_main").removeClass('d-none');
            $("#service_loader").addClass('d-none');
            // Table empty for delete and data table
            $('#serviecDataTable').DataTable().destroy();
            $('tbody#service_table').empty();
            var json_data = response.data;
            var n = 1;
            $.each(json_data, function(i, item){
                $('<tr>').html(
                    '<td>'+n+'</td>'+
                    '<td><img class="table-img" src="'+json_data[i].service_img+'"></td>'+
                    '<td>'+json_data[i].service_name+'</td>'+
                    '<td>'+json_data[i].service_des+'</td>'+
                    '<td><a class="service_edit_btn" data-id="'+json_data[i].id+'"><i class="fas fa-edit"></i>Edit</a></td>'+

                    '<td><a class="service_delete_btn" data-id="'+json_data[i].id+'" ><i class="fas fa-trash-alt"></i>Delete</a></td>'
                ).appendTo('tbody#service_table');
                n++
            });

            // Service Delete icon click
            $('.service_delete_btn').click(function(){
                var id = $(this).data('id');
                $('#service_delete_id').html(id);
                $('#service_delete_Modal').modal('show');
            });

            // Service Edit icon click
            $('.service_edit_btn').click(function(){
                var id = $(this).data('id');
                $('#serviceEditId').html(id);
                serviceEditDetails(id);
                $('#service_edit_Modal').modal('show');
            });

            // Data Table
            $('#serviecDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');



        }else{
            $("#service_loader").addClass('d-none');
            $("#service_wrong").removeClass('d-none');
        }

	})

	.catch(function (error){
        $("#service_loader").addClass('d-none');
        $("#service_wrong").removeClass('d-none');
	});
}

    // SERVICE DATA DELETE

// Service delete cnfirm bnt click
$('#service_delete_confirm_btn').click(function(){
    var id = $('#service_delete_id').html();
    getServiceDelete(id);
});


function getServiceDelete(deleteId){
    $('#service_delete_confirm_btn').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>'
    ); //Service delete confirm button animation....
    axios.post('ServiceDelete', {id:deleteId})
    .then(function(response){
        $('#service_delete_confirm_btn').html("Yes");
        if(response.status==200){
            if(response.data == 1){
                $('#service_delete_Modal').modal('hide');
                toastr.success('Service Deleted Successfull !!');
                getServiceData()
            }else{
                $('#service_delete_Modal').modal('hide');
                toastr.error('Service Deleted Faield !!');
                getServiceData()
            }
        }else{
            $('#service_delete_Modal').modal('hide');
            toastr.error('Something Went Wrong !!');
        }
    })
    .catch(function(error){
        $('#service_delete_Modal').modal('hide');
        toastr.error('Something Went Wrong !!');
    })
}

// SERVICE DATA EDIT DETAILS

function serviceEditDetails(detailsId){
 axios.post('ServiceDetails', {id:detailsId})
    .then(function(response){
        if(response.status == 200){
            $('#serviceEditForm').removeClass('d-none');
            $('#serviceEditLoader').addClass('d-none');
            var data = response.data;
            $('#serviceNameID').val(data.service_name);
            $('#serviceDesID').val(data.service_des);
            $('#serviceImgID').val(data.service_img);
        }else{
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#serviceEditLoader').addClass('d-none');
        $('#serviceEditWrong').removeClass('d-none');
    })
}


// Service Update save bnt click
$('#service_update_confirm_btn').click(function(){
    var id   = $('#serviceEditId').html();
    var name = $('#serviceNameID').val();
    var des  = $('#serviceDesID').val();
    var img  = $('#serviceImgID').val();

    serviceUpdate(id, name, des, img);

});


// SERVICE DATA UPDATE

function serviceUpdate(serviceId, serviceName, serviceDes, serviceImg){
    if(serviceName.length==0){
        toastr.error('Service name must not be empty !!');
    }else if(serviceDes.length==0){
        toastr.error('Service Description must not be empty !!');
    }else if(serviceImg.lenght==0){
        toastr.error('Service Image must not be empty !!');
    }else{

        $('#service_update_confirm_btn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('serviceUpdate',
        {
            id  : serviceId,
            name: serviceName,
            des : serviceDes,
            img : serviceImg,
        })
           .then(function(response){
            $('#service_update_confirm_btn').html("Save");
                if(response.status==200){
                    if(response.data == 1){
                        $('#service_edit_Modal').modal('hide');
                        toastr.success('Service Update Successfull !!');
                        getServiceData()
                    }else{
                        $('#service_edit_Modal').modal('hide');
                        toastr.error('Service Update Faield !!');
                        getServiceData()
                    }
                }else{
                    $('#service_edit_Modal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#service_edit_Modal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }

//    Add New Service btn click

$('#addNewServiceBtn').click(function(){
    $('#addNewServiceModal').modal('show');
});

// Add New service confirm button click

$('#ServiceAddConfirmBtn').click(function(){
    var name = $('#serviceNameAddID').val();
    var des = $('#serviceDesAddID').val();
    var img = $('#serviceImgAddID').val();
    serviceAdd(name, des, img);
});

// Add new service function

function serviceAdd(serviceName, serviceDes, serviceImg){
    if(serviceName.length==0){
        toastr.error('Service name must not be empty !!');
    }else if(serviceDes.length==0){
        toastr.error('Service Description must not be empty !!');
    }else if(serviceImg.lenght==0){
        toastr.error('Service Image must not be empty !!');
    }else{

        $('#ServiceAddConfirmBtn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('serviceAdd',
        {
            name: serviceName,
            des : serviceDes,
            img : serviceImg,
        })
           .then(function(response){
            $('#ServiceAddConfirmBtn').html("Add Service");
                if(response.status==200){
                    if(response.data == 1){
                        $('#addNewServiceModal').modal('hide');
                        toastr.success('Service Add Successfull !!');
                        getServiceData()
                    }else{
                        $('#addNewServiceModal').modal('hide');
                        toastr.error('Service Add Faield !!');
                        getServiceData()
                    }
                }else{
                    $('#addNewServiceModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#addNewServiceModal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }

</script>
@endsection()
