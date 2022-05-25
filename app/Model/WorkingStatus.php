<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WorkingStatus extends Model
{
    use SoftDeletes;
    protected $fillable=['name', 'name_en', 'description', 'working_status_group_id', 'status'];

    public function group()
    {
    	return $this->belongsTo("App\Model\WorkingStatusGroup", 'working_status_group_id');
    }
}
