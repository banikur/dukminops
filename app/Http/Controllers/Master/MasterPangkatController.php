<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterPangkat;

class MasterPangkatController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        $master_pangkat = MasterPangkat::get();

        return view('hr_view.Master.indexmasterpangkat', compact('master_pangkat'));
    }

    public function tambah(Request $req){
        $tambah = MasterPangkat::insert(["nama_pangkat"=>$req->pangkat]);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function edit(Request $req){
        $edit = MasterPangkat::where('id',$req->id_edit)->update(["nama_pangkat"=>$req->pangkat_edit]);

        return redirect()->back()->with(['success'=>'Data Edit']);
    }

    public function hapus($id){
        $del = MasterPangkat::where('id', $id)->delete();

        return redirect()->back()->with(['success'=>'Data Hapus']);
    }
}
