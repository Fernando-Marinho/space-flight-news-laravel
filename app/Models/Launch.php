<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Launch extends Model
{
    protected $fillable = [
        'id', 
        'provider',
        'article_id'
    ];

    protected $table = 'launches';

    public $timestamps = false;
}
