<?php

namespace App\Http\Controllers\Cached;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class DatacachedController
{
    // searched data in cached;
    public function searching($array, $search_item)
    {
        $result = array();
        foreach ($array as $key => $value) {
            print_r($value);
            foreach ($search_item as $k => $v) {
                print_r($k);
                // if (!isset($value[$k]) || $value[$k] != $v) {
                //     continue 2;
                // }
            }
            // // $result[] = $value;
        }
        // return $result;
    }

    // get data all form mysql
    public function Allvehicles()
    {
        return  DB::select("SELECT count(vehicle_info_id) as counts FROM `vehicle_info` ")[0]->counts;
    }

    // pagination of page 
    public function getPagination($page, $size)
    {
        $limit = $size ? +$size : 20;
        $offset = $page ? $page * $limit : 0;

        return ["offset" => $offset, "limit" =>  $limit];
    }

    // create cached
    public function Caching($value): void
    {
        $arr = [];
        $arr[] = $value;
        Cache::put('allVehicles', $arr, now()->addMinutes(120));
    }

    // get cached
    public function getCached()
    {
        return  Cache::get('allVehicles');
    }
}