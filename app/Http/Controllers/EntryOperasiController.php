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
        $operasi = DB::table('operasi')->get();

        return view('entry_operasi',compact('operasi'));
    }
}
