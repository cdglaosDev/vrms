<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class VehicleImport implements WithMultipleSheets
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
