<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PDF;

class InputDataController extends Controller
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


    public function data_entry()
    {
        $operasi = DB::table('operasi')->select(
            'operasi.id',
            'operasi.nama_operasi',
            'm.jenis_operasi',
            'operasi.lokasi',
            'operasi.jml_personil',
            'operasi.tgl_mulai',
            'operasi.status'
        )
            ->leftjoin('master_jenis_operasi as m', 'm.id', '=', 'operasi.id_jenis_operasi')
            ->get();

        return view('staff.entry_operasi', compact('operasi'));
    }

    public function index()
    {
        $data['user'] = Auth::user();
        // $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        //dd($data);
        return view('staff.dashboard_user', $data);
    }

    public function add_operasi_index()
    {
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();
        $data['master_jo'] = DB::table('master_jenis_operasi')->get();
        // $data['employee'] = DB::table('employee')->where('id_empl', Auth::user()->id_pegawai)->get();
        //dd($data);
        return view('staff.add_operasi', $data);
    }

    public function store_data(Request $request)
    {
        //dd($request->all());

        /* 
            Status 1 = mabes
            status 2 = provinsi (polda)
            status 3 = polres
        */
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
            'jml_anggaran' => str_replace(',', '.', str_replace('.', '', $request->anggaran)),
            'created_at' => date('Y-m-d h:i:s'),
            'is_wilayah' => $status,
            'kabkota_id' => $request->kabupaten,
            'id_jenis_operasi'  => $request->jenis_operasi,
            'id_polda' => Auth::guard('user')->user()->id_polda,
            'id_polres' => Auth::guard('user')->user()->id_polres,
            'created_by' => Auth::guard('user')->user()->id,
        ];
        DB::table('operasi')->insert($array_master);

        //personil
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
                'created_at' => date('Y-m-d h:i:s'),
                'jabatan_struktural' => $request->jab_struk[$i],
                'jabatan_fungsional' => $request->jab_fung[$i],
            ];
            DB::table('personil')->insert($array_personil);
        }

        //peralatan
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

        //perencanan
        if ($request->hasFIle('dok_perencanaan')) {
            $file_perencanaan = $request->file('dok_perencanaan');
            $destination = public_path() . '/upload-dokumen/dok_rencana\\';
            $nama_file = 'dok_rencana-' . uniqid() . '.' . $file_perencanaan->getClientOriginalExtension();
            $file_perencanaan->move($destination, $nama_file);
        } else {
            $nama_file = null;
        }
        $perencanaan = [
            "operasi_id"        => $id,
            "no_renops"         => $request->no_renops,
            "tujuan"            => $request->tujuan,
            "sasaran"           => $request->sasaran,
            "target_operasi"    => $request->target_operasi,
            "cara_bertindak"    => $request->cara_tindak,
            "dokumen"           => $nama_file,
        ];
        DB::table('perencanaan')->insert($perencanaan);

        //pelaporan
        if ($request->hasFIle('dok_akhir')) {
            $file_pelaporan = $request->file('dok_akhir');
            $destination1 = public_path() . '/upload-dokumen/dok_laporan\\';
            $nama_file1 = 'dok_laporan-' . uniqid() . '.' . $file_pelaporan->getClientOriginalExtension();
            $file_pelaporan->move($destination1, $nama_file1);
        } else {
            $nama_file1 = null;
        }
        $pelaporan = [
            "operasi_id" => $id,
            "hasil"     => $request->hasil_akhir,
            "kendala"   => $request->kendala_akhir,
            "evaluasi"  => $request->evaluasi_akhir,
            "dokumen"   => $nama_file1,
        ];
        DB::table('pelaporan_akhir')->insert($pelaporan);

        //anggaran
        $nodetaidok_anggaran = $request->nodetaidok_anggaran;
        for ($dok_anggaran = 0; $dok_anggaran < $nodetaidok_anggaran; $dok_anggaran++) {
            $bukti_bayar = $request->file('dok_anggaran')[$dok_anggaran];
            $destination = public_path() . '/upload-dokumen/dok_anggaran\\';
            $nama_file2 = 'dok_anggaran-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file2);

            $dok_anggaran_array = [
                'id_operasi' => $id,
                'path' => 'upload-dokumen/dok_anggaran/',
                'nama_dokumen' => $request->name_dok_anggaran[$dok_anggaran],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 3,
                'dokumen' => $nama_file2,
            ];
            DB::table('dokumen_operasi')->insert($dok_anggaran_array);
        }
        return redirect()->back()->with(['success' => 'Data Simpan']);
    }

    public function detail_operasi($id)
    {
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();

        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['personil'] = DB::table('personil')
            ->leftjoin('master_pangkat', 'master_pangkat.id', '=', 'personil.pangkat')
            ->where('operasi_id', $id)->get();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['master_jo'] = DB::table('master_jenis_operasi')->get();
        $data['dokumenAnggaran'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen', 3)->get();

        $data['perencanaan'] = DB::table('perencanaan')->where('operasi_id', $id)->first();
        $data['pa'] = DB::table('pelaporan_akhir')->where('operasi_id', $id)->first();

        return view('staff.detail_operasi', $data);
    }

    public function edit_operasi($id)
    {
        $data['user'] = Auth::user();
        $data['provinsi'] = DB::table('master_provinsi')->get();
        $data['master_pangkat'] = DB::table('master_pangkat')->get();

        $data['operasi'] = DB::table('operasi')->where('id', $id)->first();
        $data['personil'] = DB::table('personil')
            ->leftjoin('master_pangkat', 'master_pangkat.id', '=', 'personil.pangkat')
            ->where('operasi_id', $id)->get();
        $data['peralatan'] = DB::table('peralatan')->where('operasi_id', $id)->get();
        $data['dokumenAnggaran'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen', 3)->get();

        $data['master_jo'] = DB::table('master_jenis_operasi')->get();

        $data['perencanaan'] = DB::table('perencanaan')->where('operasi_id', $id)->first();
        $data['pa'] = DB::table('pelaporan_akhir')->where('operasi_id', $id)->first();

        return view('staff.edit_operasi', $data);
    }

    public function update_data(Request $request)
    {
        // dd($req);
        $status = 0;
        if (!empty(Auth::guard('user')->check())) {
            $status = 1;
        } else {
            $status = 0;
        }
        //kunci
        $id_operasi = $request->id_operasi;

        //Edit Table Master
        $array_master = [
            'nomor_operasi' => $request->nomor_operasi,
            'nama_operasi' => $request->nama_divisi,
            'lokasi' => $request->lokasi,
            'prov_id' => $request->prov,
            'tgl_mulai' => $request->tgl_start,
            'tgl_selesai' => $request->tgl_end,
            'status' => $request->status,
            'jml_personil' => $request->count_personil,
            'jml_anggaran' => str_replace(',', '.', str_replace('.', '', $request->anggaran)),
            'created_at' => date('Y-m-d h:i:s'),
            'is_wilayah' => $status,
            "kabkota_id" => $request->kabupaten,
            "id_jenis_operasi" => $request->jenis_operasi,
        ];
        DB::table('operasi')->where('id', $id_operasi)->update($array_master);

        //Edit Table Personil
        // $del_personil = DB::table('personil')->where('operasi_id', $id_operasi)->delete();
        // $nama_personil = count($request->nama_personil_s);
        // for ($i = 0; $i < $nama_personil; $i++) {
        //     $array_personil = [
        //         'operasi_id' => $id_operasi,
        //         'nama_personil' => $request->nama_personil_s[$i],
        //         'nip' => $request->nip_s[$i],
        //         'pangkat' => $request->pangkat_s[$i],
        //         'satuan_asal' => $request->satuan_s[$i],
        //         'status' => 1,
        //         'updated_at' => date('Y-m-d h:i:s')
        //     ];
        //     DB::table('personil')->insert($array_personil);
        // }

        //Edit Table Pelaralat
        // $del_peralatan = DB::table('peralatan')->where('operasi_id', $id_operasi)->delete();
        // $nama_peralatan = count($request->nama_peralatan_s);
        // for ($j = 0; $j < $nama_peralatan; $j++) {
        //     $array_peralatan = [
        //         'operasi_id' => $id_operasi,
        //         'nama_peralatan' => $request->nama_peralatan_s[$j],
        //         'jenis' => $request->jenis_alat_array[$j],
        //         'jml' => $request->jumlah_alat[$j],
        //         'updated_at' => date('Y-m-d h:i:s')
        //     ];
        //     DB::table('peralatan')->insert($array_peralatan);
        // }

        //EDit Table Dokumen Perencanaan
        // $del_dok_rencana = DB::table('dokumen_operasi')->where('id_operasi', $id_operasi)->delete();
        // $name_dok_perencanaans = count($request->name_dok_perencanaans);
        // for ($dok_rencana = 0; $dok_rencana < $name_dok_perencanaans; $dok_rencana++) {
        //     if ($request->hasFile('dok_perencanaans')) {
        //         $bukti_bayar = $request->file('dok_perencanaans')[$dok_rencana];
        //         $destination = public_path() . '/upload-dokumen/dok_rencana\\';
        //         $nama_file2 = 'dok_rencana-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
        //         $bukti_bayar->move($destination, $nama_file2);
        //         $dok_rencana_array = [
        //             'id_operasi' => $id_operasi,
        //             'path' => 'upload-dokumen/dok_rencana/',
        //             'nama_dokumen' => $request->name_dok_perencanaans[$dok_rencana],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 1,
        //             'dokumen' => $nama_file2,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_rencana_array);
        //     } else {
        //         $dok_rencana_array = [
        //             'id_operasi' => $id_operasi,
        //             'nama_dokumen' => $request->name_dok_perencanaans[$dok_rencana],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 1,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_rencana_array);
        //     }
        // }

        //Edit Table Documen Pelaporan
        // $name_dok_pelaporan = count($request->name_dok_pelaporan);
        // for ($dok_laporan = 0; $dok_laporan < $name_dok_pelaporan; $dok_laporan++) {
        //     if ($request->hasFile('dok_pelaporan')) {
        //         $bukti_bayar = $request->file('dok_pelaporan')[$dok_laporan];
        //         $destination = public_path() . '/upload-dokumen/dok_laporan\\';
        //         $nama_file2 = 'dok_laporan-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
        //         $bukti_bayar->move($destination, $nama_file2);

        //         $dok_laporan_array = [
        //             'id_operasi' => $id_operasi,
        //             'path' => 'upload-dokumen/dok_laporan/',
        //             'nama_dokumen' => $request->name_dok_pelaporan[$dok_laporan],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 2,
        //             'dokumen' => $nama_file2,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_laporan_array);
        //     } else {
        //         $dok_laporan_array = [
        //             'id_operasi' => $id_operasi,
        //             'nama_dokumen' => $request->name_dok_pelaporan[$dok_laporan],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 2,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_laporan_array);
        //     }
        // }

        //Edit Table Dokumen Anggaran
        // $name_dok_anggaran = count($request->name_dok_anggaran);
        // for ($dok_anggaran = 0; $dok_anggaran < $name_dok_anggaran; $dok_anggaran++) {
        //     if ($request->hasFile('dok_anggaran')) {
        //         $bukti_bayar = $request->file('dok_anggaran')[$dok_anggaran];
        //         $destination = public_path() . '/upload-dokumen/dok_anggaran\\';
        //         $nama_file2 = 'dok_anggaran-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
        //         $bukti_bayar->move($destination, $nama_file2);

        //         $dok_anggaran_array = [
        //             'id_operasi' => $id_operasi,
        //             'path' => 'upload-dokumen/dok_anggaran/',
        //             'nama_dokumen' => $request->name_dok_anggaran[$dok_anggaran],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 3,
        //             'dokumen' => $nama_file2,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_anggaran_array);
        //     } else {
        //         $dok_anggaran_array = [
        //             'id_operasi' => $id_operasi,
        //             'nama_dokumen' => $request->name_dok_anggaran[$dok_anggaran],
        //             'created_at' => date('Y-m-d h:i:s'),
        //             'kategori_dokumen' => 3,
        //         ];
        //         DB::table('dokumen_operasi')->insert($dok_anggaran_array);
        //     }
        // }
        return redirect()->back()->with(['success' => 'Data Update']);
    }

    public function getProvinsi()
    {
        $id_prov = $_GET['provinsi'];

        $master_kab = DB::table('master_kab_kota')->where('id_provinsi', $id_prov)->get();

        return $master_kab;
    }
}
