@extends('layouts.app')
@section('title', 'Project')


@section('main-content')

<div class="container d-none" id="ProjectsMain">
    <div class="row">
    <div class="col-md-12 p-5">
    <button id="addNewProjectBtn" class="btn btn-primary btn-sm my-3">Add New</button>
    <table id="ProjectsDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">SL</th>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="projectsTable">

      </tbody>
    </table>

    </div>
    </div>
</div>
{{-- Loader --}}
<div class="container text-center mt-5 pt-5" id="projectLoader">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <img src="{{ asset('assets/images/loader.svg') }}" alt="">
        </div>
    </div>
</div>

<div class="container text-center mt-5 pt-5 d-none" id="projectsWrong">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <h3>Something Went Wrong !!</h3>
        </div>
    </div>
</div>


{{-- PROJECTS DELETE MODAL --}}

<div class="modal fade" id="projectDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 class="mt-4 d-none" id="projectDeleteId"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="projectDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header px-5">
        <h5 class="modal-title">Add New Project Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center p-5">
       <div class="container">
       	<div class="row">
       		<div class="col-md-12">
             	<input id="projectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          	 	<input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
    		 	<input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
     			<input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer px-5">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add Course</button>
      </div>
    </div>
  </div>
</div>

{{--  course Update modal --}}

<div class="modal fade" id="projectUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header px-5">
        <h5 class="modal-title">Update Project</h5>
        <h5 class="d-none" id="projectUpdateId"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center p-5">
       <div class="container">
       	<div class="row d-none" id="ProjectEditForm">
       		<div class="col-md-12">
             	<input id="projectUpdateNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          	 	<input id="projectUpdateDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
    		 	<input id="projectUpdateLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
     			<input id="projectUpdateImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
       		</div>
       	</div>
        <img style="width: 100px" id="projectEditLoader" src="{{ asset('assets/images/loader.svg') }}" alt="">

        <h4 class="mt-5 d-none" id="projectEditWrong">Something Went Wrong !!</h4>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add Course</button>
      </div>
    </div>
  </div>
</div>

@endsection()


