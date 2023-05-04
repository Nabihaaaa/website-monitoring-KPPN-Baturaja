<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiMski extends Model
{
    use HasFactory;

    protected $table = 'seksi_mski';

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
        return $this->hasOne(SeksiMskiUpload::class, 'id_seksi_mski');
    }
}



