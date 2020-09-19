<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use App\Models\MasterProvinsi;

class MasterProvinsiController extends Controller{

    public function __construct()
    {
        
    }

    public function index(){
        $master_provinsi = MasterProvinsi::get();

        return view('hr_view.Master.indexmasterprovinsi', compact('master_provinsi'));
    }

    public function tambah(Request $req){
        $tambah = MasterProvinsi::insert(["nama_prov"=>$req->provinsi]);

        return redirect()->back()->with(['success'=>'Data Simpan']);
    }

    public function edit(Request $req){
        $edit = MasterProvinsi::where('id',$req->id_edit)->update(["nama_prov"=>$req->provinsi_edit]);

        return redirect()->back()->with(['success'=>'Data Edit']);
    }

    public function hapus($id){
        $del = MasterProvinsi::where('id', $id)->delete();

        return redirect()->back()->with(['success'=>'Data Hapus']);
    }
}

?>