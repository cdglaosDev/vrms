<?php

namespace App\Http\Controllers\Module4;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeInformation extends Controller
{
    public function changeInfo(){
        return view('Module4.ChangeInfo.create');
    }
}
