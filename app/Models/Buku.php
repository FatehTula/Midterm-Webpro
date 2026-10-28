<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    protected $fillable = [
        'judul',
        'pengarang',
        'tahun_terbit',
        'kategori_id',
        'penerbit_id',
    ];

    /**
     * Relasi buku dengan kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi buku dengan penerbit.
     */
    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class);
    }
}