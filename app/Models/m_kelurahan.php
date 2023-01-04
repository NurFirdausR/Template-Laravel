<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_kelurahan extends Model
{
    use HasFactory;

    protected $table = 'm_kelurahan';

    /**
     * Relasi ke tabel kabupaten
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kecamatan()
    {
        return $this->belongsTo(m_kecamatan::class, 'kecamatan_id');
    }
}
