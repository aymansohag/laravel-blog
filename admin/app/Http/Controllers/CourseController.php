<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Course index
     *
     * @return void
     */
    public function coursesIndex(){
        return view('Courses');
    }

    /**
     * Get Course Data
     *
     * @return void
     */
    public function getCoursesData(){
        $courses_data = Course::orderBy('id', 'desc') -> get();
        return $courses_data;
    }

    /**
     * Service Edit
     */

    public function getCoursesDetails(Request $request){
        $id = $request -> id;
        $result = Course::find($id);
        return $result;
    }

    /**
     * Courses Delete
     */

    public function courseseDelete(Request $request){
        $id = $request -> id;
        $delete_course = Course::find($id);
        $result = $delete_course -> delete();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

     /**
     * Course Update
     *
     * @return void
     */
    public function coursesUpdate(Request $request){
        $id   = $request -> id;
        $course_name   = $request -> course_name;
        $course_des    = $request -> course_des;
        $course_fee    = $request -> course_fee;
        $course_enroll = $request -> course_enroll;
        $course_class  = $request -> course_class;
        $course_link   = $request -> course_link;
        $course_img    = $request -> course_img;

        $update_course = Course::find($id);

        $update_course -> course_name   = $course_name;
        $update_course -> course_des    = $course_des;
        $update_course -> course_fee    = $course_fee;
        $update_course -> course_enroll = $course_enroll;
        $update_course -> course_class  = $course_class;
        $update_course -> course_link   = $course_link;
        $update_course -> course_img    = $course_img;

        $result = $update_course -> update();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Course Add
     *
     * @return void
     */
    public function coursesAdd(Request $request){
        $course_name   = $request -> course_name;
        $course_des    = $request -> course_des;
        $course_fee    = $request -> course_fee;
        $course_enroll = $request -> course_enroll;
        $course_class  = $request -> course_class;
        $course_link   = $request -> course_link;
        $course_img    = $request -> course_img;

        $result = Course::create([
            'course_name'   => $course_name,
            'course_des'    => $course_des,
            'course_fee'    => $course_fee,
            'course_enroll' => $course_enroll,
            'course_class'  => $course_class,
            'course_link'   => $course_link,
            'course_img'    => $course_img,
        ]);

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

    
}
