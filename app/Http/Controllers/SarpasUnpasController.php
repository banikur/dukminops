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

    public function index()
    {
        $operasi = DB::table('operasi')->get();

        return view('staff.daftar_sarpasunpas', compact('operasi'));
    }

    public function detailSarpasUnpas($id)
    {
        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['personil'] = DB::table('personil')
            ->leftjoin('master_pangkat as mp', 'mp.id', '=', 'personil.pangkat')
            ->where('operasi_id', $id)->get();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['no'] = 1;

        return view('staff.detail_sarpasunpas', $data);
    }

    public function filterindexpusat(Request $req)
    {
        $status = $req->lokasi_filter;
        $tgl = $req->tanggal_filter;
        $operasi = DB::table('operasi')
            ->when($status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($tgl, function ($q, $tgl) {
                $q->where('tgl_mulai', $tgl);
            })
            ->get();

        return view('staff.daftar_sarpasunpas', compact('operasi'));
    }

    public function indexwilayah()
    {
        $operasi = DB::table('operasi')->get();

        return view('staff.inteligen_wilayah', compact('operasi'));
    }

    public function filterindexwilayah(Request $req)
    {
        $polda  = $req->polda;
        $polres = $req->polres;
        $status = $req->lokasi_filter;
        $tgl = $req->tanggal_filter;

        $operasi = DB::table('operasi')
            ->when($status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($tgl, function ($q, $tgl) {
                $q->where('tgl_mulai', $tgl);
            })
            ->get();

        return view('staff.inteligen_wilayah', compact('operasi'));
    }
}
