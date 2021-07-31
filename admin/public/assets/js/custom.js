
    // GET TESTIMONIAL DATA

    function getTestimonialData(){
        axios.get('getTestimonialData')
        .then(function(response){
            if(response.status == 200){
                $("#testimonialMain").removeClass('d-none');
                $("#testimonialLoader").addClass('d-none');
                // Table empty for delete and data table
                $('#testimonialDataTable').DataTable().destroy();
                $('tbody#testimonialTable').empty();
                var json_data = response.data;
                var n = 1;
                $.each(json_data, function(i){
                    $('<tr>').html(
                        '<td>'+n+'</td>'+
                        '<td><img class="table-img" src="'+json_data[i].image+'"></td>'+
                        '<td>'+json_data[i].name+'</td>'+
                        '<td>'+json_data[i].des+'</td>'+
                        '<td><a class="testimonialEditIcon" data-id="'+json_data[i].id+'"><i class="fas fa-edit"></i></a></td>'+
                        '<td><a class="testimonialDeleteIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo('tbody#testimonialTable');
                    n++
                });

                // Testimonial Delete icon click
                $('.testimonialDeleteIcon').click(function(){
                    var id = $(this).data('id');
                    $('#testimonialDeleteId').html(id);
                    $('#testimonialDeleteModal').modal('show');
                });

                // Testimonial Edit icon click
                $('.testimonialEditIcon').click(function(){
                    var id = $(this).data('id');
                    $('#testimonialEditId').html(id);
                    testimonialEdit(id);
                    $('#testimonialEditModal').modal('show');
                });

                // Data Table
                $('#serviecDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');



            }else{
                $("#testimonialLoader").addClass('d-none');
                $("#testimonialwrong").removeClass('d-none');
            }

        })

        .catch(function (error){
            $("#testimonialLoader").addClass('d-none');
            $("#testimonialwrong").removeClass('d-none');
        });
    }


    //    Add New Service btn click

$('#addNewTestimonial').click(function(){
    $('#addTestimonialModal').modal('show');
});

// Add New service confirm button click

$('#testimonialAddConfirmBtn').click(function(){
    var name = $('#testimonialNameId').val();
    var des  = $('#testimonialDesId').val();
    var img  = $('#testimonialImgId').val();
    testimonialAdd(name, des, img);
});

// Add new service function

function testimonialAdd(name, des, img){
    if(name.length==0){
        toastr.error('Testimonial name must not be empty !!');
    }else if(des.length==0){
        toastr.error('Testimonial Description must not be empty !!');
    }else if(img.lenght==0){
        toastr.error('Testimonial Image must not be empty !!');
    }else{
        $('#testimonialAddConfirmBtn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Testimonial delete confirm button animation....

        axios.post('testimonialAdd',
        {
            name: name,
            des : des,
            img : img,
        })
           .then(function(response){
            $('#testimonialAddConfirmBtn').html("Add");
                if(response.status==200){
                    if(response.data == 1){
                        $('#addTestimonialModal').modal('hide');
                        toastr.success('Data Add Successfull !!');
                        getTestimonialData()
                    }else{
                        $('#addTestimonialModal').modal('hide');
                        toastr.error('Data Add Faield !!');
                        getTestimonialData()
                    }
                }else{
                    $('#addTestimonialModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#addTestimonialModal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }


// TESTIMONIAL DATA DELETE

// TESTIMONIAL delete cnfirm bnt click
$('#testimonialDeleteConfirmBtn').click(function(){
    var id = $('#testimonialDeleteId').html();
    testimonialDelete(id);
});


function testimonialDelete(deleteId){
    $('#testimonialDeleteConfirmBtn').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>'
    ); //Service delete confirm button animation....
    axios.post('testimonialDelete', {
        id:deleteId
    })
    .then(function(response){
        $('#testimonialDeleteConfirmBtn').html("Yes");
        if(response.status==200){
            if(response.data == 1){
                $('#testimonialDeleteModal').modal('hide');
                toastr.success('Data Deleted Successfull !!');
                getTestimonialData()
            }else{
                $('#testimonialDeleteModal').modal('hide');
                toastr.error('Data Deleted Faield !!');
                getTestimonialData()
            }
        }else{
            $('#testimonialDeleteModal').modal('hide');
            toastr.error('Something Went Wrong !!');
        }
    })
    .catch(function(error){
        $('#testimonialDeleteModal').modal('hide');
        toastr.error('Something Went Wrong !!');
    })
}

// SERVICE DATA EDIT DETAILS

function testimonialEdit(detailsId){
    axios.post('testimonialEdit', {id:detailsId})
       .then(function(response){
           if(response.status == 200){
               $('#testimonialEditForm').removeClass('d-none');
               $('#testimonialEditLoader').addClass('d-none');
               var data = response.data;
               $('#testimonialEditNameId').val(data.name);
               $('#testimonialEditDesID').val(data.des);
               $('#testimonialEditImgId').val(data.image);
           }else{
               $('#testimonialEditLoader').addClass('d-none');
               $('#testimonialEditWrong').removeClass('d-none');
           }
       })
       .catch(function(error){
           $('#testimonialEditLoader').addClass('d-none');
           $('#testimonialEditWrong').removeClass('d-none');
       })
   }


   // Testimonial Update save bnt click
$('#testimonialUpdateSave').click(function(){
    var id   = $('#testimonialEditId').html();
    var name = $('#testimonialEditNameId').val();
    var des  = $('#testimonialEditDesID').val();
    var img  = $('#testimonialEditImgId').val();

    testimonialUpdate(id, name, des, img);

});


// SERVICE DATA UPDATE

function testimonialUpdate(id, name, des, img){
    if(name.length==0){
        toastr.error('Name must not be empty !!');
    }else if(des.length==0){
        toastr.error('Description must not be empty !!');
    }else if(img.lenght==0){
        toastr.error('Image must not be empty !!');
    }else{
        $('#testimonialUpdateSave').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('testimonialUpdate',
        {
            id  : id,
            name: name,
            des : des,
            img : img,
        })
           .then(function(response){
            $('#testimonialUpdateSave').html("Save");
                if(response.status==200){
                    if(response.data == 1){
                        $('#testimonialEditModal').modal('hide');
                        toastr.success('Data Update Successfull !!');
                        getTestimonialData()
                    }else{
                        $('#testimonialEditModal').modal('hide');
                        toastr.error('Data Update Faield !!');
                        getTestimonialData()
                    }
                }else{
                    $('#testimonialEditModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#testimonialEditModal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }
