<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianUmumTambahan extends Model
{
    use HasFactory;

    protected $table = 'bagian_umum_tambahan';

    protected $fillable = [
        'id_bagian_umum',
        'tambahan',
        'filename_tambahan',
        'type_tambahan'
    ];

    public function upload()
    {
        return $this->belongsTo(BagianUmumUpload::class, 'id_bagian_umum');
    }
}
