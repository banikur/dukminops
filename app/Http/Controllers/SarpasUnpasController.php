<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJenisPeralatan;
use DB;

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
}
