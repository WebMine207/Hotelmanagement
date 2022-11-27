<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_number','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'deleted_at'
    ];

    public function getFullNameAttribute()
    {
        if($this->first_name != "" && $this->last_name != ""){
            $name = $this->first_name.' '.$this->last_name;
        }elseif($this->name != ""){
            $name = $this->name;
        }else{
            $name = '';
        }
        return $name;
    }
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hotel()
    {
        return $this->hasOne(Hotel::class,'user_id','id');
    }

    public function phoneCode()
    {
        return $this->hasOne(phoneCode::class,'phone','phone_Code');
    }

}
