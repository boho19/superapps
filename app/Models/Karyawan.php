<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'provinsi',
        'jabatan',
        'foto',
        'id_user',
        'status',
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function absen(): HasMany
    {
        return $this->hasMany(Absen::class, 'id_karyawan');
    }

    public function izin(): HasMany
    {
        return $this->hasMany(Izin::class, 'id_karyawan');
    }

}
