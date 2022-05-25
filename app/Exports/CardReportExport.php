<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\User\Entities\User;
use Illuminate\Contracts\View\View;
class CardReportExport  implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $card_print;
    private $date;
    public function __construct($data)
    {
        $this->card_print = $data['card_print'];
        $this->date = $data['date'];
    }

    public function view(): View
    {
      
        return view('ReportsAndStatic.card_report_excel', ['card_print' => $this->card_print, 'date'=> $this->date]);
    }

    
}
