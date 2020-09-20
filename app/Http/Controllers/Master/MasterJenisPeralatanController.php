<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MasterJenisPeralatan;

class MasterJenisPeralatanController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        $master_jenisperalatan = MasterJenisPeralatan::get();

        return view('hr_view.Master.indexmasterjenisperalatan', compact('master_jenisperalatan'));
    }

    public function tambah(Request $req){
        $tambah = MasterJenisPeralatan::insert(["jenis_peralatan"=>$req->jenis_peralatan]);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function edit(Request $req){
        $edit = MasterJenisPeralatan::where('id',$req->id_edit)->update(["jenis_peralatan"=>$req->jenis_peralatan_edit]);

        return redirect()->back()->with(['success'=>'Data Edit']);
    }

    public function hapus($id){
        $del = MasterJenisPeralatan::where('id', $id)->delete();

        return redirect()->back()->with(['success'=>'Data Hapus']);
    }
}
