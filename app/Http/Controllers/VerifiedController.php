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
}
