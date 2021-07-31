<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Service Index
     *
     * @return void
     */
    public function serviceIndex(){
    	return view('Service');
    }

    /**
     * Get Service Data
     */

    public function getServiceData(){
    	$service_data = json_encode(Service::orderBy('id', 'desc') -> get());
    	return $service_data;
    }

    /**
     * Service Edit
     */

    public function getServiceDetails(Request $request){
        $id = $request -> id;
        $result = Service::find($id);
        return $result;
    }

    /**
     * Service Delete
     *
     * @return void
     */
    public function ServiceDelete(Request $request){
        $id = $request -> id;
        $delete_service = Service::find($id);
        $result = $delete_service -> delete();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

     /**
     * Service Update
     *
     * @return void
     */
    public function serviceUpdate(Request $request){
        $id   = $request -> id;
        $name = $request -> name;
        $des  = $request -> des;
        $img  = $request -> img;

        $update_service = Service::find($id);

        $update_service -> service_name = $name;
        $update_service -> service_des  = $des;
        $update_service -> service_img  = $img;

        $update_service -> update();

        if($update_service == true){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Service Add
     *
     * @return void
     */
    public function serviceAdd(Request $request){
        $name = $request -> name;
        $des  = $request -> des;
        $img  = $request -> img;

        $add_service = Service::create([
            'service_name' => $name,
            'service_des'  => $des,
            'service_img'  => $img,
        ]);

        if($add_service == true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
