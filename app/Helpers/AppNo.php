<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use DB;
use App\Model\PreRegisterApp;
use App\Helpers\GenerateCodeNo;
use App\Model\AppForm;
class AppNo
{
    public function getPreAppNo()
    {

        $code = PreRegisterApp::where('regapp_number', 'LIKE', GenerateCodeNo::preNumberPrefix() . '%')->orderBy('regapp_number', 'desc')->select('regapp_number')->first();
        
        if ($code == null) {
            $app_num= GenerateCodeNo::preNumber(000000);
        } else {
            $app_num= GenerateCodeNo::preNumber($code['regapp_number']);
        }
        return $app_num;
    }

    public function getAppNo()
    {
        $code = AppForm::where('app_no', 'LIKE', GenerateCodeNo::appNumberPrefix() . '%')->orderBy('app_no', 'desc')->select('app_no')->first();
      
        if ($code == null) {
            $app_no= GenerateCodeNo::appNumber(000000);
        } else {
            $app_no= GenerateCodeNo::appNumber($code['app_no']);
        }
       return $app_no;
    }
}