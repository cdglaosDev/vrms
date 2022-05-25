<?php
namespace App\Library;
use App\User;

class CheckToken
{
        public function allToken()
        {
                return  User::whereUserTypeAndStatus('api_user', 1)->pluck('api_token')->toArray();
        }    
}