<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use PDF;

class HrdController extends Controller
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
        date_default_timezone_set("Asia/Bangkok");
        $tanggalskr = date('Y-m-d');
        $bulan = date('m');
        $data['user'] = Auth::user();


        // dd($data);
        return view('hr_view.dashboard_hrd', $data);
    }
}
