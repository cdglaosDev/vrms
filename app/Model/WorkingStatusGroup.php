<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WorkingStatusGroup extends Model
{
    use SoftDeletes;
    protected $fillable=['name', 'name_en', 'description', 'status'];

    public function workingstatuss()
    {
    	return $this->hasMany("App\Models\WorkingStatus");
    }
}
