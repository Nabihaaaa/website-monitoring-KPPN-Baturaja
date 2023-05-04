<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferensiKegiatan, App\Models\ReferensiPegawai;
use App\Models\User;

class ReferensiController extends Controller
{
    
    public function indexKegiatan()
    {
        $table_name = 'Referensi Kegiatan';
        $table_category = 'Tabel Referensi Kegiatan';
        $table_data = ReferensiKegiatan::get();

        return view('referensi.kegiatan.index', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function addKegiatan()
    {
        $table_name = 'Referensi Kegiatan';
        $table_category = 'Tambahkan Data Referensi Kegiatan';

        return view('referensi.kegiatan.add', compact(
            'table_name', 
            'table_category', 
        ));
        
    }

   
    public function storeKegiatan(Request $request)
    {
        $kegiatan = $request->input('kegiatan');

        $input = new ReferensiKegiatan();
        $input->nama = $kegiatan;
        $input->save();

        return redirect('/referensi/kegiatan')->with('success', 'Referensi Kegiatan berhasil ditambahkan!');
    }

    public function editKegiatan($id)
    {
        $table_name = 'Referensi Kegiatan';
        $table_category = 'Edit Data Referensi Kegiatan';
        $data = ReferensiKegiatan::find($id);

        return view('referensi.kegiatan.edit', compact(
            'table_name', 
            'table_category',
            'data' 
        ));
    }

    public function updateKegiatan(Request $request, $id)
    {
        $kegiatan = $request->input('kegiatan');

        $input = ReferensiKegiatan::find($id);
        $input->nama = $kegiatan;
        $input->save();

        return redirect('/referensi/kegiatan')->with('success', 'Referensi Kegiatan berhasil diupdate!');
    }

    public function destroyKegiatan($id)
    {
        ReferensiKegiatan::find($id)->delete();
        return redirect('/referensi/kegiatan')->with('success', 'Referensi Kegiatan berhasil dihapus!');
    }

    public function indexPegawai()
    {
        $table_name = 'Referensi Pegawai';
        $table_category = 'Tabel Referensi Pegawai';
        $table_data =ReferensiPegawai::join('users', 'referensi_pegawai.id_user', '=', 'users.id')->get();

        return view('referensi.pegawai.index', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    public function addPegawai(Request $request)
    {
        if ($request->ajax()) {
            $seksi = $request->input('seksireferensi');
            $users = User::where('seksi', $seksi)
                ->whereNotIn('id', function($query) {
                     $query->select('id_user')
                           ->from('referensi_pegawai');
                })
                ->get();
    
            return response()->json($users);  
        }

        $table_name = 'Referensi Pegawai';
        $table_category = 'Tambahkan Data Referensi Pegawai';
        $table_data =ReferensiPegawai::join('users', 'referensi_pegawai.id_user', '=', 'users.id')->get();

        return view('referensi.pegawai.add', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

   
    public function storePegawai(Request $request)
    {
        $pegawai = $request->input('nama');

        $input = new ReferensiPegawai();
        $input->id_user = $pegawai;
        $input->save();

        return redirect('/referensi/pegawai')->with('success', 'Referensi Kegiatan berhasil ditambahkan!');
    }


    public function editPegawai(Request $request, $id)
    {
        if ($request->ajax()) {
            $seksi = $request->input('seksireferensi');
            $users = User::where('seksi', $seksi)
                ->whereNotIn('id', function($query) {
                     $query->select('id_user')
                           ->from('referensi_pegawai');
                })
                ->get();
    
            return response()->json($users);  
        }

        $table_name = 'Referensi Pegawai';
        $table_category = 'Edit Data Referensi Pegawai';
        $table_data =ReferensiPegawai::join('users', 'referensi_pegawai.id_user', '=', 'users.id')->get();

        return view('referensi.pegawai.edit', compact(
            'table_name', 
            'table_category', 
            'table_data',
            'id'
        ));
    }

    public function updatePegawai(Request $request, $id)
    {
        ReferensiPegawai::where('id_user',$id)->delete();
        
        $pegawai = $request->input('nama');

        $input = new ReferensiPegawai();
        $input->id_user = $pegawai;
        $input->save();
        
        return redirect('/referensi/pegawai')->with('success', 'Referensi Kegiatan berhasil diupdate!');
    }

    public function destroyPegawai($id)
    {
        ReferensiPegawai::where('id_user',$id)->delete();
        return redirect('/referensi/pegawai')->with('success', 'Referensi Pegawai berhasil dihapus!');
    }
}
