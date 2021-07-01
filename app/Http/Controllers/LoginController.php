<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Branch;
use Session;

class LoginController extends Controller
{
    public function admin_index(){
        if (Session::get('id') != null ) {
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

    	$userdata = Admin::where($where)->select('admins.*','branches.name')->join('branches' ,'branches.id','=','admins.branch_id')->first();
    	$count = Admin::where($where)->count();
    	if ($count == 0) {
            $status = [
	            'status' => 'danger',
	            'msg' => 'Username atau password salah'
	        ];

    		return redirect('/login')->with($status);
    	}else{
    		Session::put('id', $userdata->id);
    		Session::put('username', $userdata->username);
            Session::put('branch_id', $userdata->branch_id);
    		Session::put('tipe', 'admin');
    		Session::put('name', $userdata->name);

            $branch_name = Branch::where('id', $userdata->branch_id)->first()->name;

            Session::put('branch_name', $branch_name);

    		return redirect('/dashboard');
    	}
    }

    public function branch_index(){
        if (Session::get('id_branch') != null ) {
            return redirect('cabang/dashboard');
        }else{
            return view('cabang/login/login');
        }
    }
    public function branch_process(Request $req){
        $where = array(
            'username' => $req->username,
            'password' => md5($req->password)
        );

        $userdata = Branch::where($where)->first();
        $count = Branch::where($where)->count();
        if ($count == 0) {
            $status = [
                'status' => 'danger',
                'msg' => 'Username atau password salah'
            ];
            // print_r($where);
            return redirect('/cabang')->with($status);
        }else{
            Session::put('id', $userdata->id);
            Session::put('username', $userdata->username);
            Session::put('tipe', 'cabang');

            return redirect('/cabang/dashboard');
        }
    }
}
