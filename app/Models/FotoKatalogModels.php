<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoKatalogModels extends Model
{
    use HasFactory;
    protected $table = 'fotokatalog';

    protected $fillable = [
        'katalog_id',
        'path_foto',
    ];

    public function produk()
    {
        return $this->belongsTo(KatalogModels::class, 'katalog_id');
    }
}
