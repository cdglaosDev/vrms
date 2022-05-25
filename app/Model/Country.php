<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;
class Country extends Model
{
	
 

    protected $fillable=['iso', 'name', 'name_en', 'status'];

   public function provinces()
    {
        return $this->hasMany('\App\Model\Province');
    }
  
    public function company()
    {
      return $this->hasMany(Company::class);
    }
}