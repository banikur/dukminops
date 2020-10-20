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
        // $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        //dd($data);
        return view('dashboard_user', $data);
    }

    public function add_operasi_index()
    {
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();
        // $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        //dd($data);
        return view('staff.add_operasi', $data);
    }

    public function store_data(Request $request)
    {
        //dd($request->all());
        $status = 0;
        if (!empty(Auth::guard('user')->check())) {
            $status = 1;
        } else {
            $status = 0;
        }

        $array_master = [
            'nomor_operasi' => $request->nomor_operasi,
            'nama_operasi' => $request->nama_divisi,
            'lokasi' => $request->lokasi,
            'prov_id' => $request->prov,
            'tgl_mulai' => $request->tgl_start,
            'tgl_selesai' => $request->tgl_end,
            'status' => $request->status,
            'jml_personil' => $request->count_personil,
            'jml_anggaran' => str_replace('.', '', $request->anggaran),
            'created_at' => date('Y-m-d h:i:s'),
            'is_wilayah' => $status,
            
        ];
        DB::table('operasi')->insert($array_master);
        $last_id = DB::table('operasi')->orderBy('id', 'DESC')->first();
        $id = $last_id->id;
        $coun_personil = $request->count_personil;
        for ($i = 0; $i < $coun_personil; $i++) {
            $array_personil = [
                'operasi_id' => $id,
                'nama_personil' => $request->nama_personil_s[$i],
                'nip' => $request->nip_s[$i],
                'pangkat' => $request->pangkat_s[$i],
                'satuan_asal' => $request->satuan_s[$i],
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s')
            ];
            DB::table('personil')->insert($array_personil);
        }
        $count_alat = $request->count_alat;

        for ($j = 0; $j < $count_alat; $j++) {
            $array_peralatan = [
                'operasi_id' => $id,
                'nama_peralatan' => $request->nama_peralatan_s[$j],
                'jenis' => $request->jenis_alat_array[$j],
                'jml' => $request->jumlah_alat[$j],
                'created_at' => date('Y-m-d h:i:s')
            ];
            DB::table('peralatan')->insert($array_peralatan);
        }

        $nodetaidok_rencana = $request->nodetaidok_rencana;
        for ($dok_rencana = 0; $dok_rencana < $nodetaidok_rencana; $dok_rencana++) {
            $bukti_bayar = $request->file('dok_perencanaans')[$dok_rencana];
            //dd($bukti_bayar);
            $destination = public_path() . '/upload-dokumen/dok_rencana\\';
            $nama_file2 = 'dok_rencana-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file2);
            $dok_rencana_array = [
                'id_operasi' => $id,
                'path' => $destination,
                'nama_dokumen' => $request->name_dok_perencanaans[$dok_rencana],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 1,
                'dokumen' => $nama_file2,
            ];
            DB::table('dokumen_operasi')->insert($dok_rencana_array);
        }

        $nodetaidok_laporan = $request->nodetaidok_laporan;
        for ($dok_laporan = 0; $dok_laporan < $nodetaidok_laporan; $dok_laporan++) {
            $bukti_bayar = $request->file('dok_pelaporan')[$dok_laporan];
            $destination = public_path() . '/upload-dokumen/dok_laporan\\';
            $nama_file2 = 'dok_laporan-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file2);

            $dok_laporan_array = [
                'id_operasi' => $id,
                'path' => $destination,
                'nama_dokumen' => $request->name_dok_pelaporan[$dok_laporan],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 2,
                'dokumen' => $nama_file2,
            ];
            DB::table('dokumen_operasi')->insert($dok_laporan_array);
        }

        $nodetaidok_anggaran = $request->nodetaidok_anggaran;
        for ($dok_anggaran = 0; $dok_anggaran < $nodetaidok_anggaran; $dok_anggaran++) {
            $bukti_bayar = $request->file('dok_anggaran')[$dok_anggaran];
            $destination = public_path() . '/upload-dokumen/dok_anggaran\\';
            $nama_file2 = 'dok_anggaran-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file2);

            $dok_anggaran_array = [
                'id_operasi' => $id,
                'path' => $destination,
                'nama_dokumen' => $request->name_dok_anggaran[$dok_anggaran],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 3,
                'dokumen' => $nama_file2,
            ];
            DB::table('dokumen_operasi')->insert($dok_anggaran_array);
        }
        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function detail_operasi($id)
    {
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();

        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['dokumenRencana'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',1)->get();
        $data['personil'] = DB::table('personil')->where('operasi_id', $id)->get();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['dokumenPelaporan'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',2)->get();
        $data['dokumenAnggaran'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',3)->get();
        
        return view('staff.detail_operasi', $data);
    }

    public function edit_operasi($id){
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();

        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['dokumenRencana'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',1)->get();
        $data['personil'] = DB::table('personil')->where('operasi_id', $id)->get();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['dokumenPelaporan'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',2)->get();
        $data['dokumenAnggaran'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen',3)->get();
        
        return view('staff.edit_operasi', $data);
    }
}
