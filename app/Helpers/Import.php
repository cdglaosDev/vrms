<?php
namespace App\Helpers;
use App\Imports\VehicleImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Model\VehicleDetail;
use DB;
class Import
{
    public function importData()
    {
       
       //check request file have or not.
        if(request()->file('file') != null ){
        $validator = Validator::make(
            [
                'file'      => request()->file,
                'extension' => strtolower(request()->file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
            ]
          );
        if ($validator->fails())
        {
            if(auth()->user()->user_type == "customer"){
                return redirect('/customer/excel-import-vehicle')->with('error', 'Your upload file is wrong.');
            } else {
                return redirect('/import-vehicle')->with('error', 'Your upload file is wrong.');
            }  
        }
            // import data into temp table first.
            Excel::import(new VehicleImport, request()->file('file'));
            $temp_data = DB::table('temp_vehicle_details')->whereUserId(auth()->id())->get();
            $app = new \App\Helpers\AppNo;
            $engine_no = VehicleDetail::getEngine()->toArray();
            $chassis_no = VehicleDetail::getChassis()->toArray();

            foreach($temp_data as $data){
               
                try { 
                    if(in_array($data->engine_no, $engine_no) || in_array($data->chassis_no, $chassis_no)) {
                        throw new \Exception();
                    }else{
                        $this->storeImportRecord($data);
                        $this->deleteTempData($data->id);
                    }
                   
                }catch (\Exception $e) {
                  //var_dump($e);
                   if($e){
                    $duplicateData['pre_license'] = $data->licence_no_need;
                    $duplicateData['engine_no'] = $data->engine_no;
                    $duplicateData['chassis_no'] = $data->chassis_no;
                    session()->push('duplicate_data', $duplicateData);
                    $this->deleteTempData($data->id);
                    }
                    
                }
                echo PHP_EOL;
            }
           
        }else{
            return back()->with('error','Need to choose excel file.');
        }
    }

        public function storeImportRecord($data)
        {

            $detail = new VehicleDetail();
            $detail->licence_no_need = $data->licence_no_need;
            $detail->vehicle_kind_code = ($data->vehicle_kind_code == null)? $data->vehicle_kind_code: \App\Model\VehicleKind::whereNameEn($data->vehicle_kind_code)->orWhere('name',$data->vehicle_kind_code)->pluck('vehicle_kind_code')->first();
            $detail->province_code = ($data->province_code == null)?$data->province_code: \App\Model\Province::whereNameEn($data->province_code)->orWhere('name',$data->province_code)->pluck('province_code')->first();
            $detail->district_code = ($data->district_code == null)? $data->district_code: \App\Model\District::whereNameEn($data->district_code)->orWhere('name',$data->district_code )->pluck('district_code')->first();
            $detail->village_name = $data->village_name;
            $detail->vehicle_type_id = ($data->vehicle_type_id == null)? $data->vehicle_type_id: \App\Model\VehicleType::whereNameEn($data->vehicle_type_id)->orWhere('name',$data->vehicle_type_id)->pluck('id')->first();
            $detail->steering_id = ($data->steering_id == null)? $data->steering_id: \App\Model\Steering::whereNameEn($data->steering_id)->orWhere('name', $data->steering_id)->pluck('id')->first();
            $detail->color_id = ($data->color_id == null)? $data->color_id : \App\Model\Color::whereNameEn($data->color_id)->orWhere('name', $data->color_id)->pluck('id')->first();
            $detail->year_manufacture = $data->year_manufacture;
            $detail->height = $data->height;
            $detail->long = $data->long;
            $detail->gas_id = ($data->gas_id== null)?$data->gas_id: \App\Model\Gas::whereNameEn($data->gas_id)->orWhere('name', $data->gas_id)->pluck('id')->first();
            $detail->wheels = $data->wheels;
            $detail->engine_no = strtoupper(str_replace(' ', '', $data->engine_no));
            $detail->chassis_no = strtoupper(str_replace(' ', '', $data->chassis_no));
            $detail->engine_type_id = ($data->engine_type_id == null)? $data->engine_type_id: \App\Model\EngineType::whereNameEn($data->engine_type_id)->orWhere('name',$data->engine_type_id)->pluck('id')->first();
            $detail->weight = $data->weight;
            $detail->import_permit_no = $data->import_permit_no;
            $detail->import_permit_date = ($data->import_permit_date == null)?null: $data->import_permit_date;
            $detail->industrial_doc_no = $data->industrial_doc_no;
            $detail->industrial_doc_date = ($data->industrial_doc_date == null)? null:$data->industrial_doc_date;
            $detail->technical_doc_no = $data->technical_doc_no;
            $detail->technical_doc_date =  ($data->technical_doc_date == null)? null: $data->technical_doc_date;
            $detail->total_weight = $data->total_weight;
            $detail->width = $data->width;
            $detail->brand_id = ($data->brand_id == null)? $data->brand_id: \App\Model\VehicleBrand::whereNameEn($data->brand_id)->orWhere('name', $data->brand_id)->pluck('id')->first();
            $detail->model_id = ($data->model_id == null)?$data->model_id: \App\Model\VehicleModel::whereNameEn($data->model_id)->orWhere('name', $data->model_id)->pluck('id')->first();
            $detail->comerce_permit_no = $data->comerce_permit_no;
            $detail->comerce_permit_date = ($data->comerce_permit_date == null) ?null: $data->comerce_permit_date;
            $detail->tax_no = $data->tax_no;
            $detail->tax_date = ($data->tax_date == null)? null: $data->tax_date;
            $detail->tax_payment_no = $data->tax_payment_no;
            $detail->tax_payment_date = ($data->tax_payment_date == null)? null: $data->tax_payment_date;
            $detail->police_doc_no = $data->police_doc_no;
            $detail->police_doc_date = ($data->police_doc_date == null)? null : $data->police_doc_date;
            $detail->remark = $data->remark;
            $detail->motor_brand_id = ($data->motor_brand_id == null)?$data->motor_brand_id: \App\Model\EngineBrand::whereNameEn($data->motor_brand_id)->orWhere('name', $data->motor_brand_id)->pluck('id')->first();
            $detail->seat = $data->seat;
            $detail->cylinder = $data->cylinder;
            $detail->cc = $data->cc;
            $detail->weight_filled = $data->weight_filled;
            $detail->axis = $data->axis;
            $detail->owner_name = $data->owner_name;
            $detail->user_id = auth()->id();
            $detail->save();
            $vehData['vehicle_id'] = $detail->id;
            $pre_app = new \App\Library\UploadDoc();
            $pre_app->savePreFormByExcel($detail->id);
            session()->push('vehicle_id', $vehData);
        }

        public function deleteTempData($id)
        {
            return  DB::table('temp_vehicle_details')->whereUserIdAndId(auth()->id(), $id)->delete();
        }
}
