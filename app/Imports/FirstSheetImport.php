<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Model\TempVehicleDetail;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FirstSheetImport implements ToModel, WithHeadingRow, WithValidation
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ( !isset($row['pre_licence_no']) && !isset($row['vehicle_kind']) && !isset($row['owner_name']) 
            && !isset($row['village']) && !isset($row['district'])  && !isset($row['province']) && !isset($row['vehicle_type']) 
            && !isset($row['brand']) && !isset($row['model']) && !isset($row['engine_no']) && !isset($row['chassis_no']) )
        {
            return null;
        }
        return new TempVehicleDetail([
            "licence_no_need"=>$row['pre_licence_no'],
            "vehicle_kind_code"=>$row['vehicle_kind'],
            "owner_name"=>$row['owner_name'],
            "village_name"=>$row['village'],
            'district_code' =>$row['district'],
            'province_code' =>$row['province'],
            'vehicle_type_id' =>$row['vehicle_type'],
            'brand_id' =>$row['brand'],
            'model_id' =>$row['model'],
            'color_id' =>$row['color'],
            'steering_id' =>$row['steering'],
            'gas_id'=> $row['gas'],
            'motor_brand_id' =>$row['moter_brand'],
            'cylinder' =>$row['cyclinder'],
            'cc' => $row['cc'],
            'engine_no' =>strtoupper(str_replace(' ', '', $row['engine_no'])),
            'chassis_no' =>strtoupper(str_replace(' ', '', $row['chassis_no'])),
            'engine_type_id' => $row['engine_type_id'],
            'width' =>$row['width'],
            'long' =>$row['long'],
            'height' =>$row['height'],
            'seat' =>$row['seat'],
            'weight' =>$row['weight'],
            'weight_filled' =>$row['weight_filled'],
            'total_weight' =>$row['total_weight'],
            'axis' =>$row['axis'],
            'wheels' =>$row['wheels'],
            'year_manufacture' =>$row['year_mnf'],
            'import_permit_no' =>$row['import_permit_no'],
            'import_permit_date' =>$row['import_permit_date'],
            'industrial_doc_no' =>$row['industrial_doc_no'],
            'industrial_doc_date' =>$row['industrial_doc_date'],
            'technical_doc_no' =>$row['technical_doc_no'],
            'technical_doc_date' =>$row['technical_doc_date'],
            'comerce_permit_no' =>$row['commerce_permit_no'],
            'comerce_permit_date' =>$row['commerce_permit_date'],
            'tax_no' =>$row['tax_no'],
            'tax_date' =>$row['tax_date'],
            'tax_payment_no' =>$row['tax_payment_no'],
            'tax_payment_date' =>$row['tax_payment_date'],
            'police_doc_no' =>$row['police_doc_no'],
            'police_doc_date' =>$row['police_doc_date'],
            'remark' =>$row['remark'],
            'user_id' =>auth()->user()->id
                   
        ]);
        
    }

    public function  rules(): array {
        return [
           
        //    '*.engine_no' => 'temp_vehicle_details',
        //     '*.chassis_no' => 'unique:temp_vehicle_details',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
  
}
