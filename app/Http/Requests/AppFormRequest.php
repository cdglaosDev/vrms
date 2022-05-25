<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppFormRequest extends FormRequest
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
            'company_id' => 'required',
            'date_req' => 'required',
            'application_type_id' => 'required',
            'app_license_type_id' => 'required',
            'ministry_license' => 'required',
            'tax_office_id' => 'required',
            'department_license' => 'required',
            'detail_date_approve' => 'required',
            'date_expire' => 'required',
            'app_purpose_id' => 'required',
            'doc_type_id' =>"required",
            "filename" =>"required"
            
            

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name is Required.',
            'detail.required'  => 'The detail is Required.',
            'price.required'  => 'The price is Required.',
        ];
         return [
            'company_id.required' => 'The Company is Required.',
            'date_req.required' => 'The Date is Required.',
            'application_type_id.required' => 'The Application Type is Required.',
            'app_license_type_id.required' => 'The License Type is Required.',
            'ministry_license.required' => 'The Ministry License is Required.',
            'tax_office_id.required' => 'The Tax Office is Required.',
            'department_license.required' => 'The Department License is Required.uired',
            'detail_date_approve.required' => 'The date approved is Required.',
            'date_expire.required' => 'The date expire is Required.',
            'app_purpose_id.required' => 'The App purpose is Required.'
            

        ];
    }

   
}
