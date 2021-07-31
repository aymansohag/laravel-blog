<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\Service;
use App\Models\Course;
use App\Models\ProjectModal;
use App\Models\Contact;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class HomeController extends Controller
{
    /**
     * Home Index
     *
     * @return void
     */
	public function homeIndex(){
        date_default_timezone_set("Asia/Dhaka");

        $user_ip = $_SERVER['REMOTE_ADDR'];

        Visitor::create([
            'ip_address' => $user_ip,
        ]);

        $services_data = Service::orderBy('id', 'desc') -> get();
        $course_data = Course::orderBy('id', 'desc') -> take(6) -> get();
        $project_data = ProjectModal::orderBy('id', 'desc') -> take(10) -> get();
        $testimonial_data = Testimonial::orderBy('id', 'desc') -> get();

        return view('Home', [
            'services_data'    => $services_data,
            'course_data'      => $course_data,
            'project_data'     => $project_data,
            'testimonial_data' => $testimonial_data,
        ]);
    }

    public function contactSend(Request $request){
        $result = Contact::create([
            'name'    => $request -> name,
            'mobile'  => $request -> mobile,
            'email'   => $request -> email,
            'message' => $request -> message,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

}
