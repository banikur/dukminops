<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJenisPeralatan;
use DB;
use Auth;

class SarpasUnpasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $operasi = DB::table('operasi')->get();

        return view('daftar_sarpasunpas',compact('operasi'));
    }

    public function detailSarpasUnpas($id){
        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['personil'] = DB::table('personil')->where('operasi_id', $id)->get();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['no'] = 1;

        return view('detail_sarpasunpas', $data);
    }
}
