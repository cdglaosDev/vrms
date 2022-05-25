<?php
namespace App\Traits;

trait StatusTrait 
{
    public function Status()
    {
        return [
            1 => 'Active',
            0 => 'Deactive'
            
        ];
    }
  
}