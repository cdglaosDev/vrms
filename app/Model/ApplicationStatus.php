<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;
class ApplicationStatus extends Model
{

    use SoftDeletes,StatusTrait;
    protected $fillable=['name', 'name_en', 'status'];

    protected $attributes = [
        'status' => 1
    ];
    protected $dates = ['deleted_at'];

    public function scopeActive($query) 
    {
        return $query->where('deleted_at', '=' , null);
    }

    public function getStatusAttribute($attribute)
    {

        return $this->Status()[$attribute];
    }

    public function department()
    {
       return $this->hasMany('\App\Model\PreRegisterApp');
    }
    
    public function pre_reg_app()
    {
       return $this->hasMany('\App\Model\PreRegisterApp');
    }

}
