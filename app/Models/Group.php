<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'has_groups', 'group_id', 'user_id');
    }

    public function leaderUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function officer_service_fas()
    {
        return $this->hasMany(OfficerServiceFa::class);
    }
}
