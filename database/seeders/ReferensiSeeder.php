<?php

namespace Database\Seeders;
use App\Models\ReferensiPegawai;
use App\Models\ReferensiKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferensiSeeder extends Seeder
{
    
    public function run()
    {
        ReferensiPegawai::create(['id_user'=> 2]);
        ReferensiPegawai::create(['id_user'=> 5]);
        
        ReferensiKegiatan::create(['nama' => 'rapat']);
        ReferensiKegiatan::create(['nama' => 'GKM']);
    }
}
