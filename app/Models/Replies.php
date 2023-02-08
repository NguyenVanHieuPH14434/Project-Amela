<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;
    protected $table = 'replies';

    protected $fillable = [
        'comment_id',
        'content_id',
        'deleted_at'
    ];
}
