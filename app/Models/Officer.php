<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Officer extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;

    protected $table = 'officers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'has_officers', 'officer_id', 'user_id');
    }
}
