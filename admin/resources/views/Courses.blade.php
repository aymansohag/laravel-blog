@extends('layouts.app')
@section('title', 'Course')

@section('main-content')

<div id="courseMain" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">
    <button id="addNewCourseBtn" class="btn btn-primary btn-sm my-3">Add New</button>
    <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th style="width: 7%">SL</th>
          <th>Name</th>
          <th>Fee</th>
          <th>Class</th>
          <th>Enroll</th>
          <th style="width: 7%">Details</th>
          <th style="width: 7%">Edit</th>
          <th style="width: 7%">Delete</th>
        </tr>
      </thead>
      <tbody id="coursesTable">

      </tbody>
    </table>

    </div>
    </div>
</div>
{{-- Loader --}}
<div class="container text-center mt-5 pt-5" id="coursesLoader">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <img src="{{ asset('assets/images/loader.svg') }}" alt="">
        </div>
    </div>
</div>

<div class="container text-center mt-5 pt-5 d-none" id="courseWrong">
    <div class="row">
        <div class="col-md-12 p-5 loader">
            <h3>Something Went Wrong !!</h3>
        </div>
    </div>
</div>


{{-- Add new course modal --}}

<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header px-5">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center py-5">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add Course</button>
      </div>
    </div>
  </div>
</div>


{{-- COURSE DELETE MODAL --}}

<div class="modal fade" id="courseDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 class="mt-4 d-none" id="coursesDeleteId"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button id="courseDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

{{--  course Update modal --}}

<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 class="d-none" id="updateCourseid">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center py-5">
       <div class="container">
       	<div class="row d-none" id="CourseEditForm">
       		<div class="col-md-6">
             	<input id="updateCourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="updateCourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="updateCourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="updateCourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="updateCourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="updateCourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="updateCourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
        <img style="width: 100px" id="courseEditLoader" src="{{ asset('assets/images/loader.svg') }}" alt="">

        <h4 class="mt-5 d-none" id="courseEditWrong">Something Went Wrong !!</h4>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add Course</button>
      </div>
    </div>
  </div>
</div>


@endsection()


