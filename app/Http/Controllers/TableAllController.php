<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReferensiKegiatan,App\Models\ReferensiPegawai;
use App\Models\BagianUmum;
use App\Models\BagianUmumUpload;
use App\Models\BagianUmumTambahan;
use App\Models\SeksiBank, App\Models\SeksiBankUpload, App\Models\SeksiBankTambahan;
use App\Models\SeksiMski, App\Models\SeksiMskiUpload, App\Models\SeksiMskiTambahan;
use App\Models\SeksiPencairanDana, App\Models\SeksiPencairanDanaUpload, App\Models\SeksiPencairanDanaTambahan;
use App\Models\SeksiVera, App\Models\SeksiVeraUpload, App\Models\SeksiVeraTambahan;

class TableAllController extends Controller
{
    //undangan
    public function indexUndangan(request $request,$table, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        $Rumum = "bagian_umum";
        $Rbank = "seksi_bank";
        $Rmski = "seksi_mski";
        $Rdana = "seksi_pencairan_dana";
        $Rvera = "seksi_vera";

        if ($table == $bank) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'File Undangan Seksi Bank';
            $data = SeksiBankUpload::find($id);
            $table = $bank;
            $role = $Rbank;
        }
        else if ($table == $umum) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'File Undangan Bagian Umum';
            $data = BagianUmumUpload::find($id);
            $table = $umum;
            $role = $Rumum;
        } 
        else if ($table == $mski) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'File Undangan Seksi MSKI';
            $data = SeksiMskiUpload::find($id);
            $table = $mski;
            $role = $Rmski;
        }
        else if ($table == $dana) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'File Undangan Seksi Pencairan Dana';
            $data = SeksiPencairanDanaUpload::find($id);
            $table = $dana;
            $role = $Rdana;
        }
        else if ($table == $vera) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'File Undangan Seksi Vera';
            $data = SeksiVera::find($id);
            $table = $vera;
            $role = $Rvera;
        }

        $r = "all";

        return view('undangan.index', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'table',
            'r'
        ));

    }

    public function uploadUndangan(request $request,$table,$id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";
 
        if ($table == $bank) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'Upload Undangan Seksi Bank';
            $table = $bank;
        }
        else if ($table == $umum) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'Upload Undangan Bagian Umum';
            $table = $umum;
        } 
        else if ($table == $mski) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload Undangan Seksi MSKI';
            $table = $mski;
        }
        else if ($table == $dana) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'Upload Undangan Seksi Pencairan Dana';
            $table = $dana;
        }
        else if ($table == $vera) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload Undangan Seksi Vera';
            $table = $vera;
        }

        $role = 'all';

        return view('undangan.upload', compact(
            'table_name', 
            'table_category', 
            'role',
            'id',
            'table'
        ));
        
    }

    public function storeUndangan(Request $request,$table, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";
        
        if ($table == "bank") {
            $role = new SeksiBankUpload();
            $nama = $bank;
            $view = '/table-kegiatan-all/bank';
        }
        else if ($table == "umum") {
            $role = new BagianUmumUpload();
            $nama = $umum;
            $view = '/table-kegiatan-all/umum';
        } 
        else if ($table == "mski") {
            $role = new SeksiMskiUpload();
            $nama = $mski;
            $view = '/table-kegiatan-all/mski';
        }
        else if ($table == "dana") {
            $role = new SeksiPencairanDanaUpload();
            $nama = $dana;
            $view = '/table-kegiatan-all/dana';
        }
        else if ($table == "vera") {
            $role = new SeksiVeraUpload();
            $nama = $vera;
            $view = '/table-kegiatan-all/vera';
        }
        $this->dataUndangan($request, $role, $id,$nama);
        return redirect($view)->with('success', 'Undangan berhasil diupload!');
        
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

    public function editUndangan(request $request,$table,$id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        if ($table == $bank) {
            $table_name = 'Undangan Seksi Bank';
            $table_category = 'Edit Undangan Seksi Bank';
            $data = SeksiBankUpload::find($id);
            $table = $bank;
        }
        else if ($table == $umum) {
            $table_name = 'Undangan Bagian Umum';
            $table_category = 'Edit Undangan Bagian Umum';
            $data = BagianUmumUpload::find($id);
            $table = $umum;
        } 
        else if ($table == $mski) {
            $table_name = 'Undangan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit Undangan Seksi MSKI';
            $data = SeksiMskiUpload::find($id);
            $table = $mski;
        }
        else if ($table == $dana) {
            $table_name = 'Undangan Seksi Pencairan Dana';
            $table_category = 'Edit Undangan Seksi Pencairan Dana';
            $data = SeksiPencairanDanaUpload::find($id);
            $table = $dana;
        }
        else if ($table == $vera) {
            $table_name = 'Undangan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit Undangan Seksi Vera';
            $data = SeksiveraUpload::find($id);
            $table = $vera;
        }
        $role = "all";

        return view('undangan.edit', compact(
            'table_name', 
            'table_category', 
            'role',
            'id',
            'data',
            'table'
        ));
        
    }

    public function updateUndangan(Request $request,$table, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        if ($table == $bank) {
            $role = SeksiBankUpload::find($id);
            $view = '/table-kegiatan-all/bank';
        }
        else if ($table == $umum) {
            $role = BagianUmumUpload::find($id); 
            $view = '/table-kegiatan-all/umum';
        } 
        else if ($table == $mski) {
            $role = SeksiMskiUpload::find($id);
            $view = '/table-kegiatan-all/mski';
        }
        else if ($table == $dana) {
            $role = SeksiPencairanDanaUpload::find($id); 
            $view = '/table-kegiatan-all/dana';
        }
        else if ($table == $vera) {
            $role = SeksiVeraUpload::find($id);
            $view = '/table-kegiatan-all/vera';
        }
        $this->dataUndanganUpdate($request, $role, $id);
        return redirect($view)->with('success', 'Undangan berhasil diupdate!');
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

    //Bukti
    public function indexBukti($table, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $Rumum = "umum";
        $Rbank = "bank";
        $Rmski = "mski";
        $Rdana = "dana";
        $Rvera = "vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";

        $r = 'all';

        if ($table == $Rbank) {
            $table_name = 'Bukti Seksi Bank';
            $table_category = 'File Bukti Seksi Bank';
            $role = $bank;
            $data = SeksiBankUpload::find($id);
            $tambahan = SeksiBankTambahan::where($idbank,$id)->get();
        }
        else if ($table == $Rumum) {
            $table_name = 'Bukti Bagian Umum';
            $table_category = 'File Bukti Bagian Umum';
            $role = $umum;
            $data = BagianUmumUpload::find($id);
            $tambahan = BagianUmumTambahan::where($idumum,$id)->get();
        } 
        else if ($table == $Rmski) {
            $table_name = 'Bukti Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'File Bukti Seksi MSKI';
            $role = $mski;
            $data = SeksiMskiUpload::find($id);
            $tambahan = SeksiMskiTambahan::where($idmski,$id)->get();
        }
        else if ($table == $Rdana) {
            $table_name = 'Bukti Seksi Pencairan Dana';
            $table_category = 'File Bukti Seksi Pencairan Dana';
            $role = $dana;
            $data = SeksiPencairanDanaUpload::find($id);
            $tambahan = SeksiPencairanDanaTambahan::where($iddana,$id)->get();
        }
        else if ($table == $Rvera) {
            $table_name = 'Bukti Seksi Verifikasi dan Akuntansi';
            $table_category = 'File Bukti Seksi Vera';
            $role = $vera;
            $data = SeksiVeraUpload::find($id);
            $tambahan = SeksiVeraTambahan::where($idvera,$id)->get();
        }
        
        return view('bukti.index', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'tambahan',
            'r',
            'table'
        ));
    }
    public function uploadBukti($table, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "pencairan_dana";
        $vera = "vera";
        
        if ($table == $bank) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Upload File Bukti Kegiatan Seksi Bank';
            $table = $bank;
        }
        else if ($table == $umum) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Upload File Bukti Kegiatan Bagian Umum';
            $table = $umum;
        } 
        else if ($table == $mski) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload File Bukti Kegiatan Seksi MSKI';
            $table = $mski;
        }
        else if ($table == $dana) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Upload File Bukti Kegiatan Seksi Pencairan Dana';
            $table = $dana;
        }
        else if ($table == $vera) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload File Bukti Kegiatan Seksi Vera';
            $table = $vera;
        }

        $role = 'all';

        return view('bukti.upload', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'table'
        ));

    }

    public function storeBukti(Request $request, $table, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $Rumum = "umum";
        $Rbank = "bank";
        $Rmski = "mski";
        $Rdana = "dana";
        $Rvera = "vera";
      
        if ($table == $Rbank) { 
            $table = SeksiBank::find($id);
            $role = SeksiBankUpload::find($id);
            $tambahan = new SeksiBankTambahan();
            $nama = $bank;
            $view = 'table-kegiatan-all/bank';
        }
        else if ($table == $Rumum) {
            $table = BagianUmum::find($id);
            $role = BagianUmumUpload::find($id);
            $tambahan = new BagianUmumTambahan();
            $nama = $umum;
            $view = 'table-kegiatan-all/umum';
        } 
        else if ($table == $Rmski) {
            $table = SeksiMski::find($id);
            $role = SeksiMskiUpload::find($id);
            $tambahan = new SeksiMskiTambahan();
            $nama = $mski;
            $view = 'table-kegiatan-all/mski';
        }
        else if ($table == $Rdana) {
            $table = SeksiPencairanDana::find($id);
            $role = SeksiPencairanDanaUpload::find($id);
            $tambahan = new SeksiPencairanDanaTambahan();
            $nama = $dana;
            $view = 'table-kegiatan-all/dana';
        }
        else if ($table == $Rvera) {
            $table = SeksiVera::find($id);
            $role = SeksiVeraUpload::find($id);
            $tambahan = new SeksiVeraTambahan();
            $nama = $vera; 
            $view = 'table-kegiatan-all/vera';
        }

        $this->storeData($request, $role, $tambahan, $table,$nama,$id);
        return redirect($view)->with('success', 'Bukti berhasil diupload!');
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

    public function editBukti($table, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $Rumum = "umum";
        $Rbank = "bank";
        $Rmski = "mski";
        $Rdana = "dana";
        $Rvera = "vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";

        $r = 'all';

        if ($table == $Rbank) {
            $table_name = 'Bukti Seksi Bank';
            $table_category = 'Edit File Bukti Seksi Bank';
            $role = $bank;
            $table = SeksiBank::find($id);
            $data = SeksiBankUpload::find($id);
            $tambahan = SeksiBankTambahan::where($idbank,$id)->get();
            $route = $Rbank;
        }
        else if ($table == $Rumum) {
            $table_name = 'Bukti Bagian Umum';
            $table_category = 'Edit File Bukti Bagian Umum';
            $role = $umum;
            $table = BagianUmum::find($id);
            $data = BagianUmumUpload::find($id);
            $tambahan = BagianUmumTambahan::where($idumum,$id)->get();
            $route = $Rumum;
        } 
        else if ($table == $Rmski) {
            $table_name = 'Bukti Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit File Bukti Seksi MSKI';
            $role = $mski;
            $table = SeksiMski::find($id);
            $data = SeksiMskiUpload::find($id);
            $tambahan = SeksiMskiTambahan::where($idmski,$id)->get();
            $route = $Rmski;
        }
        else if ($table == $Rdana) {
            $table_name = 'Bukti Seksi Pencairan Dana';
            $table_category = 'Edit File Bukti Seksi Pencairan Dana';
            $role = $dana;
            $table = SeksiPencairanDana::find($id);
            $data = SeksiPencairanDanaUpload::find($id);
            $tambahan = SeksiPencairanDanaTambahan::where($iddana,$id)->get();
            $route = $Rdana;
        }
        else if ($table == $Rvera) {
            $table_name = 'Bukti Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit File Bukti Seksi Vera';
            $role = $vera;
            $table = SeksiVera::find($id);
            $data = SeksiVeraUpload::find($id);
            $tambahan = SeksiVeraTambahan::where($idvera,$id)->get();
            $route = $Rvera;
        }

        return view('bukti.edit', compact(
            'table_name', 
            'table_category', 
            'id',
            'role',
            'data',
            'tambahan',
            'table',
            'r',
            'route'
        ));

    }

    public function updateBukti(Request $request,$table, $id)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        $Rumum = "umum";
        $Rbank = "bank";
        $Rmski = "mski";
        $Rdana = "dana";
        $Rvera = "vera";

        $idumum = "id_bagian_umum";
        $idbank = "id_seksi_bank";
        $idmski = "id_seksi_mski";
        $iddana = "id_seksi_pencairan_dana";
        $idvera = "id_seksi_vera";
        
        if ($table == $Rbank) { 
            $table = SeksiBank::find($id);
            $role = SeksiBankUpload::find($id);
            $tambahan = new SeksiBankTambahan();
            $dataTambahan = SeksiBankTambahan::where($idbank,$id);
            $nama = $bank;
            $view = 'table-kegiatan-all/bank';
        }
        else if ($table == $Rumum) {
            $table = BagianUmum::find($id);
            $role = BagianUmumUpload::find($id);
            $tambahan = new BagianUmumTambahan();
            $dataTambahan = BagianUmumTambahan::where($idumum,$id);
            $nama = $umum;
            $view = 'table-kegiatan-all/umum';
        } 
        else if ($table == $Rmski) {
            $table = SeksiMski::find($id);
            $role = SeksiMskiUpload::find($id);
            $tambahan = new SeksiMskiTambahan();
            $dataTambahan = SeksiMskiTambahan::where($idmski,$id);
            $nama = $mski;
            $view = 'table-kegiatan-all/mski';
        }
        else if ($table == $Rdana) {
            $table = SeksiPencairanDana::find($id);
            $role = SeksiPencairanDanaUpload::find($id);
            $tambahan = new SeksiPencairanDanaTambahan();
            $dataTambahan = SeksiPencairanDanaTambahan::where($iddana,$id);
            $nama = $vera;
            $view = 'table-kegiatan-all/dana';
        }
        else if ($table == $Rvera) {
            $table = SeksiVera::find($id);
            $role = SeksiVeraUpload::find($id);
            $tambahan = new SeksiVeraTambahan();
            $dataTambahan = SeksiVeraTambahan::where($idvera,$id);
            $view = 'table-kegiatan-all/vera';
        }

        $this->dataBuktiUpdate($request, $role, $tambahan, $table,$nama,$id,$dataTambahan);
        return redirect($view)->with('success', 'Bukti berhasil diupdate!');
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

    //CRUD Table
    
    public function index($table)
    {
        $umum = "bagian_umum";
        $bank = "seksi_bank";
        $mski = "seksi_mski";
        $dana = "seksi_pencairan_dana";
        $vera = "seksi_vera";

        if ($table == "umum"){
            $table_name = 'Bagian Umum';
            $table_category = 'Tabel Monitoring Kegiatan Bagian Bank';
            $table_data = BagianUmum::get();
            $upload = BagianUmumUpload::get();
            $f_key = 'id_bagian_umum';
            $view = "table-all.umum";
            $table = $umum;
        }
        else if($table == "bank"){
            $table_name = 'Seksi Bank';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Bank';
            $table_data = SeksiBank::get();
            $upload = SeksiBankUpload::get();
            $f_key = 'id_seksi_bank';
            $view = "table-all.bank";
            $table = $bank;
        }
        else if ($table == "mski") {
            $table_name = 'Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Tabel Monitoring Kegiatan Seksi MSKI';
            $table_data = SeksiMski::get();
            $view = "table-all.mski";
            $upload = SeksiMskiUpload::get();
            $f_key = 'id_seksi_MSKI';
            $table = $mski;
        }
        else if ($table == "dana") {
            $table_name = 'Seksi Pencairan Dana';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Pencairan Dana';
            $table_data = SeksiPencairanDana::get();
            $view = "table-all.dana";
            $upload = SeksiPencairanDanaUpload::get();
            $f_key = 'id_seksi_pencairan_dana';
            $table = $dana;
            
        }
        else if ($table == "vera") {
            $table_name = 'Seksi Verifikasi dan Akuntansi';
            $table_category = 'Tabel Monitoring Kegiatan Seksi Vera';
            $table_data = SeksiVera::get();
            $view = "table-all.vera";
            $upload = SeksiVera::get();
            $f_key = 'id_seksi_vera';
            $table = $vera;
        }

        return view($view, compact(
            'table_name', 
            'table_category', 
            'table_data', 
            'upload', 
            'table',
            'f_key'
        ));
    }
   
    public function add($table)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";
        
        if ($table == $bank) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Upload File Bukti Kegiatan Seksi Bank';
            $seksi = 'Seksi Bank';
        }
        else if ($table == $umum) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Upload File Bukti Kegiatan Bagian Umum';
            $seksi = 'Bagian Umum';
        } 
        else if ($table == $mski) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Upload File Bukti Kegiatan Seksi MSKI';
            $seksi = 'Seksi MSKI';
        }
        else if ($table == $dana) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Upload File Bukti Kegiatan Seksi Pencairan Dana';
            $seksi = 'Seksi Pencairan Dana';
        }
        else if ($table == $vera) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Upload File Bukti Kegiatan Seksi Vera';
            $seksi = 'Seksi Vera';
        }
        $referensi_kegiatan = ReferensiKegiatan::get();
        $referensi_pegawai = User::bySeksi($seksi)->get();

        $role = 'all';

        return view('table.add', compact(
            'table_name', 
            'table_category', 
            'referensi_kegiatan',
            'referensi_pegawai',
            'table',
            'role'
        ));
        
    }

    public function storeTabel(Request $request, $table)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        $SB = "Belum";

        $kegiatan =  ($request->input('kegiatan') == 'lainnya') ? $request->input('kegiatan_lainnya') : $request->input('kegiatan');
        $namakegiatan = $request->input('nama_kegiatan');
        $tanggal = $request->input('tanggal');
        $pukul = $request->input('pukul');
        $tempat = $request->input('tempat');
        $pic = ($request->input('pic') == 'lainnya') ? $request->input('pic_lainnya') : $request->input('pic');

        if ($table == $bank) {
            $input = new SeksiBank();
            $penyelenggara = 'Seksi Bank';            
        }
        else if ($table == $umum) {
            $input = new BagianUmum(); 
            $penyelenggara = 'Bagian Umum';
        } 
        else if ($table == $mski) {
            $input = new SeksiMski();
            $penyelenggara = 'Seksi MSKI'; 
        }
        else if ($table == $dana) {
            $input = new SeksiPencairanDana(); 
            $penyelenggara = 'Seksi Pencairan Dana';
        }
        else if ($table == $vera) {
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
        $input->penyelenggara = $penyelenggara;
        $input->save();       
        return redirect('/table-kegiatan-all/'.$table)->with('success', 'Data Tabel berhasil ditambahkan!');
    }

    
    public function edit($table ,$id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";
        
        if ($table == $bank) {
            $table_name = 'Bukti Kegiatan Seksi Bank';
            $table_category = 'Edit File Bukti Kegiatan Seksi Bank';
            $role = SeksiBank::find($id);
            $seksi = 'Seksi Bank';
        }
        else if ($table == $umum) {
            $table_name = 'Bukti Kegiatan Bagian Umum';
            $table_category = 'Edit File Bukti Kegiatan Bagian Umum';
            $role = BagianUmum::find($id);
            $seksi = 'Bagian Umum';
        } 
        else if ($table == $mski) {
            $table_name = 'Bukti Kegiatan Seksi Manajemen Satker dan Kepatuhan Internal';
            $table_category = 'Edit File Bukti Kegiatan Seksi MSKI';
            $role = SeksiMski::find($id);
            $seksi = 'Seksi MSKI';
        }
        else if ($table == $dana) {
            $table_name = 'Bukti Kegiatan Seksi Pencairan Dana';
            $table_category = 'Edit File Bukti Kegiatan Seksi Pencairan Dana';
            $role = SeksiPencairanDana::find($id);
            $seksi = 'Seksi Pencairan Dana';
        }
        else if ($table == $vera) {
            $table_name = 'Bukti Kegiatan Seksi Verifikasi dan Akuntansi';
            $table_category = 'Edit File Bukti Kegiatan Seksi Vera';
            $role = SeksiVera::find($id);
            $seksi = 'Seksi Vera';
        }

        $referensi_kegiatan = ReferensiKegiatan::get();
        $referensi_pegawai = User::bySeksi($seksi)->get();
        $r = 'all';

        return view('table.edit', compact(
            'table_name', 
            'table_category', 
            'role',
            'referensi_kegiatan',
            'referensi_pegawai',
            'id',
            'r',
            'table'
        ));
    }

    
    public function update(Request $request,$table, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";

        $kegiatan =  ($request->input('kegiatan') == 'lainnya') ? $request->input('kegiatan_lainnya') : $request->input('kegiatan');
        $namakegiatan = $request->input('nama_kegiatan');
        $tanggal = $request->input('tanggal');
        $pukul = $request->input('pukul');
        $tempat = $request->input('tempat');
        $pic = ($request->input('pic') == 'lainnya') ? $request->input('pic_lainnya') : $request->input('pic');

        if ($table == $bank) {
            $input = SeksiBank::find($id);
            
        }
        else if ($table == $umum) {
            $input = BagianUmum::find($id);
            
        } 
        else if ($table == $mski) {
            $input = SeksiMski::find($id);
        }
        else if ($table == $dana) {
            $input = SeksiPencairanDana::find($id);
        }
        else if ($table == $vera) {
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

        return redirect('table-kegiatan-all/'.$table)->with('success', 'Data Tabel berhasil diupdate!');
    }

   
    public function destroy(Request $request,$table, $id)
    {
        $umum = "umum";
        $bank = "bank";
        $mski = "mski";
        $dana = "dana";
        $vera = "vera";
        
        $f_umum = "id_bagian_umum";
        $f_bank = "id_seksi_bank";
        $f_mski = "id_seksi_mski";
        $f_dana = "id_seksi_pencairan_dana";
        $f_vera = "id_seksi_vera";
        
        if ($table == $bank) {
            SeksiBankTambahan::where($f_bank,$id)->delete();
            SeksiBankUpload::where($f_bank,$id)->delete();
            SeksiBank::find($id)->delete();
        }
        else if ($table == $umum) {
            BagianUmumTambahan::where($f_umum,$id)->delete();
            BagianUmumUpload::where($f_umum,$id)->delete();
            BagianUmum::find($id)->delete();
        } 
        else if ($table == $mski) {
            SeksiMskiTambahan::where($f_mski,$id)->delete();
            SeksiMskiUpload::where($f_mski,$id)->delete();
            SeksiMski::find($id)->delete();
       
        }
        else if ($table == $dana) {
            SeksiPencairanDanaTambahan::where($f_dana,$id)->delete();
            SeksiPencairanDanaUpload::where($f_dana,$id)->delete();
            SeksiPencairanDana::find($id)->delete();
         
        }
        else if ($table == $vera) {
            SeksiVeraTambahan::where($f_vera,$id)->delete();
            SeksiVeraUpload::where($f_vera,$id)->delete();
            SeksiVera::find($id)->delete();
        
        }
        return redirect('table-kegiatan-all/'.$table)->with('success', 'Data berhasil dihapus.');
    }

}
