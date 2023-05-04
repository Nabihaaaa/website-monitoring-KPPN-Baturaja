<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('referensi_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('referensi_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('referensi_pegawai');
        Schema::dropIfExists('referensi_kegiatan');
    }
};
