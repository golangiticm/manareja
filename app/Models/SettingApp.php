<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SettingApp extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'setting_apps';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

     protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
    ];
}
