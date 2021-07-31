<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModal;

class ProjectsCntroller extends Controller
{
    function index(){
        $project_data = ProjectModal::orderBy('id', 'desc') -> get();
        return view('project', compact('project_data'));
    }
}
