<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use PhpParser\Node\Expr\FuncCall;

class LoginController extends Controller
{
    /**
     * Login Index
     *
     * @return void
     */
    public function index(){
        return view('Login');
    }

    /**
     * Login
     *
     * @return void
     */
    public function onLogin(Request $request){
        $uname = $request -> username;
        $pass  = $request -> password;

        $data = Admin::where('uname',$uname) -> where('password', $pass) -> count();

        if($data == 1){
            $request -> session() -> put('user', $uname);
            return 1;
        }else{
            return 0;
        }
    }

    public function onLogout(Request $request){
        $request -> session() -> flush();
        return redirect('Login');
    }
}
