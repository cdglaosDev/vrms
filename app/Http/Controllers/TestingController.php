<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Testing;
use DB;
use App\TempTesting;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\CarbonInterval;
use PHPUnit\Util\Test;
use App\Model\Color;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
class TestingController extends Controller
{
  public function index()
  {
      return view('testing.index');
  }
    public function saveOtherDB(Request $request){
      Excel::import(new \App\Imports\TestingImport,request()->file('file'));
      
      return redirect()->action('TestingController@index')->with('success','already imported');
      
    }

      public function uploadFile(Request $request){
     
        if ($request['submit'] != null ){
            
          $file = $request['file'];
            
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
         
          // Valid File Extensions
          $valid_extension = array("csv");
          
          // 2MB in Bytes
          $maxFileSize = 2097152; 
        
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
              // File upload location
              $location = 'ImportVehicle';
              // Upload file
              $file->move($location,$filename);
              // Import CSV to Database
              $filepath = public_path($location."/".$filename);
              // Reading file
              $file = fopen($filepath,"r");
          
              $importData = array();
              $i = 0;
              while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                 $num = count($filedata );
                 // skip header row
                 if($i == 0){
                    $i++;
                    continue; 
                 }
                 for ($c=0; $c < $num; $c++) {
                    $importData[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
            
              foreach($importData as $data){
                  
                $insertData = array(
                    "vehicle_id"=>$data[0]
                );
                  DB::table('temp_testings')->insert($insertData);
              }

              Session::flash('message','Import Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 2MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }
        return redirect()->action('TestingController@index');
      }

      public function qrCode(){
        
        $qrcode = QrCode::size(300)
        ->format('png')
        ->generate("http://vrms.cdgmyanmar.com/", public_path('images/qr-img.png'));
      }


      // public function testTime(){
      //   $schedule = [
      //     'start' => '2015-11-18 09:00:00',
      //     'end' => '2015-11-18 12:00:00',
      // ];
     
      // $start = Carbon::instance(new \DateTime($schedule['start']));
      // $end = Carbon::instance(new \DateTime($schedule['end']));
   
      // $events = [
      //     [
      //         'created_at' => '2015-11-18 09:00:00',
      //         'updated_at' => '2015-11-18 12:00:00',
      //     ]
          
      // ];
 
      // $minSlotHours = 0;
      // $minSlotMinutes = 15;
      // $minInterval = CarbonInterval::hour($minSlotHours)->minutes($minSlotMinutes);
     
      // $reqSlotHours = 0;
      // $reqSlotMinutes = 45;
      // $reqInterval = CarbonInterval::hour($reqSlotHours)->minutes($reqSlotMinutes);
   
      // function slotAvailable($from, $to, $events){
      
      //     foreach($events as $event){
      //         $eventStart = Carbon::instance(new \DateTime($event['created_at']));
      //         $eventEnd = Carbon::instance(new \DateTime($event['updated_at']));
      //         if($from->between($eventStart, $eventEnd) && $to->between($eventStart, $eventEnd)){
               
      //             return false;
      //         }
      //     }
      //     return true;
      // }
  
      // foreach(new \DatePeriod($start, $minInterval, $end) as $slot){
       
      //     $to = $slot->copy()->add($reqInterval);
       
      //     echo $slot->toDateTimeString() . ' to ' . $to->toDateTimeString();
        
      //     if(slotAvailable($slot, $to, $events)){
      //         echo ' is available';
      //     }
  
      //     echo '<br />';
      // }
      // }

     public function SplitTime($StartTime, $EndTime, $Duration="30"){
        $ReturnArray = array ();// Define output
      
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp
     
        $AddMins  = $Duration * 30;
      
        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("G:i", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
    }
    
    //Calling the function
    public function TestSlot(){
      // $Data = $this->SplitTime("2018-05-12 09:00", "2018-05-12 12:00", "30");
      // echo "<pre>";
      // print_r($Data);
      // echo "<pre>";
    
      // $starttime = '9:00';  // your start time
      // $endtime = '12:00';  // End time
      // $duration = '15';  // split by 30 mins
  
      // $array_of_time = array ();
      // $start_time    = strtotime ($starttime); //change to strtotime
      // $end_time      = strtotime ($endtime); //change to strtotime
  
      // $add_mins  = $duration * 60;
  
      // while ($start_time <= $end_time) // loop between time
      // {
      //    $array_of_time[] = date ("h:i", $start_time);
      //    $start_time += $add_mins; // to check endtie=me
      // }
     
      // $new_array_of_time = [];
      // for($i = 0; $i < count($array_of_time) - 1; $i++)
      // {
          
      //     $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];
      // }
      // dd($new_array_of_time);
      $start_time = strtotime('2015-10-21 09:00:00');
      $end_time = strtotime('2015-10-21 12:00:00');
      $slot = strtotime(date('Y-m-d H:i:s',$start_time) . ' +15 minutes');
    
      $data = [];
  
      for ($i=0; $slot <= $end_time; $i++) { 
  
          $data[$i] = [ 
              'start' => date('Y-m-d H:i:s', $start_time),
              'end' => date('Y-m-d H:i:s', $slot),
          ];
  
          $start_time = $slot;
          $slot = strtotime(date('Y-m-d H:i:s',$start_time) . ' +15 minutes');
      }

    return view('test-time', compact('data'));
}

public function sendMail()
{
  $name = 'Krunal';
   Mail::to('brunchlove@gmail.com')->send(new SendMailable($name));
   
   return 'Email was sent';

}
  public function getVehicleId()
  {
   
   return view('testing.add-vehicle');
  }

public function addVehilceId()
{
    
    $types = [2, 5, 4, 3, 6,7, 8 ];
    $chunks = \App\Model\Vehicle::whereBetween('id', [request('start'), request('end')])->pluck('id')->chunk(10)->toArray();
    foreach($chunks as $key=>$value){
      foreach($value as $aa=>$bb){
        foreach($types as $type){
          \App\Testing::create([
            'vehicle_id' =>$bb,
            'doc_type_id' => $type,
            'filename' => null
          ]);
        }
      }
  }
   
  session()->put(['start_no' => request('end')]);
  return back()->with('success',"Successful");
   
  }
    //add old vehicle id into vehicle document table
    public function addVehilceIds()
    {
      $doc_type = [2, 5, 4, 3, 6, 7, 8];
      \App\Model\Vehicle::chunk(1000, function($vehicles) use($doc_type) {
        foreach ($vehicles as $vehicle) {
          foreach($doc_type as $type){
            \App\Model\VehicleDocument::create([
              'vehicle_id' => $vehicle->id,
              'doc_type_id' => $type,
              'filename' => null
            ]);
        }
        }
    });
     
       return back()->with('success' , 'Successful added.');
    }
    
   
}



