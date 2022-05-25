<?php
namespace App\Helpers;

use App\Model\LogTable as LogTable;
use Carbon\Carbon;
class LogActivity
{
    public static function saveToLog($data, $tb_name, $action)
    {
    
    	$log = [];
    	$log['table_name'] = $tb_name;
        if($tb_name =="vehicles"){
            $log['vehicle_id'] = $data->id;
        }
    	$log['ip_address'] = request()->ip();
    	$log['record_id'] = $data->id;
        $log['action'] = $action;
    	$log['user_id'] = auth()->check() ? auth()->id() : 1;
        $log['date'] = Carbon::now();
        $log['action_detail'] = json_encode($data,JSON_PRESERVE_ZERO_FRACTION+JSON_UNESCAPED_UNICODE);
      
    	LogTable::create($log);
    }

}