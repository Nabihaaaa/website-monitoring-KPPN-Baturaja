<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BagianUmum;
use App\Model\BagianUmumUpload;
use App\Models\BagianUmumTambahan;

class BagianUmumTableSeeder extends Seeder
{
    public function run()
    {

        BagianUmum::create([
            'kegiatan' => 'Rapat Koordinasi',
            'nama_kegiatan' => 'Rakor Departemen Pemasaran',
            'tgl_pelaksanaan' => '2023-05-01',
            'pukul' => '14:00:00',
            'tempat' => 'Gedung A, Lantai 3, Ruang Rapat A3.1',
            'pic' => 'Budi',
            'SB' => 'Belum',
            'realisasi_pelaksanaan' => null,
            'penyelenggara' => 'Bagian Umum'
        ]);

        BagianUmum::create([
            'kegiatan' => 'Rapat Harian',
            'nama_kegiatan' => 'Rapat Harian Tim IT',
            'tgl_pelaksanaan' => '2023-05-02',
            'pukul' => '09:00:00',
            'tempat' => 'Gedung B, Lantai 5, Ruang Rapat B5.1',
            'pic' => 'Dewi',
            'SB' => 'Belum',
            'realisasi_pelaksanaan' => null,
            'penyelenggara' => 'Bagian Umum'
        ]);

        BagianUmum::create([
            'kegiatan' => 'Presentasi',
            'nama_kegiatan' => 'Presentasi Proyek Baru',
            'tgl_pelaksanaan' => '2023-05-03',
            'pukul' => '13:00:00',
            'tempat' => 'Gedung C, Lantai 2, Ruang Presentasi C2.1',
            'pic' => 'Andi',
            'SB' => 'Belum',
            'realisasi_pelaksanaan' => null,
            'penyelenggara' => 'Bagian Umum'
        ]);


        
    }
}
