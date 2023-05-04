<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('bagian_umum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('kegiatan',100);
            $table->string('nama_kegiatan',100);
            $table->date('tgl_pelaksanaan');
            $table->time('pukul');
            $table->string('tempat',100);
            $table->string('pic',100);
            $table->string('SB',100);
            $table->date('realisasi_pelaksanaan',100)->nullable();
            $table->string('penyelenggara',100);
            $table->timestamps();
        });

        Schema::create('seksi_bank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('kegiatan',100);
            $table->string('nama_kegiatan',100);
            $table->date('tgl_pelaksanaan');
            $table->time('pukul');
            $table->string('tempat',100);
            $table->string('pic',100);
            $table->string('SB',100);
            $table->date('realisasi_pelaksanaan',100)->nullable();
            $table->string('penyelenggara',100);
            $table->timestamps();
        });

        Schema::create('seksi_pencairan_dana', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('kegiatan',100);
            $table->string('nama_kegiatan',100);
            $table->date('tgl_pelaksanaan');
            $table->time('pukul');
            $table->string('tempat',100);
            $table->string('pic',100);
            $table->string('SB',100);
            $table->date('realisasi_pelaksanaan',100)->nullable();
            $table->string('penyelenggara',100);
            $table->timestamps();
        }); 

        Schema::create('seksi_Vera', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('kegiatan',100);
            $table->string('nama_kegiatan',100);
            $table->date('tgl_pelaksanaan');
            $table->time('pukul');
            $table->string('tempat',100);
            $table->string('pic',100);
            $table->string('SB',100);
            $table->date('realisasi_pelaksanaan',100)->nullable();
            $table->string('penyelenggara',100);
            $table->timestamps();
        });

        Schema::create('seksi_MSKI', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('kegiatan',100);
            $table->string('nama_kegiatan',100);
            $table->date('tgl_pelaksanaan');
            $table->time('pukul');
            $table->string('tempat',100);
            $table->string('pic',100);
            $table->string('SB',100);
            $table->date('realisasi_pelaksanaan',100)->nullable();
            $table->string('penyelenggara',100);
            $table->timestamps();
        });

        Schema::create('bagian_umum_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_bagian_umum')->references('id')->on('bagian_umum');
            $table->binary('undangan')->nullable()->length(5242880);;
            $table->binary('absensi')->nullable();
            $table->binary('foto')->nullable();
            $table->binary('notulensi')->nullable();
            $table->string('filename_undangan')->nullable();
            $table->string('type_undangan')->nullable();
            $table->string('filename_absensi')->nullable();
            $table->string('type_absensi')->nullable();
            $table->string('filename_foto')->nullable();
            $table->string('type_foto')->nullable();
            $table->string('filename_notulensi')->nullable();
            $table->string('type_notulensi')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_pencairan_dana_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_pencairan_dana')->references('id')->on('seksi_pencairan_dana');
            $table->binary('undangan')->nullable();
            $table->binary('absensi')->nullable();
            $table->binary('foto')->nullable();
            $table->binary('notulensi')->nullable();
            $table->string('filename_undangan')->nullable();
            $table->string('type_undangan')->nullable();
            $table->string('filename_absensi')->nullable();
            $table->string('type_absensi')->nullable();
            $table->string('filename_foto')->nullable();
            $table->string('type_foto')->nullable();
            $table->string('filename_notulensi')->nullable();
            $table->string('type_notulensi')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_bank_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_bank')->references('id')->on('seksi_bank');
            $table->binary('undangan')->nullable();
            $table->binary('absensi')->nullable();
            $table->binary('foto')->nullable();
            $table->binary('notulensi')->nullable();
            $table->string('filename_undangan')->nullable();
            $table->string('type_undangan')->nullable();
            $table->string('filename_absensi')->nullable();
            $table->string('type_absensi')->nullable();
            $table->string('filename_foto')->nullable();
            $table->string('type_foto')->nullable();
            $table->string('filename_notulensi')->nullable();
            $table->string('type_notulensi')->nullable();
            $table->timestamps();
        });

        

        Schema::create('seksi_Vera_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_Vera')->references('id')->on('seksi_Vera');
            $table->binary('undangan')->nullable();
            $table->binary('absensi')->nullable();
            $table->binary('foto')->nullable();
            $table->binary('notulensi')->nullable();
            $table->string('filename_undangan')->nullable();
            $table->string('type_undangan')->nullable();
            $table->string('filename_absensi')->nullable();
            $table->string('type_absensi')->nullable();
            $table->string('filename_foto')->nullable();
            $table->string('type_foto')->nullable();
            $table->string('filename_notulensi')->nullable();
            $table->string('type_notulensi')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_MSKI_upload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_MSKI')->references('id')->on('seksi_MSKI');
            $table->binary('undangan')->nullable();
            $table->binary('absensi')->nullable();
            $table->binary('foto')->nullable();
            $table->binary('notulensi')->nullable();
            $table->string('filename_undangan')->nullable();
            $table->string('type_undangan')->nullable();
            $table->string('filename_absensi')->nullable();
            $table->string('type_absensi')->nullable();
            $table->string('filename_foto')->nullable();
            $table->string('type_foto')->nullable();
            $table->string('filename_notulensi')->nullable();
            $table->string('type_notulensi')->nullable();
            $table->timestamps();
        });

        Schema::create('bagian_umum_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_bagian_umum')->references('id')->on('bagian_umum_upload');
            $table->binary('tambahan')->nullable();
            $table->string('filename_tambahan')->nullable();
            $table->string('type_tambahan')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_bank_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_bank')->references('id')->on('seksi_bank_upload');
            $table->binary('tambahan')->nullable();
            $table->string('filename_tambahan')->nullable();
            $table->string('type_tambahan')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_MSKI_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_MSKI')->references('id')->on('seksi_MSKI_upload');
            $table->binary('tambahan')->nullable();
            $table->string('filename_tambahan')->nullable();
            $table->string('type_tambahan')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_pencairan_dana_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_pencairan_dana')->references('id')->on('seksi_pencairan_dana_upload');
            $table->binary('tambahan')->nullable();
            $table->string('filename_tambahan')->nullable();
            $table->string('type_tambahan')->nullable();
            $table->timestamps();
        });

        Schema::create('seksi_Vera_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_seksi_Vera')->references('id')->on('seksi_Vera_upload');
            $table->binary('tambahan')->nullable();
            $table->string('filename_tambahan')->nullable();
            $table->string('type_tambahan')->nullable();
            $table->timestamps();
        });


        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN notulensi MEDIUMBLOB");

        DB::statement("ALTER TABLE seksi_MSKI_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_MSKI_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_MSKI_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_MSKI_upload MODIFY COLUMN notulensi MEDIUMBLOB");

        DB::statement("ALTER TABLE seksi_Vera_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_Vera_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_Vera_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_Vera_upload MODIFY COLUMN notulensi MEDIUMBLOB");

        DB::statement("ALTER TABLE seksi_pencairan_dana_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_pencairan_dana_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_pencairan_dana_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_pencairan_dana_upload MODIFY COLUMN notulensi MEDIUMBLOB");

        DB::statement("ALTER TABLE seksi_bank_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_bank_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_bank_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_bank_upload MODIFY COLUMN notulensi MEDIUMBLOB");

        DB::statement("ALTER TABLE bagian_umum_tambahan MODIFY COLUMN tambahan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_bank_tambahan MODIFY COLUMN tambahan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_MSKI_tambahan MODIFY COLUMN tambahan MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_pencairan_dana_tambahan MODIFY COLUMN tambahan MEDIUMBLOB");


        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN undangan MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN absensi MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN foto MEDIUMBLOB");
        DB::statement("ALTER TABLE bagian_umum_upload MODIFY COLUMN notulensi MEDIUMBLOB");
        DB::statement("ALTER TABLE seksi_Vera_tambahan MODIFY COLUMN tambahan MEDIUMBLOB");
    }

   
    public function down()
    {
        Schema::dropIfExists('bagian_umum_tambahan');
        Schema::dropIfExists('seksi_bank_tambahan');
        Schema::dropIfExists('seksi_MSKI_tambahan');
        Schema::dropIfExists('seksi_pencairan_dana_tambahan');
        Schema::dropIfExists('seksi_Vera_tambahan');

        Schema::dropIfExists('bagian_umum_upload');
        Schema::dropIfExists('seksi_pencairan_dana_upload');
        Schema::dropIfExists('seksi_bank_upload');
        Schema::dropIfExists('seksi_Vera_upload');
        Schema::dropIfExists('seksi_MSKI_upload');
        Schema::dropIfExists('bagian_umum');
        Schema::dropIfExists('seksi_pencairan_dana');
        Schema::dropIfExists('seksi_bank');
        Schema::dropIfExists('seksi_Vera');
        Schema::dropIfExists('seksi_MSKI');
    }
};
