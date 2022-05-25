<?php

namespace App\Imports;


use App\TempTesting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TestingImport implements WithMultipleSheets 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            new FirstSheetImport()
        ];
    }
}