@section('script')
<script>
    getCoursesData();




    	/**
     * COURSES SCRIPTS
     */

    // GET COURSES DATA

    function getCoursesData(){
        axios.get('getCoursesData')
        .then(function(response){
            if(response.status == 200){
                $("#courseMain").removeClass('d-none');
                $("#coursesLoader").addClass('d-none');

                // Table empty for delete and show and data table
                $('#courseDataTable').DataTable().destroy();
                $('tbody#coursesTable').empty();
                var json_data = response.data;
                var n = 1;
                $.each(json_data, function(i){
                    $('<tr>').html(
                        '<td>'+n+'</td>'+
                        '<td>'+json_data[i].course_name+'</td>'+
                        '<td>'+json_data[i].course_fee+'</td>'+
                        '</td>'+
                        '<td>'+json_data[i].course_class+'</td>'+
                        '</td>'+
                        '<td>'+json_data[i].course_enroll+'</td>'+
                        '</td>'+
                        '<td><a class="coursesDetailsIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-eay"></i>Details</a></td>'+
                        '<td><a class="coursesEditIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-edit"></i>Edit</a></td>'+
                        '<td><a class="coursesDeleteIcon" data-id="'+json_data[i].id+'" ><i class="fas fa-trash-alt">Delete</i></a></td>'
                    ).appendTo('tbody#coursesTable');
                    n++

                    // course Delete icon click
                    $('.coursesDeleteIcon').click(function(){
                        var id = $(this).data('id');
                        $('#coursesDeleteId').html(id);
                        $('#courseDeleteModal').modal('show');
                    });

                    // Course update details icon click
                    $('.coursesEditIcon').click(function(){
                        var id = $(this).data('id');
                        $('#updateCourseid').html(id);
                        courseUpdateDetails(id);
                        $('#updateCourseModal').modal('show');
                    });
                });

                // Data table
                $('#serviecDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            }else{
                $("#coursesLoader").addClass('d-none');
                $("#courseWrong").removeClass('d-none');
            }

        })

        .catch(function (error){
            $("#coursesLoader").addClass('d-none');
            $("#courseWrong").removeClass('d-none');
        });
    }

    // Add new course open modal click button

    $('#addNewCourseBtn').click(function(){
        $('#addCourseModal').modal('show');
    })

    // Add new course confirm button
    $('#CourseAddConfirmBtn').click(function(){
        var course_name   = $('#CourseNameId').val();
        var course_des    = $('#CourseDesId').val();
        var course_fee    = $('#CourseFeeId').val();
        var course_enroll = $('#CourseEnrollId').val();
        var course_class  = $('#CourseClassId').val();
        var course_link   = $('#CourseLinkId').val();
        var course_img    = $('#CourseImgId').val();
        courseAdd(course_name, course_des, course_fee, course_enroll, course_class,  course_link, course_img)
    })

    // Add new course function

    function courseAdd(course_name, course_des, course_fee, course_enroll, course_class, course_link, course_img){
        if(course_name.length==0){
            toastr.error('Course name must not be empty !!');
        }else if(course_des.length==0){
            toastr.error('Course Description must not be empty !!');
        }else if(course_fee.lenght==0){
            toastr.error('Course Fee must not be empty !!');
        }else if(course_enroll.lenght==0){
            toastr.error('Course enroll must not be empty !!');
        }else if(course_class.lenght==0){
            toastr.error('Course class must not be empty !!');
        }else if(course_link.lenght==0){
            toastr.error('Course Link must not be empty !!');
        }else if(course_img.lenght==0){
            toastr.error('Course Image must not be empty !!');
        }else{

            $('#CourseAddConfirmBtn').html(
                '<div class="spinner-border spinner-border-sm">'+
                '</div>'
            ); //Service delete confirm button animation....

            axios.post('coursesAdd',
            {
                course_name  : course_name,
                course_des   : course_des,
                course_fee   : course_fee,
                course_enroll: course_enroll,
                course_class : course_class,
                course_link  : course_link,
                course_img   : course_img,
            })
            .then(function(response){
                $('#CourseAddConfirmBtn').html("Add Course");
                    if(response.status==200){
                        if(response.data == 1){
                            $('#addCourseModal').modal('hide');
                            toastr.success('Course Added Successfull !!');
                            getCoursesData();
                        }else{
                            $('#addCourseModal').modal('hide');
                            toastr.error('Course Added Faield !!');
                            getCoursesData();
                        }
                    }else{
                        $('#addCourseModal').modal('hide');
                        toastr.error('Something Went Wrong !!');
                    }
            })
            .catch(function(error){
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
            })
        }

    }

// SERVICE DATA DELETE


// Service delete cnfirm bnt click
$('#courseDeleteConfirmBtn').click(function(){
    var id = $('#coursesDeleteId').html();
    courseDelete(id);
});


function courseDelete(deleteId){
    $('#courseDeleteConfirmBtn').html(
        '<div class="spinner-border spinner-border-sm">'+
        '</div>'
    ); //Service delete confirm button animation....
    axios.post('coursesDelete', {id:deleteId})
    .then(function(response){
        $('#courseDeleteConfirmBtn').html("Yes");
        if(response.status==200){
            if(response.data == 1){
                $('#courseDeleteModal').modal('hide');
                toastr.success('Course Deleted Successfull !!');
                getCoursesData()
            }else{
                $('#courseDeleteModal').modal('hide');
                toastr.error('Course Deleted Faield !!');
                getCoursesData()
            }
        }else{
            $('#courseDeleteModal').modal('hide');
            toastr.error('Something Went Wrong !!');
        }
    })
    .catch(function(error){
        $('#courseDeleteModal').modal('hide');
        toastr.error('Something Went Wrong !!');
    })
}

// COURSE DATA EDIT DETAILS

function courseUpdateDetails(detailsId){
    axios.post('coursesDetails', {id:detailsId})
       .then(function(response){
           if(response.status == 200){
               $('#CourseEditForm').removeClass('d-none');
               $('#courseEditLoader').addClass('d-none');
               var data = response.data;
               $('#updateCourseNameId').val(data.course_name);
               $('#updateCourseDesId').val(data.course_des);
               $('#updateCourseFeeId').val(data.course_fee);
               $('#updateCourseEnrollId').val(data.course_enroll);
               $('#updateCourseClassId').val(data.course_class);
               $('#updateCourseLinkId').val(data.course_link);
               $('#updateCourseImgId').val(data.course_img);
           }else{
               $('#courseEditLoader').addClass('d-none');
               $('#courseEditWrong').removeClass('d-none');
           }
       })
       .catch(function(error){
           $('#courseEditLoader').addClass('d-none');
           $('#courseEditWrong').removeClass('d-none');
       })
   }



   // Service Update save bnt click
$('#CourseUpdateConfirmBtn').click(function(){
    var id     = $('#updateCourseid').html();
    var name   = $('#updateCourseNameId').val();
    var des    = $('#updateCourseDesId').val();
    var fee    = $('#updateCourseFeeId').val();
    var enroll = $('#updateCourseEnrollId').val();
    var cls    = $('#updateCourseClassId').val();
    var link   = $('#updateCourseLinkId').val();
    var img    = $('#updateCourseImgId').val();

    courseUpdate(id, name, des, fee, enroll, cls, link, img);

});


// SERVICE DATA UPDATE

function courseUpdate(courseId, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLInk, courseImg){
    if(courseName.length==0){
        toastr.error('Course name must not be empty !!');
    }else if(courseDes.length==0){
        toastr.error('Course Description must not be empty !!');
    }else if(courseFee.lenght==0){
        toastr.error('Course Image must not be empty !!');
    }else if(courseEnroll.lenght==0){
        toastr.error('Course Enroll must not be empty !!');
    }else if(courseClass.lenght==0){
        toastr.error('Course Class must not be empty !!');
    }else if(courseLInk.lenght==0){
        toastr.error('Course link must not be empty !!');
    }else if(courseImg.lenght==0){
        toastr.error('Course Image must not be empty !!');
    }else{

        $('#CourseUpdateConfirmBtn').html(
            '<div class="spinner-border spinner-border-sm">'+
            '</div>'
        ); //Service delete confirm button animation....

        axios.post('coursesUpdate',
        {
            id           : courseId,
            course_name  : courseName,
            course_des   : courseDes,
            course_fee   : courseFee,
            course_enroll: courseEnroll,
            course_class : courseClass,
            course_link  : courseLInk,
            course_img   : courseLInk,
        })
           .then(function(response){
            $('#CourseUpdateConfirmBtn').html("Save");
                if(response.status==200){
                    if(response.data == 1){
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Course Update Successfull !!');
                        getCoursesData()
                    }else{
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Course Update Faield !!');
                        getCoursesData()
                    }
                }else{
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something Went Wrong !!');
                }
           })
           .catch(function(error){
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !!');
           })
    }

   }

</script>
@endsection()

