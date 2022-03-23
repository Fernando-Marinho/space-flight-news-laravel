<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id', 
        'provider',
        'article_id'
    ];

    protected $table = 'events';

    public $timestamps = false;
}
