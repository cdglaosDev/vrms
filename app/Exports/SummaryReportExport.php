<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\User\Entities\User;
use Illuminate\Contracts\View\View;
class SummaryReportExport  implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $price_list;
    private $from_date;
    private $to_date;
    private $staff_name;
    public function __construct($price_list, $from_date, $to_date, $staff_name)
    {
        $this->price_list = $price_list;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->staff_name = $staff_name;
    }

    public function view(): View
    {
      
        return view('ManageFinicialReports.summary_excel_format', ['price_list' => $this->price_list, 'from_date' => $this->from_date, 'to_date' => $this->to_date, 'staff_name'=>$this->staff_name]);
    }

   
}
