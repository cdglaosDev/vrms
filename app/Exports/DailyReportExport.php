<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\User\Entities\User;
use Illuminate\Contracts\View\View;
class DailyReportExport  implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $pricedetail;
    private $fine_percent;
    private $from_date;
    private $to_date;
    public function __construct($data)
    {
       
        $this->pricedetail = $data['pricedetail'];
        $this->fine_percent = $data['fine_percent'];
        $this->from_date = $data['from_date'];
        $this->to_date = $data['to_date'];
    }

    public function view(): View
    {
      
        return view('ManageFinicialReports.daily_excel_format', ['pricedetail' => $this->pricedetail, 'fine_percent'=> $this->fine_percent, 'from_date' => $this->from_date, 'to_date' => $this->to_date]);
    }

   
}
