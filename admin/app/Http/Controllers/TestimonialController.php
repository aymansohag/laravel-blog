<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Testimonial Index
     *
     * @return void
     */
    public function testimonialIndex(){
        return view('Testimonial');
    }

    /**
     * Get testimonial Data
     */

    public function getTestimonialData(){
    	$data = Testimonial::orderBy('id', 'desc') -> get();
    	return $data;
    }



    /**
     * Testimonial Add
     *
     * @return void
     */
    public function testimonialAdd(Request $request){
        $name = $request -> name;
        $des  = $request -> des;
        $img  = $request -> img;

        $result = Testimonial::create([
            'name'  => $name,
            'des'   => $des,
            'image' => $img,
        ]);

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }


    /**
     * Testimonial Delete
     *
     * @return void
     */
    public function testimonialDelete(Request $request){
        $id = $request -> id;
        $delete_testimonial = Testimonial::find($id);
        $result = $delete_testimonial -> delete();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }


    /**
     * Testimonial Edit
     */

    public function testimonialEdit(Request $request){
        $id = $request -> id;
        $result = Testimonial::find($id);
        return $result;
    }


    /**
     * Testimonial Update
     *
     * @return void
     */
    public function testimonialUpdate(Request $request){
        $id   = $request -> id;
        $name = $request -> name;
        $des  = $request -> des;
        $img  = $request -> img;

        $update_testimonial = Testimonial::find($id);

        $update_testimonial -> name = $name;
        $update_testimonial -> des  = $des;
        $update_testimonial -> image  = $img;

        $result = $update_testimonial -> update();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

}


