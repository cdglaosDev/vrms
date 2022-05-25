<?php

namespace App\Traits;

trait UserType
{
    public function type($type)
    {
        return auth()->user()->user_type == $type;
    }
    
    public function level()
    {
        return auth()->user()->user_level;
    }

}
