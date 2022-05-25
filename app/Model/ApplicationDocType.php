<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocType extends Model
{

    protected $fillable = ['name','name_en','status'];

    public function appdoc()
    {
    	return $this->hasMany('\App\Model\AppDocument');
    }
    
    public function store_document()
    {
    	return $this->hasMany('\App\Model\AppDocument');
    }
}
