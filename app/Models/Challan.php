<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    protected $fillable = [
        'user_id',
        'fir',
        'dated', 
        'under_section', 
        'police_station',
        'i_o_name',
        'i_o_contacted_to_complainant', 
        'challan_prepare_within_14_days',
        'image',
        'road_no',
        'nature_of_challan',
        'challan_interim_report_within_14_days',
        'file_send_after_3_days',
        'challan_receive_in_branch',
        'interim_sent_to_prosecution_department_date',
        'objection_date',
        'prosecutor_name',
        'challan_passed_date',
        'challan_resubmitted_after_defect_removals',
        'date_of_receiving_challan_in_court',
    ];
    protected $casts = [
        'dated' => 'date',
        'interim_sent_to_prosecution_department_date' => 'date',
        'objection_date' => 'date',
        'challan_passed_date' => 'date',
        'date_of_receiving_challan_in_court' => 'date',
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveCImage($value,'/challan/');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function pending(){
        return (new static)::where('challan_prepare_within_14_days',1)->get();
    }
}
