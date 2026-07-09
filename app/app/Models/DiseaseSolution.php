<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_key',
        'disease_name',
        'cause',
        'pesticide',
        'watering',
        'prevention'
    ];
}
