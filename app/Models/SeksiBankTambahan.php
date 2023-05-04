<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeksiBankTambahan extends Model
{
    use HasFactory;

    protected $table = 'seksi_bank_tambahan';

    protected $fillable = [
        'id_seksi_bank',
        'tambahan',
        'filename_tambahan',
        'type_tambahan'
    ];

    public function upload()
    {
        return $this->belongsTo(SeksiBankUpload::class, 'id_seksi_bank');
    }
}