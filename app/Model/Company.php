<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{

	use SoftDeletes;
    
  protected $fillable=['user_id', 'name', 'email', 'phone', 'fax', 'address', 'code', 'contact_name', 'contact_phone', 'tax_number', 'country_id', 'name_en', 'contact_name_en'];
      
  public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
