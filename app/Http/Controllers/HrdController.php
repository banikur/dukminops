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

        $data['best'] = DB::table('tbl_absensi')
            ->join('employee', 'tbl_absensi.id_pegawai', 'employee.id_empl')
            ->leftJoin('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_absensi.created_at', $bulan)
            ->where('tbl_absensi.status_keterlambatan', 1)
            ->orderBy('tbl_absensi.jam_masuk', 'ASC')
            ->limit(3)->get();

        $data['worst'] = DB::table('tbl_absensi')
            ->join('employee', 'tbl_absensi.id_pegawai', 'employee.id_empl')
            ->leftJoin('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_absensi.created_at', $bulan)
            ->where('tbl_absensi.status_keterlambatan', 2)
            ->orderBy('tbl_absensi.jam_masuk', 'DESC')
            ->limit(3)->get();
        $total_parameter_nilai = DB::table('tbl_parameter_penilaian')->count();
        $data['list_nilai'] = DB::table('employee')
            ->Join('tbl_penilaian_pegawai', 'tbl_penilaian_pegawai.id_pegawai', 'employee.id_empl')
            ->Join('tbl_parameter_penilaian', 'tbl_penilaian_pegawai.id_parameter_penilaian', 'tbl_parameter_penilaian.id_penilaian')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_penilaian_pegawai.created_at', $bulan)
            ->get();
        $data['absen'] = DB::table('tbl_absensi')
            ->join('employee', 'tbl_absensi.id_pegawai', 'employee.id_empl')
            ->leftJoin('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_absensi.created_at', $bulan)
            ->get();
        // dd($data);
        return view('hr_view.dashboard_hrd', $data);
    }

    public function data_pegawai()
    {
        $data['user'] = Auth::user();
        $data['payroll'] = Auth::user();
        $data['divisi'] = DB::table('tbl_master_divisi')->get();
        $data['employee'] = DB::table('users')
            ->join('employee', 'users.id_pegawai', 'employee.id_empl')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->join('tbl_payroll', 'employee.id_empl', 'tbl_payroll.id_pegawai')
            ->where('users.id_pegawai', '!=', null)
            ->get();
        $testing = null;
        foreach ($data['employee'] as $item) {
            $testing = $item->id_empl;
        }

        $rest = (int) substr($testing, -4);
        $no = 0;
        if ($rest == 0) {
            $no = "EMP-0001";
            $autonya = $no;
        } else if ($rest < 9) {
            $no = $rest + 1;

            $autonya = "EMP-000$no";
        } else if ($rest < 99) {
            $no = $rest + 1;

            $autonya = "EMP-00$no";
        } else if ($rest < 999) {
            $no = $rest + 1;

            $autonya = "EMP-0$no";
        } else if ($rest < 9999) {
            $no = $rest + 1;

            $autonya = "EMP-$no";
        } else {
            $autonya = "EMP-0001";
        }
        $data['autonya'] = $autonya;
        //dd($data);
        return view('hr_view.employee_view', $data);
    }

    public function data_absence()
    {
        $bulan = date('m');
        $data['user'] = Auth::user();
        $data['absen'] = DB::table('tbl_absensi')
            ->join('employee', 'tbl_absensi.id_pegawai', 'employee.id_empl')
            ->leftJoin('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_absensi.created_at', $bulan)
            ->get();
        //dd($data);
        return view('hr_view.absence_view', $data);
    }

    public function divisi_view()
    {
        $data['user'] = Auth::user();
        $data['divisi'] = DB::table('tbl_master_divisi')
            ->get();
        return view('hr_view.master_divisi_view', $data);
    }

    public function tunjangan_view()
    {
        $data['user'] = Auth::user();
        $data['divisi'] = DB::table('tbl_parameter_upah')
            ->get();
        return view('hr_view.master_tunjangan_view', $data);
    }

    public function payroll_view()
    {
        $bulan = date('m');
        $data['user'] = Auth::user();
        $data['payroll'] = DB::table('employee')
            ->join('tbl_payroll', 'tbl_payroll.id_pegawai', 'employee.id_empl')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->whereMonth('tbl_payroll.created_at', $bulan)
            ->get();
        $data['employee'] = DB::table('employee')
            // ->leftJoin('tbl_payroll', 'tbl_payroll.id_pegawai', 'employee.id_empl')
            // ->whereMonth('tbl_payroll.created_at',$bulan)
            ->get();
        $data['param'] =  DB::table('tbl_parameter_upah')->get();
        // dd($data['employee']);
        return view('hr_view.master_upah_view', $data);
    }

    public function penilaian_view()
    {
        $data['user'] = Auth::user();
        $data['parameter_penilaian'] = DB::table('tbl_parameter_penilaian')
            ->join('tbl_master_sub_penilaian', 'tbl_master_sub_penilaian.id_sub_penilaian', 'tbl_parameter_penilaian.sub_penilaian')
            ->get();
        $data['sub_nilai'] = DB::table('tbl_master_sub_penilaian')
            ->get();
        return view('hr_view.master_parameter_nilai', $data);
    }

    public function penilaian_pegawai_view()
    {
        $data['user'] = Auth::user();
        $bulan = date('m');
        $data['penilaian_user'] = DB::table('employee')
            ->get();
        $data['list_nilai'] = DB::table('employee')
            ->Join('tbl_penilaian_pegawai', 'tbl_penilaian_pegawai.id_pegawai', 'employee.id_empl')
            ->Join('tbl_parameter_penilaian', 'tbl_penilaian_pegawai.id_parameter_penilaian', 'tbl_parameter_penilaian.id_penilaian')
            ->whereMonth('tbl_penilaian_pegawai.created_at', $bulan)
            ->get();

        $data['parameter_penilaian'] = DB::table('tbl_parameter_penilaian')
            ->join('tbl_master_sub_penilaian', 'tbl_master_sub_penilaian.id_sub_penilaian', 'tbl_parameter_penilaian.sub_penilaian')
            ->get();

        return view('hr_view.penilaian_pegawai_view', $data);
    }

    public function get_data_emp($id_emp)
    {
        $data = DB::table('users')
            ->join('employee', 'users.id_pegawai', 'employee.id_empl')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->join('tbl_payroll', 'employee.id_empl', 'tbl_payroll.id_pegawai')
            ->where('employee.id_empl', base64_decode($id_emp))
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function get_data_divisi($id_divisi)
    {
        $data = DB::table('tbl_master_divisi')
            ->where('tbl_master_divisi.id_divisi', base64_decode($id_divisi))
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function get_data_tunjangan($id_divisi)
    {
        $data = DB::table('tbl_parameter_upah')
            ->where('tbl_parameter_upah.id', base64_decode($id_divisi))
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function get_data_payroll($id_emp)
    {
        $bulan = date('m');
        $data = DB::table('employee')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->join('tbl_payroll', 'employee.id_empl', 'tbl_payroll.id_pegawai')
            ->leftJoin('tbl_payroll_detail', 'employee.id_empl', 'tbl_payroll_detail.id_pegawai')
            ->whereMonth('tbl_payroll_detail.created_at', $bulan)
            ->where('tbl_payroll.id_payroll', $id_emp)
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function get_data_penilaian($id_divisi)
    {
        $data = DB::table('tbl_parameter_penilaian')
            ->join('tbl_master_sub_penilaian', 'tbl_master_sub_penilaian.id_sub_penilaian', 'tbl_parameter_penilaian.sub_penilaian')
            ->where('tbl_parameter_penilaian.id_penilaian', base64_decode($id_divisi))
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function get_data_penilaian_pegawai($id_divisi)
    {
        $data = DB::table('employee')
            ->Join('tbl_penilaian_pegawai', 'tbl_penilaian_pegawai.id_pegawai', 'employee.id_empl')
            ->Join('tbl_parameter_penilaian', 'tbl_penilaian_pegawai.id_parameter_penilaian', 'tbl_parameter_penilaian.id_penilaian')
            ->where('tbl_penilaian_pegawai.id_record', base64_decode($id_divisi))
            ->get();
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function store_employee(request $request)
    {
        $tanggalskr = date('Y-m-d H:i:s');

        try {
            $cek = DB::table('employee')->where('nip', $request->nip)->first();
            if (empty($cek)) {
                $data = ([
                    'id_empl' => $request->id_empl,
                    'nama_empl' => $request->nama_empl,
                    'gender' => $request->gender,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'pass' => $request->pass,
                    'divisi' => $request->position,
                    'nip' => $request->nip,
                ]);

                DB::table('employee')->Insert($data);
                $data_user = ([
                    'name' => $request->nama_empl,
                    'email' => $request->email,
                    'password' => Hash::make($request->pass),
                    'status' => $request->position,
                    'id_pegawai' => $request->id_empl,
                    'created_at' => $tanggalskr,
                ]);
                DB::table('users')->Insert($data_user);
                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
            }
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function update_employee(request $request)
    {
        try {

            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $ubah = DB::table('employee')->where('id_empl', $request->id_emp_edit)
                ->update([
                    'nama_empl' => $request->nama_emp_edit, 'gender' => $request->gender_edit, 'telp' => $request->telp_edit,
                    'email' => $request->email_edit, 'alamat' => $request->alamat_edit,
                    'pass' => $request->pass_edit, 'divisi' => $request->position_edit
                ]);
            $data_user = ([
                'name' => $request->nama_emp_edit,
                'password' => Hash::make($request->pass_edit),
                'email' => $request->email_edit,
                'status' => $request->position_edit,
            ]);
            $update = DB::table('users')->where('email', $request->email_edit)->update($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function update_upah(Request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $data_user = ([
                'payroll' => str_replace(',', '.', str_replace('.', '', $request->nama_upah_edit)),
                'updated_at' => $tanggalskr,
            ]);
            DB::table('tbl_payroll')->where('id_payroll', $request->id_payroll_edit)->update($data_user);

            for ($i = 0; $i < count($request->id_jenis_edit); $i++) {
                $data_detail = ([
                    'payroll_detail' => str_replace(',', '.', str_replace('.', '', $request->upah_edit[$i])),
                    'updated_at' => $tanggalskr,
                ]);
                DB::table('tbl_payroll_detail')->where('id_parameter', $request->id_jenis_edit[$i])->update($data_detail);
            }
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function store_upah(request $request)
    {
        $tanggalskr = date('Y-m-d H:i:s');

        try {
            $cek = DB::table('tbl_payroll')->where('id_pegawai', $request->pegawai)->first();
            if (empty($cek)) {
                $data = ([
                    'id_pegawai' => $request->pegawai,
                    'payroll' => str_replace(',', '.', str_replace('.', '', $request->total_upah)),
                    'created_at' => $tanggalskr,
                ]);
                DB::table('tbl_payroll')->Insert($data);
                for ($i = 0; $i < count($request->upah); $i++) {
                    $data_detail = ([
                        'id_parameter' => $request->id_jenis[$i],
                        'id_pegawai' => $request->pegawai,
                        'payroll_detail' => str_replace(',', '.', str_replace('.', '', $request->upah[$i])),
                        'created_at' => $tanggalskr,
                    ]);
                    DB::table('tbl_payroll_detail')->Insert($data_detail);
                }

                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
            }
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function store_divisi(request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            $data_user = ([
                'divisi_name' => $request->nama_divisi,
                'created_at' => $tanggalskr,
            ]);
            DB::table('tbl_master_divisi')->insert($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Disimpan');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function update_divisi(Request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $data_user = ([
                'divisi_name' => $request->divisi_name_edit,
                'updated_at' => $tanggalskr,
            ]);
            DB::table('tbl_master_divisi')->where('id_divisi', $request->id_emp_edit)->update($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function store_penilaian(request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            $data_user = ([
                'parameter_penilaian' => $request->nama_parameter,
                'sub_penilaian' => $request->position,
                'created_at' => $tanggalskr,
                'status' => 1,
            ]);
            DB::table('tbl_parameter_penilaian')->insert($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Disimpan');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function update_penilaian(request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $data_user = ([
                'parameter_penilaian' => $request->nama_emp_edit,
                'sub_penilaian' => $request->position_edit,
                'updated_at' => $tanggalskr,
            ]);

            DB::table('tbl_parameter_penilaian')->where('id_penilaian', $request->id_emp_edit)->update($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function get_data_user_penilaian($id)
    {
        $cek = DB::table('employee')
            ->leftJoin('tbl_penilaian_pegawai', 'tbl_penilaian_pegawai.id_pegawai', 'employee.id_empl')
            ->where('tbl_penilaian_pegawai.id_pegawai', $id)
            ->get();
        $master_nilai = DB::table('tbl_parameter_penilaian')
            ->get();
        $data[] = array();

        for ($i = 0; $i < count($master_nilai); $i++) {
            if (count($cek) > 0) {
                foreach ($cek as $key) {
                    if ($master_nilai[$i]->id_penilaian == $key->id_parameter_penilaian) { } else {
                        $data[$i]['id_penilaian'] = $master_nilai[$i]->id_penilaian;
                        $data[$i]['parameter_penilaian'] = $master_nilai[$i]->parameter_penilaian;
                    }
                }
            } else {
                $data[$i]['id_penilaian'] = $master_nilai[$i]->id_penilaian;
                $data[$i]['parameter_penilaian'] = $master_nilai[$i]->parameter_penilaian;
            }
        }
        //dd($data);
        $jsonDecode = json_encode($data);
        if ($jsonDecode != null) {
            $sumberBB = $jsonDecode;
        }
        return $sumberBB;
    }

    public function store_nilai_pegawai(request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            $data_user = ([
                'id_parameter_penilaian' => $request->parameter_nilai,
                'id_pegawai' => $request->pegawai,
                'created_at' => $tanggalskr,
                'value' => str_replace(',', '.', str_replace('.', '', $request->nilai)),
            ]);
            DB::table('tbl_penilaian_pegawai')->insert($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Disimpan');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function update_nilai_pegawai(Request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $data_user = ([
                'value' => str_replace(',', '.', str_replace('.', '', $request->nama_upah_edit)),
                'updated_at' => $tanggalskr,
            ]);
            DB::table('tbl_penilaian_pegawai')->where('id_record', $request->id_payroll_edit)->update($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function store_tunjangan(request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            $data_user = ([
                'jenis_parameter' => $request->nama_divisi,
                'created_at' => $tanggalskr,
            ]);
            DB::table('tbl_parameter_upah')->insert($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Disimpan');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Disimpan');
        }
    }

    public function update_tunjangan(Request $request)
    {
        try {
            $tanggalskr = date('Y-m-d H:i:s');
            //dd($request->harga_edit,str_replace('.','',$request->harga_edit));
            $data_user = ([
                'jenis_parameter' => $request->divisi_name_edit,
                'updated_at' => $tanggalskr,
            ]);
            DB::table('tbl_parameter_upah')->where('id', $request->id_emp_edit)->update($data_user);
            return redirect()->back()->with('message', 'Data Berhasil Ubah');
        } catch (exception $th) {
            return redirect()->back()->with('message', 'Data GAGAL Ubah');
        }
    }

    public function cetak_slip($id_payroll)
    {
        $bulan = date('m');
        $data = DB::table('employee')
            ->join('tbl_master_divisi', 'employee.divisi', 'tbl_master_divisi.id_divisi')
            ->join('tbl_payroll', 'employee.id_empl', 'tbl_payroll.id_pegawai')
            ->leftJoin('tbl_payroll_detail', 'employee.id_empl', 'tbl_payroll_detail.id_pegawai')
            ->Join('tbl_parameter_upah', 'tbl_payroll_detail.id_parameter', 'tbl_parameter_upah.id')
            ->whereMonth('tbl_payroll_detail.created_at', $bulan)
            ->where('tbl_payroll.id_payroll', $id_payroll)
            ->get();
        set_time_limit(600);
        $pdf = PDF::setOptions([
            'enable_remote' => true,
            'images' => true,
        ])
            ->loadView(
                'cetak_struk',
                compact('data')
            )
            ->setPaper('letter', 'potrait');
        $name = 'SLIP_GAJI - ' . uniqid() . '.pdf';
        return $pdf->download($name);
    }
}
