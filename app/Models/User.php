<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone', 'email', 'password','status','cnic','posting',
        'address','image', 'type','email_verified','temp_password','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'date',
    ];
    public function setPasswordAttribute($value){
        if (!empty($value)){
            $this->attributes['password'] = Hash::make($value);
        }
    }
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveAImage($value,'/profile/');
    }
    public static function block(){
        return (new static)::where('status','block')->get();
    }
    public static function active(){
        return (new static)::where('status','active')->get();
    }
    public static function police_station(){
        return (new static)::where('type','Police Station')->get();
    }
    public static function prosecution_branch(){
        return (new static)::where('type','Prosecution Branch')->get();
    }
    public static function court(){
        return (new static)::where('type','Court')->get();
    }
    public function challans()
    {
        return $this->hasMany(Challan::class);
    }
    public function firs()
    {
        return $this->hasMany(FIR::class);
    }
}
