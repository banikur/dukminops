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
            ->where('created_by', Auth::user()->id)
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
        $data['master_jenis_peralatan'] = DB::table('master_jenis_peralatan')->where('status', 1)->get();
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
        if (!empty(Auth::guard('user')->user()->id_polda)) {
            $status = 0;
        } else {
            $status = 1;
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
        // dd($count_alat);
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

        
        for ($dok_lapor = 0; $dok_lapor < $request->nodetaidok_laporan; $dok_lapor++) {
            $bukti_bayar = $request->file('dok_pelaporan')[$dok_lapor];
            $destination = public_path() . '/upload-dokumen/dok_lapor\\';
            $nama_file1 = 'dok_lapor-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file1);

            $dok_lapor_array = [
                'id_operasi' => $id,
                'path' => 'upload-dokumen/dok_lapor/',
                'nama_dokumen' => $request->name_dok_pelaporan[$dok_lapor],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 1,
                'dokumen' => $nama_file1,
            ];
            DB::table('dokumen_operasi')->insert($dok_lapor_array);
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
        $data['dok_lapor'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen', 1)->get();

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
        $data['dokumenPerencanan'] = DB::table('dokumen_operasi')->where('id_operasi', $id)->where('kategori_dokumen', 1)->get();

        $data['master_jenis_peralatan'] = DB::table('master_jenis_peralatan')->where('status', 1)->get();
        $data['master_jo'] = DB::table('master_jenis_operasi')->get();

        $data['perencanaan'] = DB::table('perencanaan')->where('operasi_id', $id)->first();
        $data['pa'] = DB::table('pelaporan_akhir')->where('operasi_id', $id)->first();

        return view('staff.edit_operasi', $data);
    }

    public function update_data(Request $request)
    {
        // dd($request);
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

        //perencanaan
        if ($request->hasFIle('dok_perencanaan')) {
            $file_perencanaan = $request->file('dok_perencanaan');
            $destination = public_path() . '/upload-dokumen/dok_rencana\\';
            $nama_file = 'dok_rencana-' . uniqid() . '.' . $file_perencanaan->getClientOriginalExtension();
            $file_perencanaan->move($destination, $nama_file);
            
            DB::table('perencanaan')->where('operasi_id',$id_operasi)->update(["dokumen"=>$nama_file]);
        }
        $perencanaan = [
            "no_renops"         => $request->no_renops,
            "tujuan"            => $request->tujuan,
            "sasaran"           => $request->sasaran,
            "target_operasi"    => $request->target_operasi,
            "cara_bertindak"    => $request->cara_tindak,
        ];
        DB::table('perencanaan')->where('operasi_id',$id_operasi)->update($perencanaan);

        //personil
        $del_personil = DB::table('personil')->where('operasi_id',$id_operasi)->delete();
        $coun_personil = $request->count_personil;
        for ($i = 0; $i < $coun_personil; $i++) {
            $array_personil = [
                'operasi_id' => $id_operasi,
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

        //pelaporan
        if ($request->hasFIle('dok_akhir')) {
            $file_pelaporan = $request->file('dok_akhir');
            $destination1 = public_path() . '/upload-dokumen/dok_laporan\\';
            $nama_file1 = 'dok_laporan-' . uniqid() . '.' . $file_pelaporan->getClientOriginalExtension();
            $file_pelaporan->move($destination1, $nama_file1);

            DB::table('pelaporan_akhir')->where('operasi_id',$id_operasi)->update(['dokumen'=>$nama_file1]);
        }
        $pelaporan = [
            "hasil"     => $request->hasil_akhir,
            "kendala"   => $request->kendala_akhir,
            "evaluasi"  => $request->evaluasi_akhir,
        ];
        DB::table('pelaporan_akhir')->where('operasi_id',$id_operasi)->update($pelaporan);

        //peralatan
        $del_peralatan = DB::table('peralatan')->where('operasi_id', $id_operasi)->delete();
        $count_alat = count($request->nama_peralatan_s);
        // dd($count_alat);
        for ($j = 0; $j < $count_alat; $j++) {
            $array_peralatan = [
                'operasi_id' => $id_operasi,
                'nama_peralatan' => $request->nama_peralatan_s[$j],
                'jenis' => $request->jenis_alat_array[$j],
                'jml' => $request->jumlah_alat[$j],
                'created_at' => date('Y-m-d h:i:s')
            ];
            DB::table('peralatan')->insert($array_peralatan);
        }


        //Edit Table Dokumen Anggaran
        $del_anggaran = DB::table('dokumen_operasi')->where('id_operasi',$id_operasi)->where('kategori_dokumen',3)->delete();
        $nodetaidok_anggaran = $request->nodetaidok_anggaran;
        for ($dok_anggaran = 0; $dok_anggaran < $nodetaidok_anggaran; $dok_anggaran++) {
            $bukti_bayar = $request->file('dok_anggaran')[$dok_anggaran];
            $destination = public_path() . '/upload-dokumen/dok_anggaran\\';
            $nama_file2 = 'dok_anggaran-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file2);

            $dok_anggaran_array = [
                'id_operasi' => $id_operasi,
                'path' => 'upload-dokumen/dok_anggaran/',
                'nama_dokumen' => $request->name_dok_anggaran[$dok_anggaran],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 3,
                'dokumen' => $nama_file2,
            ];
            DB::table('dokumen_operasi')->insert($dok_anggaran_array);
        }

        $del_dok_perencanaan = DB::table('dokumen_operasi')->where('id_operasi',$id_operasi)->where('kategori_dokumen',1)->delete();
        for ($dok_lapor = 0; $dok_lapor < $request->nodetaidok_laporan; $dok_lapor++) {
            $bukti_bayar = $request->file('dok_pelaporan')[$dok_lapor];
            $destination = public_path() . '/upload-dokumen/dok_lapor\\';
            $nama_file1 = 'dok_lapor-' . uniqid() . '.' . $bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->move($destination, $nama_file1);

            $dok_lapor_array = [
                'id_operasi' => $id_operasi,
                'path' => 'upload-dokumen/dok_lapor/',
                'nama_dokumen' => $request->name_dok_pelaporan[$dok_lapor],
                'created_at' => date('Y-m-d h:i:s'),
                'kategori_dokumen' => 1,
                'dokumen' => $nama_file1,
            ];
            DB::table('dokumen_operasi')->insert($dok_lapor_array);
        }
        
        return redirect()->back()->with(['success' => 'Data Update']);
    }

    public function getProvinsi()
    {
        $id_prov = $_GET['provinsi'];

        $master_kab = DB::table('master_kab_kota')->where('id_provinsi', $id_prov)->get();

        return $master_kab;
    }

    public function hapus_operasi($id){
        $operasi = DB::table('operasi')->where('id',$id)->delete();
        $perencanaan = DB::table('perencanaan')->where('operasi_id',$id)->delete();
        $personil = DB::table('personil')->where('operasi_id',$id)->delete();
        $peralatan = DB::table('peralatan')->where('operasi_id',$id)->delete();
        $pelaporan_akhir = DB::table('pelaporan_akhir')->where('operasi_id',$id)->delete();
        $dokumen_operasi = DB::table('dokumen_operasi')->where('kategori_dokumen',3)->where('id_operasi',$id)->delete();

        return redirect()->back()->with(['success'=>'Data Delete']);
    }

    public function cekPersonil(Request $req)
    {
        $nrp = $req->nip;

        $cek = DB::table('operasi')->leftjoin('personil','personil.operasi_id','operasi.id')
                ->where('operasi.status','!=','3')
                ->where('personil.nip',$nrp)
                ->get();

        return $cek;
    }
}
