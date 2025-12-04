<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Asset extends Model
{
    protected $table = 'assets'; // default sudah benar, tapi boleh ditulis eksplisit

    protected $fillable = [
        'user_id',
        'no_asset',
        'nama_asset',
        'ketagori',
        'sub_kategori',
        'merek',
        'tipe',
        'nomor',
        'tahun',
        'lokasi',
        'penanggung',
        'kondisi',
        'status',
        'harga',
        'nilai',
        'latitude',
        'longtitude',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
