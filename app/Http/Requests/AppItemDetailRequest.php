<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppItemDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            'text' => 'required',
            'money_unit_id' => 'required',
            'vehicle_type_id' => 'required',
            'vehicle_model_id' => 'required',
            'vehicle_brand_id' => 'required',
            'item_car_power' => 'required',
            'standard_id' => 'required',
            'item_car_used' => 'required',
            'steering_id' => 'required',
            'item_car_seat' => 'required',
            'item_car_manufacture'=>'required',
            'car_height'=>'required',
            'car_long'=>'required',
            'gas_id'=>'required',
            'car_wheels'=>'required',
            'car_acels'=>'required',
            'car_color'=>'required',
            'car_engine_number'=>'required',
            'car_tank_number'=>'required',
            'car_weight'=>'required',
            'car_total_weight'=>'required',
            'car_width'=>'required',
            'car_number'=>'required',
            'car_number_type'=>'required'


        ];
    }
}
