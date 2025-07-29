<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'services';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function officer_service_fas()
    {
        return $this->hasMany(OfficerServiceFa::class);
    }
    public function officer_service_assigments()
    {
        return $this->hasMany(OfficerServiceAssigment::class);
    }

    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'eventable');
    }
    public function gallery_videos()
    {
        return $this->morphMany(GalleryVideo::class, 'eventable_video');
    }
}
