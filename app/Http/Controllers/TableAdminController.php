<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BagianUmum;
use App\Models\BagianUmumUpload;
use App\Models\BagianUmumTambahan;
use App\Models\SeksiBank, App\Models\SeksiBankUpload, App\Models\SeksiBankTambahan;
use App\Models\SeksiMski, App\Models\SeksiMskiUpload, App\Models\SeksiMskiTambahan;
use App\Models\SeksiPencairanDana, App\Models\SeksiPencairanDanaUpload, App\Models\SeksiPencairanDanaTambahan;
use App\Models\SeksiVera, App\Models\SeksiVeraUpload, App\Models\SeksiVeraTambahan;

class TableAdminController extends Controller
{
    
    public function umum()
    {
        $table_name = 'Bagian Umum';
        $table_category = 'Tabel Monitoring Kegiatan Bagian Bank';
        $table_data = BagianUmum::get();

        return view('table-admin.umum', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function bank()
    {
        $table_name = 'Seksi Bank';
        $table_category = 'Tabel Monitoring Kegiatan Seksi Bank';
        $table_data = SeksiBank::get();

        return view('table-admin.bank', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function mski()
    {
        $table_name = 'Seksi Manajemen Satker dan Kepatuhan Internal';
        $table_category = 'Tabel Monitoring Kegiatan Seksi MSKI';
        $table_data = SeksiMski::get();

        return view('table-admin.mski', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function dana()
    {
        $table_name = 'Seksi Pencairan Dana';
        $table_category = 'Tabel Monitoring Kegiatan Seksi Pencairan Dana';
        $table_data = SeksiPencairanDana::get();

        return view('table-admin.dana', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function vera()
    {
        $table_name = 'Seksi Verifikasi dan Akuntansi';
        $table_category = 'Tabel Monitoring Kegiatan Seksi Vera';
        $table_data = SeksiVera::get();

        return view('table-admin.vera', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }
   
    
}
