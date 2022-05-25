<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PriceItemGroup extends Model
{
    
   
    protected $fillable = ['group_code', 'group_name', 'group_name_en', 'group_note', 'status', 'create_by', 'update_by'];

    public function group_details()
    {
        return $this->hasMany('\App\Model\PriceItemGroupDetail', "item_group_id");
    }
}
