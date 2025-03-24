<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pasienPeriksas(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function dokterPeriksas(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }
}
