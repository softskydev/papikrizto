<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Session;

class LoginController extends Controller
{
    public function admin_index(){
        if (Session::get('id_admin') != null ) {
            return redirect('dashboard');
        }else{
            return view('login/login');
        }
    }

    public function admin_process(Request $req){
    	$where = array(
    		'username' => $req->username,
    		'password' => md5($req->password)
    	);

    	$userdata = Admin::where($where)->first();
    	$count = Admin::where($where)->count();
    	if ($count == 0) {
            $status = [
	            'status' => 'danger',
	            'msg' => 'Username atau password salah'
	        ];
	        print_r($where);
    		// return redirect('/login')->with($status);
    	}else{
    		Session::put('id_admin', $userdata->id_admin);
    		Session::put('username', $userdata->username);
    		Session::put('tipe', 'admin');

    		return redirect('/dashboard');
    	}
    }

    public function branch_index(){

    }
    public function branch_process(){
        
    }
}
