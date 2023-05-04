<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nip',
        'photo',
        'nama',
        'email',
        'seksi',
        'jabatan',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function referensiPegawai()
    {
        return $this->hasOne(ReferensiPegawai::class, 'id_user');
    }
    public function scopeBySeksi($query, $seksi)
    {
        return $query->whereHas('referensiPegawai', function($q) use ($seksi) {
            $q->where('seksi', $seksi)
                ->orWhere('seksi', 'Semua Role');
        });
    }
}
