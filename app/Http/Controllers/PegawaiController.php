<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDF;

class PegawaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user'] = Auth::user();
        $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        //dd($data);
        return view('dashboard_user', $data);
    }

    public function index_nilai()
    {
        $bulan = date('m');
        $data['user'] = Auth::user();
        $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        $data['list_nilai'] = DB::table('employee')
            ->Join('tbl_penilaian_pegawai', 'tbl_penilaian_pegawai.id_pegawai', 'employee.id_empl')
            ->Join('tbl_parameter_penilaian', 'tbl_penilaian_pegawai.id_parameter_penilaian', 'tbl_parameter_penilaian.id_penilaian')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_penilaian_pegawai.created_at', $bulan)
            ->where('tbl_penilaian_pegawai.id_pegawai',Auth::user()->id_pegawai)
            ->get();
        return view('nilai_user', $data);
    }
}
