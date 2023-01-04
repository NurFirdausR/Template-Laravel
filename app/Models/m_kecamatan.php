<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_kecamatan extends Model
{
    use HasFactory;

    protected $table = 'm_kecamatan';

    /**
     * Relasi ke tabel kabupaten
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kabupaten()
    {
        return $this->belongsTo(m_kabupaten::class, 'kabupaten_id');
    }
}
