<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class GalleryVideo extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'gallery_videos';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function eventable_video()
    {
        return $this->morphTo();
    }
}
