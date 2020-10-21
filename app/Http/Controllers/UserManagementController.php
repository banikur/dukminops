<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserManagementController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $data['no'] = 1;
        $data['user'] = DB::table('users')
                        ->select('users.name','users.email','users.id','users_detail.id_user','users_detail.id_provinsi','users_detail.id_kab_kota','users_detail.id as id_detail')
                        ->leftjoin('users_detail','users_detail.id_user','=','users.id')
                        ->get();
                        
        $data['provinsi'] = DB::table('master_provinsi')->get();

        return view('user_management', $data);
    }

    public function getProvinsi(){
        $id_prov = $_GET['provinsi'];

        $master_kab = DB::table('master_kab_kota')->where('id_provinsi', $id_prov)->get();

        return $master_kab;
    }

    public function edit(Request $req){
        $data = [
            "id_user"     => $req->id_user,
            "id_provinsi" => $req->prov_detail,
            "id_kab_kota" => $req->kab_detail,
        ];

        $user_detail = DB::table('users_detail')->where('id',$req->id_user_detail)->update($data);

        return redirect()->back()->with(['success'=>'Data Update']);
    }
}
