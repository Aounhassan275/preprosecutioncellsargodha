<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judges extends Model
{
    protected $fillable = [
        'name',
        'court',
    ];
}
