<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ReferensiPegawai;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function index()
    {
        $table_name = 'Data User';
        $table_category = 'Tabel user pada website monitoring kegiatan kantor';
        $table_data = User::get();

        return view('user.index', compact(
            'table_name', 
            'table_category', 
            'table_data', 
        ));
    }

    
    public function add()
    {
        $table_name = 'Data User';
        $table_category = 'Tambahkan Data User';

        return view('user.add', compact(
            'table_name', 
            'table_category', 
        ));
    }

    
    public function store(Request $request)
    {
        $default_user_value= [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ];
   
        $nip = $request->input('nip');
        $nama = $request->input('nama');
        $seksi = $request->input('role');
        $jabatan = $request->input('jabatan');

        $existingData = User::where('nip',$nip)->exists();

        if(!$existingData){
            $user = new User();
            $user->nip = $nip;
            $user->nama = $nama;
            $user->seksi = $seksi;
            $user->jabatan = $jabatan;
            $user->fill([
                'hidden_column' => $default_user_value,
            ]);
            $user->password = bcrypt('password');
            $user->remember_token = Str::random(10);
            $user->save();

            $roleMap = [
                'Admin' => 'admin',
                'Semua Role' => 'all',
                'Bagian Umum' => 'bagian_umum',
                'Seksi Bank' => 'seksi_bank',
                'Seksi MSKI' => 'seksi_mski',
                'Seksi Pencairan Dana' => 'seksi_pencairan_dana',
                'Seksi Vera' => 'seksi_vera',
            ];

            if (array_key_exists($seksi, $roleMap)) {
                $user->assignRole($roleMap[$seksi]);
            } 

            return redirect('/user')->with('success', 'User berhasil ditambahkan!');

        }else{
            return redirect('/user')->with('error', 'NIP sudah ada!');
        }
    }

   
    public function edit($id)
    {
        $table_name = 'Data User';
        $table_category = 'Edit Data User';
        $table_data = User::find($id);

        return view('user.edit', compact(
            'table_name', 
            'table_category', 
            'table_data'
        ));
    }

   
    public function update(Request $request, $id)
    {
        $nip = $request->input('nip');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $seksi = $request->input('role');
        $jabatan = $request->input('jabatan');

        $user = User::find($id);
        $user->nama = $nama;
        $user->seksi = $seksi;
        $user->email = $email;
        $user->jabatan = $jabatan;
         

        if( $user->nip != $nip){
            $existingData = User::where('nip',$nip)->exists();
            if(!$existingData){
                $user->nip = $nip;   
                $user->save();
                return redirect('/user')->with('success', 'User berhasil diupdate!');
            }else{
                return redirect('/user')->with('error', 'NIP sudah ada!');
            }  
        }else{
            $user->save();
            return redirect('/user')->with('success', 'User berhasil diupdate!');
        }
    }

    public function destroy($id)
    {
        $exist = ReferensiPegawai::where('id_user',$id)->exists();

        if($exist){
            ReferensiPegawai::where('id_user',$id)->delete();
        }

        $user = User::find($id);

        if ($user->seksi == 'Admin') {
            $adminCount = User::where('seksi', 'Admin')->count();
            if ($adminCount === 1) {
                return redirect('/user')->with('error', 'Tidak bisa menghapus user dengan seksi Admin karena hanya tersisa satu user dengan seksi tersebut.');
            }
        }

        if ($user->id == Auth::user()->id) {
            return redirect('/user')->with('error', 'Tidak bisa menghapus akun yang sedang login!.');
        }

        $user->delete();
        return redirect('/user')->with('success', 'User berhasil dihapus!');
    }
}
