<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CoursesController extends Controller
{
    public function index(){
        $course_data = Course::orderBy('id', 'desc') -> get();
        return view('course', compact('course_data'));
    }
}
