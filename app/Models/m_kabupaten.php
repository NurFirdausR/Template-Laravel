<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_kabupaten extends Model
{
    use HasFactory;
    protected $table = 'm_kabupaten';

    /**
     * Relasi ke tabel provinsi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinsi()
    {
        return $this->belongsTo(m_provinsi::class, 'provinsi_id');
    }
}
