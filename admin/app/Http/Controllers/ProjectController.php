<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModal;

class ProjectController extends Controller
{
    /**
     * Project Index Function
     *
     * @return void
     */
    public function projecstIndex(){
        return view('Projects');
    }

    /**
     * Get Project data from database
     *
     * @return void
     */
    public function getProjectsData(){
        $projects_data = ProjectModal::orderBy('id', 'desc') -> get();
        return $projects_data;
    }

    /**
     *Project Destroy
     */

    public function projectDelete(Request $request){
        $id = $request -> id;
        $delete_project = ProjectModal::find($id);
        $result = $delete_project -> delete();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * Project Add
     *
     * @return void
     */
    public function projectAdd(Request $request){

        $result = ProjectModal::create([
            'project_name' => $request -> name,
            'project_des'  => $request -> des,
            'project_link' => $request -> link,
            'project_img'  => $request -> img,
        ]);

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }


    /**
     * Project Edit
     */

    public function projectEdit(Request $request){
        $id = $request -> id;
        $result = ProjectModal::find($id);
        return $result;
    }


     /**
     * Course Update
     *
     * @return void
     */
    public function projectUpdate(Request $request){
        $id   = $request -> id;

        $update_project = ProjectModal::find($id);

        $update_project -> project_name = $request -> name;
        $update_project -> project_des  = $request -> des;
        $update_project -> project_link = $request -> link;
        $update_project -> project_img  = $request -> img;

        $result = $update_project -> update();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }


}
