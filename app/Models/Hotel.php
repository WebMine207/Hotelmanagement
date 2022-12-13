<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Hotel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "hotels";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','user_id','hotel_type','total_room','guest','bedrooms','bathrooms','beds','description','status','thumbnail_image','address','price','zip_code','city','state','country','lat','lng','currency','discount_price','security_deposit_fee','convenience_charge','extra_person_fee','weekend_base_price','good_and_service_tax','cancelation_charge','refunds','cancellation','common_note','status','feature_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];
    
     /**
     * slug generate
     */
    protected static function booted()
    {
        static::created(function ($hotel) {
            $hotel->slug = $hotel->generateSlug($hotel->name);
            $hotel->save();
        });
    }

    private function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    /**
     * get hotel owner name
     */
    public function owner()
    {
        return $this->hasOne(User::class,'id','user_id'); 
    }

    public function bookmark()
    {
        return $this->hasOne(HotelBookmark::class, 'hotel_id', 'id');
    }

    public function getFeatureImageAttribute($val=null)
    {
        if(is_null($val)){
            return asset('assets/defaulthotel.png');
        }
        else{
            if(file_exists( public_path().'uploads/feature_image/'.$val )){
                return asset('uploads/feature_image').'/'.$val;
            }
            else{
                return asset('assets/defaulthotel.png');
            }
        }
    }
}
