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

    public function index($param)
    {
        if ($param == 'ops-intelejen') {
            $operasi = DB::table('operasi')
                ->where('id_jenis_operasi', 0)
                ->where('id_polda', null)
                ->where('id_polres', null)
                ->get();
        } elseif ($param == 'ops-penegakan') {
            $operasi = DB::table('operasi')
                ->where('id_jenis_operasi', 2)
                ->where('id_polda', null)
                ->where('id_polres', null)
                ->get();
        } elseif ($param == 'ops-pengamanan') {
            $operasi = DB::table('operasi')
                ->where('id_jenis_operasi', 3)
                ->where('id_polda', null)
                ->where('id_polres', null)
                ->get();
        } elseif ($param == 'ops-pemeliharaan') {
            $operasi = DB::table('operasi')
                ->where('id_jenis_operasi', 4)
                ->where('id_polda', null)
                ->where('id_polres', null)
                ->get();
        } elseif ($param == 'ops-pemulihan') {
            $operasi = DB::table('operasi')
                ->where('id_jenis_operasi', 5)
                ->where('id_polda', null)
                ->where('id_polres', null)
                ->get();
        } else {
            $operasi = DB::table('operasi')->get();
        }

        return view('staff.daftar_sarpasunpas', compact('operasi', 'param'));
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
        $param = $data['operasi']->id_jenis_operasi;

        if ($param == 0) {
            $data['jenis_ops'] = 'ops-intelejen';
        } elseif ($param == 2) {
            $data['jenis_ops'] = 'ops-penegakan';
        } elseif ($param == 3) {
            $data['jenis_ops'] = 'ops-pengamanan';
        } elseif ($param == 4) {
            $data['jenis_ops'] = 'ops-pemeliharaan';
        } elseif ($param == 5) {
            $data['jenis_ops'] = 'ops-pemulihan';
        }
        return view('staff.detail_sarpasunpas', $data);
    }

    public function filterindexpusat(Request $req)
    {

        $status = $req->lokasi_filter;
        $tgl = $req->tanggal_filter;
        $param = $req->param;
        if ($param == 'ops-intelejen') {
            $jenis = 0;
        } elseif ($param == 'ops-penegakan') {
            $jenis = 2;
        } elseif ($param == 'ops-pengamanan') {
            $jenis = 3;
        } elseif ($param == 'ops-pemeliharaan') {
            $jenis = 4;
        } elseif ($param == 'ops-pemulihan') {
            $jenis = 5;
        }
        // dd($operasi);
        $operasi = DB::table('operasi')->where('id_jenis_operasi', $jenis)
            ->where('id_polda', '=', null)
            ->where('id_polres', '=', null)
            ->when($status, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($tgl, function ($q, $tgl) {
                $q->where('tgl_mulai', $tgl);
            })
            ->get();

        return view('staff.daftar_sarpasunpas', compact('operasi', 'param'));
    }

    public function indexwilayah($param)
    {
        $id_polda = Auth::guard('user')->user()->id_polda;
        $id_polres = Auth::guard('user')->user()->id_polres;
        $data_polda = DB::table('users')->where('id_polda', '!=', null)
            ->where('id_polres', null)->get();
        $data_polres = DB::table('users')->where('id_polres', '!=', null)
            ->get();
        // dd($id_polres,$id_polda);
        if (!empty($id_polda) || !empty($id_polres)) {
            if ($param == 'ops-intelejen') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 0)
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            } elseif ($param == 'ops-penegakan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 2)
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            } elseif ($param == 'ops-pengamanan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 3)
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            } elseif ($param == 'ops-pemeliharaan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 4)
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            } elseif ($param == 'ops-pemulihan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 5)
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            } else {
                $operasi = DB::table('operasi')
                    ->where('id_polda', $id_polda)
                    ->where('id_polres', $id_polres)
                    ->get();
            }
        } else {
            //user mabes
            if ($param == 'ops-intelejen') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 0)
                    ->where('created_by', '!=', Auth::guard('user')->user()->id)
                    // ->where('id_polda', '!=', null)
                    // ->where('id_polres', '!=', null)
                    ->get();
            } elseif ($param == 'ops-penegakan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 2)
                    ->where('created_by', '!=', Auth::guard('user')->user()->id)
                    // ->where('id_polda', '!=', null)
                    // ->where('id_polres', '!=', null)
                    ->get();
            } elseif ($param == 'ops-pengamanan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 3)
                    ->where('created_by', '!=', Auth::guard('user')->user()->id)
                    // ->where('id_polda', '!=', null)
                    // ->where('id_polres', '!=', null)
                    ->get();
            } elseif ($param == 'ops-pemeliharaan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 4)
                    ->where('created_by', '!=', Auth::guard('user')->user()->id)
                    // ->where('id_polda', '!=', null)
                    // ->where('id_polres', '!=', null)
                    ->get();
            } elseif ($param == 'ops-pemulihan') {
                $operasi = DB::table('operasi')
                    ->where('id_jenis_operasi', 5)
                    ->where('created_by', '!=', Auth::guard('user')->user()->id)
                    // ->where('id_polda', '!=', null)
                    // ->where('id_polres', '!=', null)
                    ->get();
            } else {
                $operasi = DB::table('operasi')->get();
            }
        }
        // dd($operasi);
        return view('staff.inteligen_wilayah', compact('operasi', 'param', 'data_polda', 'data_polres'));
    }

    public function filterindexwilayah(Request $req)
    {
        
        $status = $req->lokasi_filter;
        $tgl = $req->tanggal_filter;
        $param = $req->param;
        $data_polda = DB::table('users')->where('id_polda', '!=', null)
            ->where('id_polres', null)->get();
        $data_polres = DB::table('users')->where('id_polres', '!=', null)
            ->get();

        if ($param == 'ops-intelejen') {
            $jenis = 0;
        } elseif ($param == 'ops-penegakan') {
            $jenis = 2;
        } elseif ($param == 'ops-pengamanan') {
            $jenis = 3;
        } elseif ($param == 'ops-pemeliharaan') {
            $jenis = 4;
        } elseif ($param == 'ops-pemulihan') {
            $jenis = 5;
        }

        
        $auth_polda = Auth::guard('user')->user()->id_polda;
        $auth_polres = Auth::guard('user')->user()->id_polres;
        if($req->polda!=null){
            $polda  = $req->polda;
        }else{
            $polda = $auth_polda;
        }
        if($req->polres!=null){
            $polres = $req->polres;
        }else{
            $polres=$auth_polres;
        }
        // dd([$polda,$polres,$jenis]);
        if (!empty($polda) || !empty($polres)) {
            $operasi = DB::table('operasi')->where('id_jenis_operasi', $jenis)
                ->where('id_polda', $polda)
                ->where('id_polres', $polres)
                ->when($status, function ($q, $status) {
                    $q->where('status', $status);
                })
                ->when($tgl, function ($q, $tgl) {
                    $q->where('tgl_mulai', $tgl);
                })
                ->get();
        } else {
            $operasi = DB::table('operasi')->where('id_jenis_operasi', $jenis)
                ->where('created_by', '!=', Auth::guard('user')->user()->id)
                // ->where('id_polda','!=', $polda)
                // ->where('id_polres','!=', $polres)
                ->when($status, function ($q, $status) {
                    $q->where('status', $status);
                })
                ->when($tgl, function ($q, $tgl) {
                    $q->where('tgl_mulai', $tgl);
                })
                ->get();
        }

        return view('staff.inteligen_wilayah', compact('operasi', 'param', 'data_polda', 'data_polres'));
    }
}
