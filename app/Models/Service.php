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

    public function officer_service_worship_leaders()
    {
        return $this->hasMany(OfficerServicesWorshipLeader::class);
    }
    public function officer_service_pendetas()
    {
        return $this->hasMany(OfficerServicePendeta::class);
    }
    public function officer_service_singers()
    {
        return $this->hasMany(OfficerServiceSinger::class);
    }
    public function officer_service_ushers()
    {
        return $this->hasMany(OfficerServiceUsher::class);
    }
    public function officer_service_kolektans()
    {
        return $this->hasMany(OfficerServiceKolektan::class);
    }
    public function officer_service_multimedias()
    {
        return $this->hasMany(OfficerServiceMultimedia::class);
    }
    public function officer_service_musiks()
    {
        return $this->hasMany(OfficerServiceMusik::class);
    }
    public function officer_service_fas()
    {
        return $this->hasMany(OfficerServiceFa::class);
    }
    public function officer_service_assigments()
    {
        return $this->hasMany(OfficerServiceAssigment::class);
    }
}
