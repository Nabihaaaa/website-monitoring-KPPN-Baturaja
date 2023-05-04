<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
       Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->binary('photo');
            $table->string('email')->unique()->nullable();
            $table->string('nama');
            $table->string('seksi');
            $table->string('jabatan');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN photo MEDIUMBLOB");
    }

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
