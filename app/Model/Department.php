<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   
    protected $fillable = ['name', 'name_en', 'status'];

    public function olddocuments()
    {
        return $this->hasMany('\App\Model\OldDocument');
    }
}
