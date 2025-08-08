<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'kepala_divisi' => 'array',
        
        // 'visi_misi' => 'array',
        // 'sejarah' => 'array',
        // 'struktur_organisasi' => 'array',
    ];
}
