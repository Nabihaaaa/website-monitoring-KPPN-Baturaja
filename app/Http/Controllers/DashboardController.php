<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianUmum, App\Models\BagianUmumUpload;
use App\Models\SeksiBank, App\Models\SeksiBankUpload;
use App\Models\SeksiMski, App\Models\SeksiMskiUpload;
use App\Models\SeksiPencairanDana, App\Models\SeksiPencairanDanaUpload;
use App\Models\SeksiVera, App\Models\SeksiVeraUpload;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->hasrole('admin')) {
            $role = 'admin';
        }
        else if ($request->user()->hasrole('all')) {
            $role = 'all';
        }else{
            $role = 'user';
        }
        
        $table_data = BagianUmum::getBelumSelesai();

        return view('dashboard', compact('role' ,'table_data'));

    }
    public function undangan(Request $request, $seksi, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        $Sumum = "Bagian Umum";
        $Sbank = "Seksi Bank";
        $Smski = "Seksi MSKI";
        $Sdana = "Seksi Pencairan Dana";
        $Svera = "Seksi Vera";

        $Rumum = "bagian_umum";
        $Rbank = "seksi_bank";
        $Rmski = "seksi_mski";
        $Rdana = "seksi_pencairan_dana";
        $Rvera = "seksi_vera";

        if ($seksi == $Sbank) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'File Undangan Seksi Bank';
            $data = SeksiBankUpload::find($id);
            $role = $Rbank;
        }
        else if ($seksi == $Sumum) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'File Undangan Bagian Umum';
            $data = BagianUmumUpload::find($id);
            $role = $Rumum;
        } 
        else if ($seksi == $Smski) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'File Undangan Seksi MSKI';
            $data = SeksiMskiUpload::find($id);
            $role = $Rmski;
        }
        else if ($seksi == $Sdana) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'File Undangan Seksi Pencairan Dana';
            $data = SeksiPencairanDanaUpload::find($id);
            $role = $Rdana;
        }
        else if ($seksi == $Svera) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'File Undangan Seksi Vera';
            $data = SeksiVera::find($id);
            $role = $Rvera;
        }

        $user = $request->user();

        return view('dashboard.undangan', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'user'
        ));

    }
}
