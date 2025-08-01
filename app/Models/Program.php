<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Program extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'programs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function announcement()
    {
        return $this->hasOne(Announcement::class);
    }

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'eventable');
    }

    public function gallery_videos()
    {
        return $this->morphMany(GalleryVideo::class, 'eventable');
    }

    public function bcms()
    {
        return $this->hasMany(Bcm::class);
    }
    public function kaderisasis()
    {
        return $this->hasMany(Kaderisasi::class);
    }
    
}
