<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EntryOperasiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $operasi = DB::table('operasi')->select('operasi.id','operasi.nama_operasi','m.jenis_operasi','operasi.lokasi','operasi.jml_personil',
        'operasi.tgl_mulai','operasi.status')
        ->leftjoin('master_jenis_operasi as m','m.id','=','operasi.id_jenis_operasi')
        ->get();

        return view('entry_operasi',compact('operasi'));
    }
}
