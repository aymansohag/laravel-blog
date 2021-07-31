<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Contact page show
     *
     * @return void
     */
    public function ContactIndex(){
        return view('Contact');
    }


    /**
     * Get Service Data
     */

    public function getContactData(){
    	$data = Contact::orderBy('id', 'desc') -> get();
    	return $data;
    }

    /**
     * Service Delete
     *
     * @return void
     */
    public function contactDelete(Request $request){
        $id = $request -> id;
        $delete_contact = Contact::find($id);
        $result = $delete_contact -> delete();

        if($result == true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
