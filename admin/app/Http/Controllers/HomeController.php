<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Course;
use App\Models\ProjectModal;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Visitor;

class HomeController extends Controller
{
    /**
     * Home Index
     */
    public function homeIndex(){

        $contact_count     = Contact::count();
        $course_count      = Course::count();
        $project_count     = ProjectModal::count();
        $service_count     = Service::count();
        $testimonial_count = Testimonial::count();
        $visitor_count     = Visitor::count();
    	return view('Home', [
            'contact'     => $contact_count,
            'course'      => $course_count,
            'project'     => $project_count,
            'service'     => $service_count,
            'testimonial' => $testimonial_count,
            'visitor'     => $visitor_count,
        ]);
    }
}
