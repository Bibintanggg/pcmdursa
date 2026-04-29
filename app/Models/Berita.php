<?php

namespace App\Models;

use App\Enum\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'slug',
        'status',
        'kategori',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'status' => StatusEnum::class
    ];
}
