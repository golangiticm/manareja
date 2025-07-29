<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Gallery extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'galleries';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'datetime',
    ];

    public function eventable()
    {
        return $this->morphTo(Service::class);
    }
}
