<?php

namespace App\Http\Controllers\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ReferensiKegiatan,App\Models\ReferensiPegawai;
use App\Models\BagianUmum;
use App\Models\BagianUmumUpload;
use App\Models\BagianUmumTambahan;
use App\Models\SeksiBank, App\Models\SeksiBankUpload, App\Models\SeksiBankTambahan;
use App\Models\SeksiMski, App\Models\SeksiMskiUpload, App\Models\SeksiMskiTambahan;
use App\Models\SeksiPencairanDana, App\Models\SeksiPencairanDanaUpload, App\Models\SeksiPencairanDanaTambahan;
use App\Models\SeksiVera, App\Models\SeksiVeraUpload, App\Models\SeksiVeraTambahan;

class TableUserController extends Controller
{
   //Undangan
    public function indexUndangan(request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'File Undangan Seksi Bank';
            $role = $bank;
            $data = SeksiBankUpload::find($id);
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'File Undangan Bagian Umum';
     
            $role = $umum;
            $data = BagianUmumUpload::find($id);
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'File Undangan Seksi MSKI';
         
            $role = $mski;
            $data = SeksiMskiUpload::find($id);
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'File Undangan Seksi Pencairan Dana';
          
            $role = $dana;
            $data = SeksiPencairanDanaUpload::find($id);
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'File Undangan Seksi Vera';
      
            $role = $vera;
            $data = SeksiVera::find($id);
        }

        $r = 'user';

