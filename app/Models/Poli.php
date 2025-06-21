<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function dokters(): HasMany
    {
        return $this->hasMany(User::class, 'id_poli'); // Buat relationship one-to-many ke model User dengan kondisi role dokter
    }
}
