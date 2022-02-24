<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class FIR extends Model
{
    protected $fillable = [
        'fir',
        'dated', 
        'under_section', 
        'police_station',
        'offence',
        'image',
        'user_id',
    ];
    protected $casts = [
        'dated' => 'date',
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveFImage($value,'/fir/');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function challans()
    {
        return $this->hasMany(Challan::class);
    }
}
