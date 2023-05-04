<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserRolePermissionSeeder extends Seeder
{
    
    public function run()
    {
        //
        $default_user_value= [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        
            $tri = User::create(array_merge([
                'nip' => '197206151998031002',
                'nama' => 'Tri',
                'email'=> 'Tri@gmail.com',
                'seksi' => 'Admin',
                'jabatan' => 'Kepala Kantor',
            ], $default_user_value));


            $yodha = User::create(array_merge([
                'nip' => '197206151798021001',
                'nama' => 'yodha',
                'email'=> 'yodha@gmail.com',
                'seksi' => 'Seksi Bank',
                'jabatan' => 'Koordinator',
            ], $default_user_value));

            $nabiha = User::create(array_merge([
                'nip' => '197203151798031001',
                'nama' => 'nabiha',
                'email'=> 'nabiha@gmail.com',
                'seksi' => 'Seksi Bank',
                'jabatan' => 'Koordinator',
            ], $default_user_value));

            $khaila = User::create(array_merge([
                'nip' => '195204151797021003',
                'nama' => 'khaila',
                'email'=> 'khaila@gmail.com',
                'seksi' => 'Bagian Umum',
                'jabatan' => 'Koordinator',
            ], $default_user_value));

            $rafif = User::create(array_merge([
                'nip' => '19520415',
                'nama' => 'rafif',
                'email'=> 'rafif@gmail.com',
                'seksi' => 'Semua Role',
                'jabatan' => 'Koordinator',
            ], $default_user_value));

            $role_admin = Role::create(['name' => 'admin']);
            
            $role_all = Role::create(['name' => 'all']);

            $role_bagian_umum = Role::create(['name' => 'bagian_umum']);
            $role_seksi_bank = Role::create(['name' => 'seksi_bank']);
            $role_seksi_mski = Role::create(['name' => 'seksi_mski']);
            $role_seksi_pencairan_dana = Role::create(['name' => 'seksi_pencairan_dana']);
            $role_seksi_vera = Role::create(['name' => 'seksi_vera']);


            $permission = Permission::create(['name' => 'admin']);
            $permission = Permission::create(['name' => 'table_all']);
            $permission = Permission::create(['name' => 'table_role']);

            $role_admin->givePermissionTo('admin');
            $role_all->givePermissionTo('table_all');
            $role_all->givePermissionTo('table_role');

            $role_bagian_umum->givePermissionTo('table_role');
            $role_seksi_bank->givePermissionTo('table_role');
            $role_seksi_vera->givePermissionTo('table_role');
            $role_seksi_mski->givePermissionTo('table_role');
            $role_seksi_pencairan_dana->givePermissionTo('table_role');

            $tri->assignRole('admin'); 
            $yodha->assignRole('seksi_bank');
            $khaila->assignRole('bagian_umum');
            $nabiha->assignRole('seksi_bank');
            $rafif->assignRole('all');
    }
}
