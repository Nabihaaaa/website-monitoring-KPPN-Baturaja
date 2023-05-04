<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiPencairanDanaUpload extends Model
{
    use HasFactory;

    protected $table = 'seksi_pencairan_dana_upload';

    protected $fillable = [
        'id_seksi_pencairan_dana',
        'undangan',
        'absensi',
        'foto',
        'notulensi',
        'filename_undangan',
        'type_undangan',
        'filename_absensi',
        'type_absensi',
        'filename_foto',
        'type_foto',
        'filename_notulensi',
        'type_notulensi'
    ];

    public function seksiPencairanDana()
    {
        return $this->belongsTo(SeksiPencairanDana::class, 'id_seksi_pencairan_dana');
    }

    public function tambahan()
    {
        return $this->hasMany(SeksiPencairanDanaTambahan::class, 'id_seksi_pencairan_dana');
    }
}
