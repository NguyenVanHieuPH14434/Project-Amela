<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'avatar',
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
