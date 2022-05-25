<?php

namespace App;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\GeneralEnum;
use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\GeneralNotify;

class User extends Authenticatable
{

    use  GeneralEnum,HasRoles,HasApiTokens, GeneralNotify;

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'first_name','last_name', 'email', 'password','phone','gender','birthdate','user_photo','department_id','position','login_id','user_type','customer_status','counter_id','api_token','status', 'user_level','user_status','user_group','session_id','last_seen_at', 'facebook', 'whatapps'

                        ];

     public static $generalenum = [
        "gender"=>["male"=>"Male", "female"=>"Female"],
        "user_type"=>["customer"=>"Customer", "staff"=>"Staff"],
        "customer_status" =>["pending"=>"Pending","approve"=>"Approved"],
        "user_status" =>["all"=>"All","card_print"=>"Card Print", "book_print" => "Book Print", "license_control"=>"License Control","counter_calling"=>"Counter Calling", "lock_vehicle"=>"Lock Vehicle"],
        "user_group"=>["internet"=>"Internet", "intranet"=>"Intranet"],
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
    ];
    

    public function getNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }
    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function user_info()
    {
        return $this->hasOne('\App\Model\UserInfo');
    }
    public function department()
    {
        return $this->belongsTo("App\Model\Department",'department_id')->withDefault();
    }

    public function vehiclesales()
    {
        return $this->hasMany('App\Model\VehicleSaleCenter');
            
    }

    public function transfer_vehicles()
    {
        return $this->hasMany('App\Model\TransferVehicle');
    }
    public function price_lists()
    {
        return $this->hasMany('App\Model\PriceList');
    }
    public function pre_registers()
    {
        return $this->hasMany('App\Model\PreRegisterApp');
    }
    public function action_log()
    {
        return $this->hasMany('App\Model\LogTable');
    }
    public function counter()
    {
        return $this->belongsTo("App\Model\ServiceCounter", 'counter_id')->withDefault();
    }
    public function app_form()
    {
        return $this->hasMany("App\Model\AppForm", 'staff_id');
    }
    public function pre_app_form()
    {
        return $this->hasMany("App\Model\PreRegisterApp", 'user_id');
    }
    public function passports()
    {
        return $this->hasMany("App\Model\VehiclePassport", 'user_id');
    }
    
    public function counter_matching()
    {
        return $this->hasMany("App\Model\CounterMatching", 'staff_id');
    }

    public function price_lists_payee()
    {
        return $this->hasMany('App\Model\PriceList', 'user_payee');
    }

    public static function userLists($province_code)
    {
        return \App\User::whereHas('user_info', function($query) use($province_code){
            $query->where('province_code', $province_code);
            })->whereUserTypeAndCustomerStatus('staff', 'approve')->get();
    }

    public static function  getUser()
    {
        return self::select('email', 'login_id');
    }
    
    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    public function scopeCustomerLists()
    {
        if(auth()->user()->user_level == "province"){
            return $this->whereHas('user_info', function($q) {
                $q->whereProvinceCode(auth()->user()->user_info->province_code);
                })->whereUserType('customer')->orderByRaw("FIELD(customer_status , 'pending', 'approve') ASC")->get();
         }else {
             return $this->whereUserType('customer')->orderByRaw("FIELD(customer_status , 'pending', 'approve') ASC")->get();
         }
    }
    
   
}
