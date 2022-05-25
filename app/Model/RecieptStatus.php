<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class RecieptStatus extends Model
{
	use SoftDeletes,StatusTrait;
    protected $fillable =['name', 'name_en', 'status'];

    public function getStatusAttribute($attribute)
    {

        return $this->Status()[$attribute];
    }
}
