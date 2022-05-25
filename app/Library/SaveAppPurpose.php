<?php
namespace App\Library;
use App\Model\AppFormPurpose;
class SaveAppPurpose
{
    public function storeAppPurpose($app_form_id, $purposeId)
    {
        AppFormPurpose::whereAppFormId($app_form_id)->delete();
        foreach ($purposeId as $purpose => $value) {  
            $app_purpose = array(
                'app_form_id' => $app_form_id,
                'app_purpose_id' => $value
            );
            AppFormPurpose::insert($app_purpose);
        }
    }
}