        return view('undangan.index', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'r'
        ));

    }

    public function uploadUndangan(request $request,$id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'Upload Undangan Seksi Bank';
            $role = $bank;
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'Upload Undangan Bagian Umum';
            $role = $umum;
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload Undangan Seksi MSKI';
            $role=$mski;
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'Upload Undangan Seksi Pencairan Dana';
            $role=$dana;
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload Undangan Seksi Vera';
            $role=$vera;
        }

        return view('undangan.upload', compact(
            'table_name', 
            'table_category', 
            'role',
            'id'
        ));
        
    }

    public function storeUndangan(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($request->user()->hasrole($bank)) {
            $role = new SeksiBankUpload();
            $nama = $bank;
        }
        else if ($request->user()->hasrole($umum)) {
            $role = new BagianUmumUpload();
            $nama = $umum;
        } 
        else if ($request->user()->hasrole($mski)) {
            $role = new SeksiMskiUpload();
            $nama = $mski;
        }
        else if ($request->user()->hasrole($dana)) {
            $role = new SeksiPencairanDanaUpload();
            $nama = $dana;
        }
        else if ($request->user()->hasrole($vera)) {
            $role = new SeksiVeraUpload();
            $nama = $vera;
        }
        $this->dataUndangan($request, $role, $id,$nama);
        return redirect('/table-kegiatan')->with('success', 'Undangan berhasil diupload!');
        
    }

    public function dataUndangan($request, $role, $id ,$nama){
        $undangan = $request->hasFile('undangan') ? $request->file('undangan')->get() : null;
        $Tundangan = $request->hasFile('undangan') ? $request->file('undangan')->getClientMimeType() : null;
        $Nundangan = $request->hasFile('undangan') ? $request->file('undangan')->getClientOriginalName() : null;

        
        $role->id=$id;
        $role->{"id_{$nama}"}= $id;
        $role->undangan = $undangan;
        $role->filename_undangan = $Nundangan;
        $role->type_undangan = $Tundangan;
        $role->save();   
    }

    public function editUndangan(request $request,$id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'Edit Undangan Seksi Bank';
            $role = $bank;
            $data = SeksiBankUpload::find($id);
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'Edit Undangan Bagian Umum';
            $role = $umum;
            $data = BagianUmumUpload::find($id);
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit Undangan Seksi MSKI';
            $role=$mski;
            $data = SeksiMskiUpload::find($id);
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'Edit Undangan Seksi Pencairan Dana';
            $role=$dana;
            $data = SeksiPencairanDanaUpload::find($id);
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit Undangan Seksi Vera';
            $role=$vera;
            $data = SeksiveraUpload::find($id);
        }

        return view('undangan.edit', compact(
            'table_name', 
            'table_category', 
            'role',
            'id',
            'data'
        ));
        
    }

    public function updateUndangan(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        
        
        if ($request->user()->hasrole($bank)) {
            $role = SeksiBankUpload::find($id);
        }
        else if ($request->user()->hasrole($umum)) {
            $role = BagianUmumUpload::find($id); 
        } 
        else if ($request->user()->hasrole($mski)) {
            $role = SeksiMskiUpload::find($id);
        }
        else if ($request->user()->hasrole($dana)) {
            $role = SeksiPencairanDanaUpload::find($id); 
        }
        else if ($request->user()->hasrole($vera)) {
            $role = SeksiVeraUpload::find($id);
        }
        $this->dataUndanganUpdate($request, $role, $id);
        return redirect('/table-kegiatan')->with('success', 'Undangan berhasil diupdate!');
    }

    public function dataUndanganUpdate($request, $role, $id){
        $undangan = $request->hasFile('undangan') ? $request->file('undangan')->get() : $role->undangan;
        $Tundangan = $request->hasFile('undangan') ? $request->file('undangan')->getClientMimeType() : $role->type_undangan;
        $Nundangan = $request->hasFile('undangan') ? $request->file('undangan')->getClientOriginalName() : $role->filename_undangan;

        $role->undangan = $undangan;
        $role->filename_undangan = $Nundangan;
        $role->type_undangan = $Tundangan;
        $role->save();   
    }

    //file

    public function showFile($id, $tablename, $column)
    {
        $file =  DB::table("{$tablename}_upload")->find($id);
        return response($file->$column)->header('Content-Type', $file->{'type_'.$column});
    }  

    public function showFileTambahan($id, $tablename, $column, $idupload)
    {
        $file =  DB::table("{$tablename}_tambahan")
            ->where([["id_{$tablename}",$id],['id',$idupload]])
            ->get();
    
        foreach ($file as $item) {
            return response($item->$column)->header('Content-Type', $item->{'type_'.$column});
        }
    }

    //Bukti
    public function indexBukti(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Bukti Seksi Bank';
            $table_category = 'File Bukti Seksi Bank';
            $role = $bank;
            $data = SeksiBankUpload::find($id);
            $tambahan = SeksiBankTambahan::where($idbank,$id)->get();
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bukti Bagian Umum';
            $table_category = 'File Bukti Bagian Umum';
            $role = $umum;
            $data = BagianUmumUpload::find($id);
            $tambahan = BagianUmumTambahan::where($idumum,$id)->get();
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Bukti Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'File Bukti Seksi MSKI';
            $role = $mski;
            $data = SeksiMskiUpload::find($id);
            $tambahan = SeksiMskiTambahan::where($idmski,$id)->get();
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Bukti Seksi Pencairan Dana';
            $table_category = 'File Bukti Seksi Pencairan Dana';
            $role = $dana;
            $data = SeksiPencairanDanaUpload::find($id);
            $tambahan = SeksiPencairanDanaTambahan::where($iddana,$id)->get();
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Bukti Seksi Verifikasi dan Akuntansi';
            $table_category = 'File Bukti Seksi Vera';
            $role = $vera;
            $data = SeksiVeraUpload::find($id);
            $tambahan = SeksiVeraTambahan::where($idvera,$id)->get();
        }

        $r = 'user';
        
        return view('bukti.index', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'tambahan',
            'r'
        ));
    }
    public function uploadBukti(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($request->user()->hasrole($bank)) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Upload File Bukti Kegiatan Seksi Bank';
            $role = $bank;
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Upload File Bukti Kegiatan Bagian Umum';
            $role = $umum;
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload File Bukti Kegiatan Seksi MSKI';
            $role = $mski;
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Upload File Bukti Kegiatan Seksi Pencairan Dana';
            $role = $dana;
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload File Bukti Kegiatan Seksi Vera';
            $role = $vera;
        }

        return view('bukti.upload', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
        ));

    }

    public function storeBukti(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($request->user()->hasrole($bank)) { 
            $table = SeksiBank::find($id);
            $role = SeksiBankUpload::find($id);
            $tambahan = new SeksiBankTambahan();
            $nama = $bank;
        }
        else if ($request->user()->hasrole($umum)) {
            $table = BagianUmum::find($id);
            $role = BagianUmumUpload::find($id);
            $tambahan = new BagianUmumTambahan();
            $nama = $umum;
        } 
        else if ($request->user()->hasrole($mski)) {
            $table = SeksiMski::find($id);
            $role = SeksiMskiUpload::find($id);
            $tambahan = new SeksiMskiTambahan();
            $nama = $mski;
        }
        else if ($request->user()->hasrole($dana)) {
            $table = SeksiPencairanDana::find($id);
            $role = SeksiPencairanDanaUpload::find($id);
            $tambahan = new SeksiPencairanDanaTambahan();
            $nama = $dana;
        }
        else if ($request->user()->hasrole($vera)) {
            $table = SeksiVera::find($id);
            $role = SeksiVeraUpload::find($id);
            $tambahan = new SeksiVeraTambahan();
            $nama = $vera; 
        }
        $this->storeData($request, $role, $tambahan, $table,$nama,$id);
        return redirect('/table-kegiatan')->with('success', 'Bukti berhasil diupload!');
    }

    public function storeData($request, $role, $tambahan, $table,$nama,$id){

        $tanggal_realisasi = $request->input('tanggal');

        $format = "d/m/Y";
        $carbonDate = Carbon::createFromFormat($format, $tanggal_realisasi);
        $tanggal_realisasi = $carbonDate->toDateString();

        $absensi = $request->hasFile('absensi') ? $request->file('absensi')->get() : null;
        $Tabsensi = $request->hasFile('absensi') ? $request->file('absensi')->getClientMimeType() : null;
        $Nabsensi = $request->hasFile('absensi') ? $request->file('absensi')->getClientOriginalName() : null;

        $foto = $request->hasFile('foto') ? $request->file('foto')->get() : null;
        $Tfoto = $request->hasFile('foto') ? $request->file('foto')->getClientMimeType() : null;
        $Nfoto = $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : null;

        $notulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->get() : null;
        $Tnotulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->getClientMimeType() : null;
        $Nnotulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->getClientOriginalName() : null;
        
        $role->absensi= $absensi;
        $role->type_absensi = $Tabsensi;
        $role->filename_absensi = $Nabsensi;

        $role->foto= $foto;
        $role->type_foto = $Tfoto;
        $role->filename_foto = $Nfoto;

        $role->notulensi= $notulensi;
        $role->type_notulensi = $Tnotulensi;
        $role->filename_notulensi = $Nnotulensi;

        $role->save();

        if ($request->hasFile('tambahan')) {
            foreach ($request->file('tambahan') as $item) {
                $filename = $item->getClientOriginalName();
                $filetype = $item->getClientMimeType();
                
                $tambahan = new $tambahan;
                $tambahan->{"id_{$nama}"}= $id;
                $tambahan->tambahan = $item->get();
                $tambahan->filename_tambahan = $filename;
                $tambahan->type_tambahan = $filetype;
                $tambahan->save(); 
            }   
        }

        $table->SB = 'Sudah';
        $table->realisasi_pelaksanaan = $tanggal_realisasi;
        $table->save();
    }

    public function editBukti(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Bukti Seksi Bank';
            $table_category = 'Edit File Bukti Seksi Bank';
            $role = $bank;
            $table = SeksiBank::find($id);
            $data = SeksiBankUpload::find($id);
            $tambahan = SeksiBankTambahan::where($idbank,$id)->get();
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bukti Bagian Umum';
            $table_category = 'Edit File Bukti Bagian Umum';
            $role = $umum;
            $table = BagianUmum::find($id);
            $data = BagianUmumUpload::find($id);
            $tambahan = BagianUmumTambahan::where($idumum,$id)->get();
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Bukti Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit File Bukti Seksi MSKI';
            $role = $mski;
            $table = SeksiMski::find($id);
            $data = SeksiMskiUpload::find($id);
            $tambahan = SeksiMskiTambahan::where($idmski,$id)->get();
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Bukti Seksi Pencairan Dana';
            $table_category = 'Edit File Bukti Seksi Pencairan Dana';
            $role = $dana;
            $table = SeksiPencairanDana::find($id);
            $data = SeksiPencairanDanaUpload::find($id);
            $tambahan = SeksiPencairanDanaTambahan::where($iddana,$id)->get();
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Bukti Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit File Bukti Seksi Vera';
            $role = $vera;
            $table = SeksiVera::find($id);
            $data = SeksiVeraUpload::find($id);
            $tambahan = SeksiVeraTambahan::where($idvera,$id)->get();
        }

        $r = "user";
        
        return view('bukti.edit', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'tambahan',
            'table',
            'r'
        ));

    }

    public function updateBukti(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";
        
        if ($request->user()->hasrole($bank)) { 
            $table = SeksiBank::find($id);
            $role = SeksiBankUpload::find($id);
            $tambahan = new SeksiBankTambahan();
            $dataTambahan = SeksiBankTambahan::where($idbank,$id);
            $nama = $bank;
        
        }
        else if ($request->user()->hasrole($umum)) {
            $table = BagianUmum::find($id);
            $role = BagianUmumUpload::find($id);
            $tambahan = new BagianUmumTambahan();
            $dataTambahan = BagianUmumTambahan::where($idumum,$id);
            $nama = $umum;

        } 
        else if ($request->user()->hasrole($mski)) {
            $table = SeksiMski::find($id);
            $role = SeksiMskiUpload::find($id);
            $tambahan = new SeksiMskiTambahan();
            $dataTambahan = SeksiMskiTambahan::where($idmski,$id);
            $nama = $mski;
     
        }
        else if ($request->user()->hasrole($dana)) {
            $table = SeksiPencairanDana::find($id);
            $role = SeksiPencairanDanaUpload::find($id);
            $tambahan = new SeksiPencairanDanaTambahan();
            $dataTambahan = SeksiPencairanDanaTambahan::where($iddana,$id);
            $nama = $dana;
            
        }
        else if ($request->user()->hasrole($vera)) {
            $table = SeksiVera::find($id);
            $role = SeksiVeraUpload::find($id);
            $tambahan = new SeksiVeraTambahan();
            $dataTambahan = SeksiVeraTambahan::where($idvera,$id);
            $nama = $vera;
            
        }
        $this->dataBuktiUpdate($request, $role, $tambahan, $table,$nama,$id,$dataTambahan);
        return redirect('/table-kegiatan')->with('success', 'Bukti berhasil diupdate!');
    }

    public function dataBuktiUpdate($request, $role, $tambahan, $table,$nama,$id,$dataTambahan)
    {
        $tanggal_realisasi = $request->input('tanggal');

        $format = "d/m/Y";
        $carbonDate = Carbon::createFromFormat($format, $tanggal_realisasi);
        $tanggal_realisasi = $carbonDate->toDateString();

        $table->realisasi_pelaksanaan=$tanggal_realisasi;
        $table->save();

        $absensi = $request->hasFile('absensi') ? $request->file('absensi')->get() : $role->absensi;
        $Tabsensi = $request->hasFile('absensi') ? $request->file('absensi')->getClientMimeType() : $role->type_absensi;
        $Nabsensi = $request->hasFile('absensi') ? $request->file('absensi')->getClientOriginalName() : $role->filename_absensi;

        $foto = $request->hasFile('foto') ? $request->file('foto')->get() : $role->foto;
        $Tfoto = $request->hasFile('foto') ? $request->file('foto')->getClientMimeType() : $role->type_foto;
        $Nfoto = $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : $role->filename_foto;

        $notulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->get() : $role->notulensi;
        $Tnotulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->getClientMimeType() : $role->type_notulensi;
        $Nnotulensi = $request->hasFile('notulensi') ? $request->file('notulensi')->getClientOriginalName() :$role->filename_notulensi;
        
        $role->absensi= $absensi;
        $role->type_absensi = $Tabsensi;
        $role->filename_absensi = $Nabsensi;

        $role->foto= $foto;
        $role->type_foto = $Tfoto;
        $role->filename_foto = $Nfoto;

        $role->notulensi= $notulensi;
        $role->type_notulensi = $Tnotulensi;
        $role->filename_notulensi = $Nnotulensi;

        $role->save();

        if ($request->hasFile('tambahan')) {
            $dataTambahan->delete();
            foreach ($request->file('tambahan') as $item) {
                $filename = $item->getClientOriginalName();
                $filetype = $item->getClientMimeType();
                
                $tambahan = new $tambahan;
                $tambahan->{"id_{$nama}"}= $id;
                $tambahan->tambahan = $item->get();
                $tambahan->filename_tambahan = $filename;
                $tambahan->type_tambahan = $filetype;
                $tambahan->save(); 
            }   
        }

    }
   //CRUD Tabel Kegiatan
    public function index(Request $request)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        if ($request->user()->hasrole($bank)) {
            $table_name = 'Seksi Bank';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Bank';
            $table_data = SeksiBank::get();
            $upload = SeksiBankUpload::get();
            $f_key = 'id_seksi_bank';
            $table = $bank;            
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bagian Umum';
            $table_category = 'Tabel Monitoring Kegiatan Bagian Umum';
            $table_data = BagianUmum::get();
            $upload = BagianUmumUpload::get();
            $f_key = 'id_bagian_umum';
            $table = $umum;
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Tabel Monitoring Kegiatan Seksi MSKI';
            $table_data = SeksiMski::get();
            $upload = SeksiMskiUpload::get();
            $f_key = 'id_seksi_mski';
            $table = $mski;
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Seksi Pencairan Dana';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Pencairan Dana';
            $table_data = SeksiPencairanDana::get();
            $upload = SeksiPencairanDanaUpload::get();
            $f_key = 'id_seksi_pencairan_dana';
            $table = $dana;
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Seksi Verifikasi dan Akuntansi';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Vera';
            $table_data = SeksiVera::get();
            $upload = SeksiVera::get();
            $f_key = 'id_seksi_vera';
            $table = $vera;
        }

        return view('table.index', compact(
            'table_name', 
            'table_category', 
            'table_data', 
            'upload', 
            'table',
            'f_key'
        ));
        
    }

    public function add(Request $request)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($request->user()->hasrole($bank)) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Upload File Bukti Kegiatan Seksi Bank';
            $seksi = 'Seksi Bank';
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Upload File Bukti Kegiatan Bagian Umum';
            $seksi = 'Bagian Umum';
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload File Bukti Kegiatan Seksi MSKI';
            $seksi = 'Seksi MSKI';
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Upload File Bukti Kegiatan Seksi Pencairan Dana';
            $seksi = 'Seksi Pencairan Dana';
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload File Bukti Kegiatan Seksi Vera';
            $seksi = 'Seksi Vera';
        }
        $role = 'user';
        $referensi_kegiatan = ReferensiKegiatan::get();
        $referensi_pegawai = User::bySeksi($seksi)->get();

        return view('table.add', compact(
            'table_name', 
            'table_category', 
            'role',
            'referensi_kegiatan',
            'referensi_pegawai'
        ));
        
    }

    public function storeTabel(Request $request)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $SB = "Belum";

        $kegiatan =  ($request->input('kegiatan') == 'lainnya') ? $request->input('kegiatan_lainnya') : $request->input('kegiatan');
        $namakegiatan = $request->input('nama_kegiatan');
        $tanggal = $request->input('tanggal');
        $pukul = $request->input('pukul');
        $tempat = $request->input('tempat');
        $pic = ($request->input('pic') == 'lainnya') ? $request->input('pic_lainnya') : $request->input('pic');

        if ($request->user()->hasrole($bank)) {
            $input = new SeksiBank();
            $penyelenggara = 'Seksi Bank';            
        }
        else if ($request->user()->hasrole($umum)) {
            $input = new BagianUmum(); 
            $penyelenggara = 'Bagian Umum';
        } 
        else if ($request->user()->hasrole($mski)) {
            $input = new SeksiMski(); 
            $penyelenggara = 'Seksi MSKI';
        }
        else if ($request->user()->hasrole($dana)) {
            $input = new SeksiPencairanDana(); 
            $penyelenggara = 'Seksi Pencairan Dana';
        }
        else if ($request->user()->hasrole($vera)) {
            $input = new SeksiVera();
            $penyelenggara = 'Seksi Vera';
        }

        $format = "d/m/Y";
        $carbonDate = Carbon::createFromFormat($format, $tanggal);
        $tanggal = $carbonDate->toDateString();

        $input->kegiatan = $kegiatan;
        $input->nama_kegiatan = $namakegiatan;
        $input->tgl_pelaksanaan = $tanggal;
        $input->pukul = $pukul;
        $input->tempat = $tempat;
        $input->pic = $pic;
        $input->SB = $SB;
        $input->penyelenggara =  $penyelenggara;
        $input->save();       
        return redirect('/table-kegiatan')->with('success', 'Data Tabel berhasil ditambahkan!');
    }

    
    public function edit(Request $request,$id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($request->user()->hasrole($bank)) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Edit File Bukti Kegiatan Seksi Bank';
            $role = SeksiBank::find($id);
            $seksi = 'Seksi Bank';
        }
        else if ($request->user()->hasrole($umum)) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Edit File Bukti Kegiatan Bagian Umum';
            $role = BagianUmum::find($id);
            $seksi = 'Bagian Umum';
        } 
        else if ($request->user()->hasrole($mski)) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit File Bukti Kegiatan Seksi MSKI';
            $role = SeksiMski::find($id);
            $seksi = 'Seksi MSKI';
        }
        else if ($request->user()->hasrole($dana)) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Edit File Bukti Kegiatan Seksi Pencairan Dana';
            $role = SeksiPencairanDana::find($id);
            $seksi = 'Seksi Pencairan Dana';
        }
        else if ($request->user()->hasrole($vera)) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit File Bukti Kegiatan Seksi Vera';
            $role = SeksiVera::find($id);
            $seksi = 'Seksi Vera';
        }

        $referensi_kegiatan = ReferensiKegiatan::get();
        $referensi_pegawai = User::bySeksi($seksi)->get();
        
        $r = 'user';

        return view('table.edit', compact(
            'table_name', 
            'table_category', 
            'role',
            'referensi_kegiatan',
            'referensi_pegawai',
            'id',
            'r'
        ));
    }

    
    public function update(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $kegiatan =  ($request->input('kegiatan') == 'lainnya') ? $request->input('kegiatan_lainnya') : $request->input('kegiatan');
        $namakegiatan = $request->input('nama_kegiatan');
        $tanggal = $request->input('tanggal');
        $pukul = $request->input('pukul');
        $tempat = $request->input('tempat');
        $pic = ($request->input('pic') == 'lainnya') ? $request->input('pic_lainnya') : $request->input('pic');

        if ($request->user()->hasrole($bank)) {
            $input = SeksiBank::find($id);
            
        }
        else if ($request->user()->hasrole($umum)) {
            $input = BagianUmum::find($id);
            
        } 
        else if ($request->user()->hasrole($mski)) {
            $input = SeksiMski::find($id);
        }
        else if ($request->user()->hasrole($dana)) {
            $input = SeksiPencairanDana::find($id);
        }
        else if ($request->user()->hasrole($vera)) {
            $input = SeksiVera::find($id);
        }

        if($kegiatan != null){
            $input->kegiatan = $kegiatan;
        }
        if($pic != null){
            $input->pic = $pic;
        }

        $format = "d/m/Y";
        $carbonDate = Carbon::createFromFormat($format, $tanggal);
        $tanggal = $carbonDate->toDateString();
       
        $input->nama_kegiatan = $namakegiatan;
        $input->tgl_pelaksanaan = $tanggal;
        $input->pukul = $pukul;
        $input->tempat = $tempat;
        $input->save();  

        return redirect('/table-kegiatan')->with('success', 'Data Tabel berhasil diupdate!');
        
    }

   
    public function destroy(Request $request, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        $f_umum = "id_bagian_umum";
        $f_bank = "id_seksi_bank";
        $f_mski = "id_seksi_mski";
        $f_dana = "id_seksi_pencairan_dana";
        $f_vera = "id_seksi_vera";
        
        if ($request->user()->hasrole($bank)) {
            SeksiBankTambahan::where($f_bank,$id)->delete();
            SeksiBankUpload::where($f_bank,$id)->delete();
            SeksiBank::find($id)->delete();
        }
        else if ($request->user()->hasrole($umum)) {
            BagianUmumTambahan::where($f_umum,$id)->delete();
            BagianUmumUpload::where($f_umum,$id)->delete();
            BagianUmum::find($id)->delete();
        } 
        else if ($request->user()->hasrole($mski)) {
            SeksiMskiTambahan::where($f_mski,$id)->delete();
            SeksiMskiUpload::where($f_mski,$id)->delete();
            SeksiMski::find($id)->delete();
       
        }
        else if ($request->user()->hasrole($dana)) {
            SeksiPencairanDanaTambahan::where($f_dana,$id)->delete();
            SeksiPencairanDanaUpload::where($f_dana,$id)->delete();
            SeksiPencairanDana::find($id)->delete();
         
        }
        else if ($request->user()->hasrole($vera)) {
            SeksiVeraTambahan::where($f_vera,$id)->delete();
            SeksiVeraUpload::where($f_vera,$id)->delete();
            SeksiVera::find($id)->delete();
        
        }

        return redirect('/table-kegiatan')->with('success', 'Data berhasil dihapus.');
    }

}