@section('script')
    <script>
        getProjectsData();

    /**
     * PROJECTS SCRIPTS
     */

    // GET PROJECTS DATA

    function getProjectsData(){
        axios.get('getProjectsData')
        .then(function(response){
            if(response.status == 200){
                $("#ProjectsMain").removeClass('d-none');
                $("#projectLoader").addClass('d-none');

                // Table empty for delete and show and data table
                $('#ProjectsDataTable').DataTable().destroy();
                $('tbody#projectsTable').empty();
                var json_data = response.data;
                var n = 1;
                $.each(json_data, function(i){
                    $('<tr>').html(
                        '<td>'+n+'</td>'+
                        '<td><img class="table-img" src="'+json_data[i].project_img+'"></td>'+
                        '<td>'+json_data[i].project_name+'</td>'+
                        '</td>'+
                        '<td>'+json_data[i].project_des+'</td>'+
                        '</td>'+
                        '<td><a class="projectEditIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-edit"></i></a></td>'+
                        '<td><a class="projectDeleteIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo('tbody#projectsTable');
                    n++

                });

                // Delete icon click
                $('.projectDeleteIcon').click(function(){
                    var id = $(this).data('id');
                    $('#projectDeleteId').html(id);
                    $('#projectDeleteModal').modal('show');
                });

                // Project update details icon click
                $('.projectEditIcon').click(function(){
                    var id = $(this).data('id');
                    $('#projectUpdateId').html(id);
                    projectUpdateDetails(id);
                    $('#projectUpdateModal').modal('show');
                });

                // Data table
                $('#ProjectsDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            }else{
                $("#projectLoader").addClass('d-none');
                $("#projectsWrong").removeClass('d-none');
            }

        })

        .catch(function (error){
            $("#projectLoader").addClass('d-none');
            $("#projectsWrong").removeClass('d-none');
        });
    }


// PROJECT DATA DELETE


// project delete cnfirm bnt click
$('#projectDeleteConfirmBtn').click(function(){
    var id = $('#projectDeleteId').html();
    projectDelete(id);
});


function projectDelete(deleteId){
    $('#projectDeleteConfirmBtn').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>'
    ); //Project delete confirm button animation....
    axios.post('projectDelete', {id:deleteId})
    .then(function(response){
        $('#projectDeleteConfirmBtn').html("Yes");
        if(response.status==200){
            if(response.data == 1){
                $('#projectDeleteModal').modal('hide');
                toastr.success('Data Deleted Successfull !!');
                getProjectsData()
            }else{
                $('#projectDeleteModal').modal('hide');
                toastr.error('Data Deleted Faield !!');
                getProjectsData()
            }
        }else{
            $('#projectDeleteModal').modal('hide');
            toastr.error('Something Went Wrong !!');
        }
    })
    .catch(function(error){
        $('#projectDeleteModal').modal('hide');
        toastr.error('Something Went Wrong !!');
    })
}



// Add new project open modal click button

$('#addNewProjectBtn').click(function(){
    $('#addProjectModal').modal('show');
})

// Add new course confirm button
$('#projectAddConfirmBtn').click(function(){
    var project_name = $('#projectNameId').val();
    var project_des  = $('#ProjectDesId').val();
    var project_link = $('#ProjectLinkId').val();
    var project_img  = $('#ProjectImgId').val();
    projectAddData(project_name, project_des, project_link, project_img);
})

// Add new course function

function projectAddData(project_name, project_des, project_link, project_img){
    if(project_name.length==0){
        toastr.error('Project name must not be empty !!');
    }else if(project_des.length==0){
        toastr.error('Project description must not be empty !!');
    }else if(project_link.lenght==0){
        toastr.error('Project link must not be empty !!');
    }else if(project_img.lenght==0){
        toastr.error('Project image must not be empty !!');
    }else{

        $('#projectAddConfirmBtn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('projectAdd',
        {
            name: project_name,
            des : project_des,
            link: project_link,
            img : project_img,
        })
        .then(function(response){
            $('#projectAddConfirmBtn').html("Add Project");
                if(response.status==200){
                    if(response.data == 1){
                        $('#addProjectModal').modal('hide');
                        toastr.success('Data Added Successfull !!');
                        getProjectsData();
                    }else{
                        $('#addProjectModal').modal('hide');
                        toastr.error('Data Added Faield !!');
                        getProjectsData();
                    }
                }else{
                    $('#addProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
        })
        .catch(function(error){
                $('#addProjectModal').modal('hide');
                toastr.error('Something Went Wrong !!');
        })
    }

}


// COURSE DATA EDIT DETAILS

function projectUpdateDetails(detailsId){
    axios.post('projectEdit', {id:detailsId})
       .then(function(response){
           if(response.status == 200){
               $('#ProjectEditForm').removeClass('d-none');
               $('#projectEditLoader').addClass('d-none');
               var data = response.data;
               $('#projectUpdateNameId').val(data.project_name);
               $('#projectUpdateDesId').val(data.project_des);
               $('#projectUpdateLinkId').val(data.project_link);
               $('#projectUpdateImgId').val(data.project_img);
           }else{
               $('#projectEditLoader').addClass('d-none');
               $('#projectEditWrong').removeClass('d-none');
           }
       })
       .catch(function(error){
           $('#projectEditLoader').addClass('d-none');
           $('#projectEditWrong').removeClass('d-none');
       })
   }

// project Update save bnt click
$('#projectUpdateConfirmBtn').click(function(){
    var id     = $('#projectUpdateId').html();
    var name   = $('#projectUpdateNameId').val();
    var des    = $('#projectUpdateDesId').val();
    var link   = $('#projectUpdateLinkId').val();
    var img    = $('#projectUpdateImgId').val();

    courseUpdate(id, name, des, link, img);

});

// PROJECT DATA UPDATE

function courseUpdate(id, name, des, link, img){
    if(name.length==0){
        toastr.error('Project name must not be empty !!');
    }else if(des.length==0){
        toastr.error('Project Description must not be empty !!');
    }else if(link.lenght==0){
        toastr.error('Project Link must not be empty !!');
    }else if(img.lenght==0){
        toastr.error('Project image must not be empty !!');
    }else{

        $('#projectUpdateConfirmBtn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('projectUpdate',
        {
            id  : id,
            name: name,
            des : des,
            link: link,
            img : img,
        })
           .then(function(response){
            $('#projectUpdateConfirmBtn').html("Update");
                if(response.status==200){
                    if(response.data == 1){
                        $('#projectUpdateModal').modal('hide');
                        toastr.success('Data Update Successfull !!');
                        getProjectsData()
                    }else{
                        $('#projectUpdateModal').modal('hide');
                        toastr.error('Data Update Faield !!');
                        getProjectsData()
                    }
                }else{
                    $('#projectUpdateModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#projectUpdateModal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }



    </script>
@endsection()
