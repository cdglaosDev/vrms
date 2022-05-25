<?php

namespace App\Http\Controllers\Module5;
use App\Http\Controllers\Controller;
use App\Model\VehicleDetail;

class ExcelImport extends Controller
{
    private $importData;
    public function __construct()
    {
        $this->importData = new \App\Helpers\Import;
    }

    public function importForm()
    {
     
        return view('Module5.ExcelImport.index');
    }

    public function storeData()
    {   
          //if session value have, destroy session value.
        if(session('vehicle_id') != null || session('duplicate_data') != null){
            session()->forget('vehicle_id');
            session()->forget('duplicate_data');
        }
      
        $this->importData->importData();
        return redirect()->to('/excel-import-vehicle');
    }

    
}
