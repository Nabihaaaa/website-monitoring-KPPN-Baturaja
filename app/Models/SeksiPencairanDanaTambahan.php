<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiPencairanDanaTambahan extends Model
{
    use HasFactory;

    protected $table = 'seksi_pencairan_dana_tambahan';

    protected $fillable = [
        'id_seksi_pencairan_dana',
        'tambahan',
        'filename_tambahan',
        'type_tambahan'
    ];

    public function upload()
    {
        return $this->belongsTo(SeksiPencairanDanaUpload::class, 'id_seksi_pencairan_dana');
    }
}
