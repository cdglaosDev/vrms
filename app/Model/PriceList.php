<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Traits\GeneralEnum;
use App\Traits\UserType;
use Carbon\Carbon;
class PriceList extends Model
{
    use GeneralEnum,UserType;
    
    protected $fillable = ['price_list_no', 'price_receipt_no','app_form_id', 'date','user_payee','user_payer','total_amt','service_counter_id','money_unit_id','status','province_code','payment_status','reciept_status','receive_amt','refund_amt', 'lic_book_no', 'cc', 'road_tax','note', 'code', "updated_by"];

    public static $generalenum = [
        
       "payment_status" => ["pending" => "Pending","cancel" => "Cancel","complete" => "Complete","delete" => "Delete"],
        "reciept_status" => ["pending" => "Pending","cancel" => "Cancel","complete" => "Complete","delete" => "Delete"]
    ];
    protected $attributes = [
        'status' => 1
    ];
    public function getNoAttribute()
    {
        return $this->ServiceCounter->name.".".$this->price_receipt_no;
    }

    public function getStatusAttribute($attribute)
    {
        return $this -> activeOptions()[$attribute];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function activeOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ];
    }
    public function ServiceCounter()
    {
        return $this->belongsTo('App\Model\ServiceCounter', 'service_counter_id')->withDefault();
    }
    public function appForm()
    {
        return $this->belongsTo('App\Model\AppForm', 'app_form_id')->withDefault();
    }

    public function MoneyUnit()
    {
        return $this->belongsTo('App\Model\MoneyUnit', 'money_unit_id')->withDefault();
    }

    public function PriceListDetails()
    {
        return $this->hasMany('App\Model\PriceListDetail');
    }
   
    public function users_payee()
    {
        return $this->belongsTo("App\User", "user_payee")->withDefault();
    }

    public function staff()
    {
        return $this->belongsTo("App\User", "updated_by", "id")->withDefault();
    }

    public function counter_matching()
    {
        return $this->belongsTo('App\Model\CounterMatching', 'service_counter_id')->withDefault();
    }
   

    public function getPriceNoAttribute()
    {
        return $this->service_counter_id.".".$this->no;
    }

    /* mutator and accessor for date */
    // public function setDateAttribute($value)
    // {
    //     $this->attributes['date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
        
    // }
   public function getDateAttribute($value)
   {
        return ($value == "0000-00-00" || $value == null) ? null : Carbon::parse($value)->format('d/m/Y');
     
   }

   public static function storePriceList($data)
   {   
       return  self::create([
        'price_receipt_no' => $data['price_receipt_no'],
        'date' =>  \App\Helpers\DateHelper::getMySQLDateTimeFromUIDate($data['date']),
        'user_payee' =>  auth()->user()->id,
        'user_payer' =>  $data['user_payer'],
        'total_amt'  => str_replace(',', '', $data['total_amt']),
        'reciept_status'  =>$data['reciept_status'],
        'service_counter_id' => $data['service_counter_id'],
        'money_unit_id'  => 1,
        'status' => 1,
        'app_form_id' => $data['app_form_id'],
        'cc' => $data['cc'],
        'road_tax' => $data['road_tax'],
        'note' => $data['note'],
        'code' => $data['code'],
        'updated_by' => $data['updated_by'],
        'province_code' => \App\Helpers\Helper::current_province()
        ]);
   }

   public static function getLastDate($counter_id)
   {
    
       return self::whereServiceCounterId($counter_id)->orderBy('created_at', 'desc')->pluck('date')->first();
   }

   public static function subTotal($unit_price, $fine_percent)
   {
        return  $unit_price - $fine_percent ;
   }

   
   
}
