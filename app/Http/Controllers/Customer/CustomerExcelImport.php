<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerExcelImport extends Controller
{
    private $importData;
    public function __construct()
    {
        $this->importData = new \App\Helpers\Import;
    }

    public function importForm()
    {
     
        return view('customer.ExcelImport.index');
    }

    public function storeData()
    {   
        // if session value have, destroy session value.
        if(session('vehicle_id') != null || session('duplicate_data') != null){
            session()->forget('vehicle_id');
            session()->forget('duplicate_data');
        }
      
        $this->importData->importData();
        return redirect()->to('customer/excel-import-vehicle');
    }
}


