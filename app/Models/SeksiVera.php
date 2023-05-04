<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiVera extends Model
{
    use HasFactory;

    protected $table = 'seksi_vera';

    protected $fillable = [
        'kegiatan',
        'nama_kegiatan',
        'tgl_pelaksanaan',
        'pukul',
        'tempat',
        'pic',
        'SB',
        'realisasi_pelaksanaan',
        'penyelenggara'
    ];

    public function upload()
    {
        return $this->hasOne(SeksiVeraUpload::class, 'id_seksi_vera');
    }
}



