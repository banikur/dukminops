<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDF;
use PhpParser\Node\Stmt\Else_;

class VerifiedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function get_map()
    {
        $prov = DB::table('master_provinsi')->get();
        foreach ($prov as $key) {
            // $seriesData['kode'][] = $key->kode_provinsi;
            // $seriesData['count'][] = DB::table('operasi')->where('prov_id', $key->id)->count();
            $seriesData['kode'][] = [$key->kode_provinsi, DB::table('operasi')->where('prov_id', $key->id)->count()];
        }
        $series = $seriesData;
        return json_encode($series, true);
    }

    public function dashboard_box()
    {

        $data['alldata'] = DB::table('operasi')->count();
        $data['berlangsung'] = DB::table('operasi')->where('status', 2)->count();
        $berlangsung = DB::table('operasi')->where('status', 2)->get();
        $count = 0;

        if ($data['berlangsung'] != 0) {
            foreach ($berlangsung as $key) {
                $count += DB::table('personil')->where('operasi_id', $key->id)->count();
            }
        }


        $data['personil'] = $count;
        return json_encode($data, true);
    }

}
