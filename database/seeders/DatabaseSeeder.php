<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call([UserRolePermissionSeeder::class]);
        $this->call([BagianUmumTableSeeder::class]);
        $this->call([ReferensiSeeder::class]);
    }
}
