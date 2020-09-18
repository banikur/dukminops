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
    public function postdata($data, $date)
    {
        date_default_timezone_set("Asia/Bangkok");
        $tanggalskr = date('Y-m-d H:i:s');
        $dates  = date('Y-m-d');

        $users = DB::table('employee')->where('nip', base64_decode($data))->get();
        $cek_absen = DB::table('tbl_absensi')->where('id_pegawai', $users[0]->id_empl)
            ->whereDate('created_at', $dates)
            ->first();
        
        $batas = date('08:00:00');
        if (empty($cek_absen)) {
            $jam_masuk = date('H:i:s');
            if ($jam_masuk > $batas) {
                $status = 2;
            } else {
                $status = 1;
            }
            $data = [
                'created_at' => $tanggalskr,
                'jam_masuk' => $jam_masuk,
                'id_pegawai'=>$users[0]->id_empl,
                'status_keterlambatan' => $status,
                'tgl_absen' => $tanggalskr,
            ];
            DB::table('tbl_absensi')->insert($data);
        } else {
            $id_absen = $cek_absen->id_absensi;
            DB::table('tbl_absensi')->where('id_absensi', $id_absen)->update([
                'jam_keluar' => $tanggalskr,
            ]);
        }


        return view('_blank')->with('message', 'Data Berhasil Disimpan');
    }
}
