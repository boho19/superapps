<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    // // Contoh function untuk menambahkan data ke dalam output tabel, dengan nama attr nama. Seperti user->nama
    // public function getNamaAttribute()
    // {
    //     $karyawan = Karyawan::where('id_user', $this->id)->first();
    //     return $karyawan ? $karyawan->nama : null;
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function karyawan(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'id_user');
    }
}
