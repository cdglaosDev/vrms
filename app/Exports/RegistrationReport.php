<?php

namespace App\Exports;

use App\Model\AppForm;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistrationReport implements FromCollection
{
  

   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppForm::get();
    }
}
