<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterJenisOperasi;

class MasterJenisOperasiController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        $master_pangkat = MasterJenisOperasi::get();

        return view('hr_view.Master.index_operasi', compact('master_pangkat'));
    }

    public function tambah(Request $req){
        $tambah = MasterJenisOperasi::insert(["nama_pangkat"=>$req->pangkat]);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function edit(Request $req){
        $edit = MasterJenisOperasi::where('id',$req->id_edit)->update(["nama_pangkat"=>$req->pangkat_edit]);

        return redirect()->back()->with(['success'=>'Data Edit']);
    }

    public function hapus($id){
        $del = MasterJenisOperasi::where('id', $id)->delete();

        return redirect()->back()->with(['success'=>'Data Hapus']);
    }
}
