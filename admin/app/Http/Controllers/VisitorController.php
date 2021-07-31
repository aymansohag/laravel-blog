<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Visitor;

class VisitorController extends Controller
{
    public function visitorIndex(){

    	$visitor_data = Visitor::latest() -> take(1000) -> get();
    	return view('Visitor',[
    		'visitor' => $visitor_data,
    	]);
    }
}
