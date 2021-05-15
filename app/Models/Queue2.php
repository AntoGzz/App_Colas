<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'client_id'
    ];
}
