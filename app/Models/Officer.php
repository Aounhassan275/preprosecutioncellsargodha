<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name',
        'challan_id',
    ];
    public function challan()
    {
        return $this->belongsTo('App\Models\Challan');
    }
}
