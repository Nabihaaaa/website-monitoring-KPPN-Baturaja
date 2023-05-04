<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianUmumUpload extends Model
{
    use HasFactory;

    protected $table = 'bagian_umum_upload';

    protected $fillable = [
        'id_bagian_umum',
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

    public function bagianUmum()
    {
        return $this->belongsTo(BagianUmum::class, 'id_bagian_umum');
    }

    public function tambahan()
    {
        return $this->hasMany(BagianUmumTambahan::class, 'id_bagian_umum');
    }
}
