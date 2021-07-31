<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Gallery Index
     */
    public function galleryIndex(){
        return view('Gallery');
    }
    /**
     * Galery Store
     */

    public function galleryStore(Request $request){
        $photoPath = $request -> file('photo') -> store('public');

        $photo_name = (explode('/', $photoPath))[1];
        $host_url = $_SERVER['HTTP_HOST'];
        $location = "http://".$host_url."/storage/".$photo_name;

        $result = Gallery::create([
            'location' => $location,
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    /**
     * Galery Show take 12
     */

     public function galeryShow(){
         $galery = Gallery::take(12) -> get();
         return $galery;
     }

    /**
     * Galery Show load
     */

    public function galeryShowByLoad(Request $request){
        $firs_id = $request -> id; //376,379
        $last_id = $firs_id + 12; //379,382
        $result = Gallery::where('id', '>=', $firs_id) -> where('id', '<', $last_id) -> get();
        return $result;
    }

    /**
     * Galery Photo Delte
     */

    public function galeryDelete(Request $request){
        $old_photo_url = $request -> oldPhotoUrl;
        $old_photo_id = $request -> oldPhotoId;

        $old_photo_url_array = explode("/", $old_photo_url);
        $old_photo_name = end($old_photo_url_array);

        $delete_photo_file = Storage::delete('public', $old_photo_name);
        $delete_row = Gallery::where('id','=',$old_photo_id) -> delete();

        if($delete_row == true){
            return 1;
        }else{
            return 0;
        }
    }
}

