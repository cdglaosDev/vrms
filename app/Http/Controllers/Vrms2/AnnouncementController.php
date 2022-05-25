<?php

namespace App\Http\Controllers\Vrms2;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;
use App\Model\AnnouncementFile;
use App\Model\AnnouncementShow;
use DB;
class AnnouncementController extends Controller
{
    function __construct()
    {   
        // // $this->middleware('permission:Annoucement-All|Annoucement-List-View|Annoucement-Create|Annoucement-Edit|Annoucement-Delete');
        $this->middleware('permission:Annoucement-List-View', ['only' => ['index']]);
        $this->middleware('permission:Annoucement-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Annoucement-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Annoucement-Delete', ['only' => ['destroy']]);
    }

    public function AnnouncementPageList()
    {
        
        if (auth()->user()->user_level == "admin") {
            $topAnno = Announcement::with('user')->orderByRaw("pin DESC, number ASC")->get();
        } else {
            $topAnno = Announcement::with('user')->whereHas('annoShow', function($q){
                $q->where('province_code', '=', Helper::current_province())->where('status', '=', 1);
            })->whereStatus(1)->orderByRaw("pin DESC, number ASC")->get();
        }
    
       return view('vrms2.announcement.page-list', compact('topAnno'));
    }
    //Announcement Lists
    public function index()
    {
       
        if (auth()->user()->user_level == "admin") {
            $announ = Announcement::with('user')->whereStatus(1)->orderByRaw("pin DESC, number ASC")->get();
        } else {
            $announ = Announcement::with('user')->whereHas('annoShow', function($q){
                $q->where('province_code', '=', Helper::current_province())->whereStatus(1);
            })->whereStatus(1)->orderByRaw("pin DESC, number ASC")->get();
        }
        if(request('up_set')) {
            $id_update =request('up_set');
          } else {
              $id_update = '';
          }
        
        return view('vrms2.announcement.index', compact('announ', 'id_update'));
    }
    //add new announcement
    public function create()
    {
        return view('vrms2.announcement.create');
    }

    //save announcement records
    public function store()
    {
       
        $log_date = date("Y-m-d"); 
        $log_time = date("H:i:s");
        $ann = Announcement::whereStatusAndPin(1,0)->orderBy('number')->get();
        foreach($ann as $data)
        {
            Announcement::whereId($data->id)->update([
                'number' => $data->number+1
            ]);
        }

       $anno = Announcement::create([
           'text_subject' => request('text_subject'),
           'text_subtitle' => request('text_subtitle'),
           'log_user' => auth()->id(),
           'log_date' => $log_date,
           'log_time' => $log_time,
           'pin' => 0,
           'number' => 1,
           'status' => 1,
           'log_status' => "a"

       ]);
       foreach (request('province_code') as $key => $value) { 
        $anno_show = array(
            'seq_id' => $anno->id,
            'province_code' => $value,
            'log_user' => auth()->id(),
            'log_date' => $log_date,
           'log_time' => $log_time
        );
        DB::table('announce_shows')->insert($anno_show);
        }
        if(request()->hasfile('file'))
        {
       
        foreach(request()->file('file') as $index=>$file)
        {
            $filename = $file->getClientOriginalName();
            $path = $file->move(public_path().'/vrms2/anno/', $filename);
            $anno_file = array(
            'seq_id' => $anno->id,
            'log_user' => auth()->id(),
            'log_date' => $log_date,
            'log_time' => $log_time,
            'file_name' => $filename,
            'real_name' => $filename,
            'file_path' =>  $path,
            'file_size' => request('size_img')[$index+1],
            );
            DB::table('announce_page_file')->insert($anno_file);
        }
        
        }else {
            DB::table('announce_page_file')->insert([
                'seq_id' => $anno->id,
                'log_user' => auth()->id(),
                'log_date' => $log_date,
                'log_time' => $log_time,
            ]);
        }
       
        return redirect('/announcement')->with('success', "Added New Announcement");
    }

    //add new announcement
    public function edit(Announcement $announcement)
    {
        $anno_province = $announcement->annoShow()->pluck('province_code')->toArray();
        $anno_files = $announcement->annoFile()->get();
       
        return view('vrms2.announcement.edit', compact('announcement', 'anno_province', 'anno_files'));
    }

    public function destroy($id)
    {
 
       $announce = Announcement::whereId($id)->select('pin', 'number')->first();
        if($announce->pin != 0 && $announce->number == 0){
            $number_pin_old = Announcement::where([ ['id', $id], ['status','=', 1],['pin', '!=','']])->orderByDesc('pin')->first();
            $allAnnounce = Announcement::select('id', 'pin')->where([ ['pin', '!=', ""], ['status', '=',1]])->orderBy('pin')->get();
            foreach($allAnnounce as $anno){
                if($number_pin_old->pin == $anno->pin){
                    Announcement::whereId($id)->update([
                        'pin' => 0,
                        'log_status' => 'e',
                        'status' =>0,
                        'date_time_ex'=>\Carbon\Carbon::now()
                    ]);
                
                } elseif($number_pin_old->pin < $anno->pin) {
                    $pin_down = $anno->pin - 1;
                    Announcement::whereId($anno->id)->update([
                        'pin' =>  $pin_down,
                        'log_status' => 'e',
                        'date_time_ex'=>\Carbon\Carbon::now()
                    ]);
                }
            }
            // delete annoucement show file
            $anno_shows = AnnouncementShow::select('id', 'seq_id')->whereSeqIdAndStatus($id, 1)->orderBy('id')->get();
            foreach($anno_shows as $anno_show){
                AnnouncementShow::whereId($anno_show->id)->update([
                    'log_status' => 'e',
                    'status' => 0,
                    'date_time_ex' => \Carbon\Carbon::now()
                ]);
            }
            // delete annouce province file
            $anno_provinces = AnnouncementFile::select('id', 'seq_id')->whereSeqIdAndStatus($id, 1)->orderBy('file_no')->get();
            foreach($anno_provinces as $anno_province){
                AnnouncementFile::whereId($anno_province->id)->update([
                    'log_status' => 'e',
                    'status' => 0,
                    'date_time_ex' => \Carbon\Carbon::now()
                ]);
            }


        } else {
            $old_number = Announcement::where([ ['id','=', $id], ['status','=',1], ['number', '!=', ""]])->pluck('number')->first();
            $anno_numbers = Announcement::select('id', 'pin', 'number')->where([['status', '=',1], ['number', '!=', ""]])->orderBy('number')->get();
            foreach($anno_numbers as $anno_number){
                if($old_number == $anno_number->number){
                    Announcement::whereId($id)->update([
                        'number' => 0,
                        'log_status' => 'e',
                        'status' =>0,
                        'date_time_ex'=>\Carbon\Carbon::now()
                    ]);
                } else if($old_number < $anno_number->number) {
                    $pin_down = $anno_number->number - 1;
                    Announcement::whereId($anno_number->id)->update([
                        'number' => $pin_down,
                        'log_status' => 'e',
                        'date_time_ex'=>\Carbon\Carbon::now()
                    ]);
                }
            }
              // delete annoucement show file
              $anno_shows = AnnouncementShow::select('id', 'seq_id')->whereSeqIdAndStatus($id, 1)->orderBy('id')->get();
              foreach($anno_shows as $anno_show){
                  AnnouncementShow::whereId($anno_show->id)->update([
                      'log_status' => 'e',
                      'status' => 0,
                      'date_time_ex' => \Carbon\Carbon::now()
                  ]);
              }
              // delete annouce province file
              $anno_provinces = AnnouncementFile::select('id', 'seq_id')->whereSeqIdAndStatus($id, 1)->orderBy('file_no')->get();
              foreach($anno_provinces as $anno_province){
                  AnnouncementFile::whereId($anno_province->id)->update([
                      'log_status' => 'e',
                      'status' => 0,
                      'date_time_ex' => \Carbon\Carbon::now()
                  ]);
              }


        }
        return back()->with('success', 'Successful deleted.');
       
    }
    //save announcement records
    public function update($id)
    {
  
        $log_date = date("Y-m-d"); 
        $log_time = date("H:i:s");
        $anno = Announcement::whereId($id)->update([
           'text_subject' => request('text_subject'),
           'text_subtitle' => request('text_subtitle'),
           'log_user' => auth()->id(),
           'log_date' => $log_date,
           'log_time' => $log_time
       ]);
       
       DB::table('announce_shows')->where('seq_id', $id)->delete();
       foreach (request('province_code') as $key => $value) { 
        $anno_show = array(
            'seq_id' => $id,
            'province_code' => $value,
            'log_user' => auth()->id(),
            'log_date' => $log_date,
           'log_time' => $log_time
        );
        DB::table('announce_shows')->insert($anno_show);
        }
        //DB::table('announce_page_file')->where('seq_id', $id)->delete();
       $anno_files = AnnouncementFile::whereSeqId($id)->pluck('id')->toArray();
        // foreach($anno_files as $key=>$value){
        //     if($value != request('exist_id')){
        //         AnnouncementFile::whereId($value)->delete();
        //     }
        // }
        if( request()->file != null)
        {
            
            foreach(request()->file('file') as $index=>$file)
            {
            
                $filename = $file->getClientOriginalName();
                $path = $file->move(public_path().'/vrms2/anno/', $filename);
                $anno_file = array(
                'seq_id' => $id,
                'log_user' => auth()->id(),
                'log_date' => $log_date,
                'log_time' => $log_time,
                'file_name' => $filename,
                'real_name' => $filename,
                'file_path' =>  $path,
                'file_size' => request('size_img')[$index+2],
                );
                DB::table('announce_page_file')->insert($anno_file);
            }
        
        } else {
           
            if(request('anno_file_id') != null){
                foreach(request('anno_file_id') as $key=>$fileId){
                    if(in_array($fileId, $anno_files)){
                        DB::table('announce_page_file')->whereId($fileId)->update([
                            'seq_id' => $id,
                            'log_user' => auth()->id(),
                            'log_date' => $log_date,
                            'log_time' => $log_time,
                            'file_size' => request('size_img')[$key+1],
                        ]);
                       
                    }
                }
            } else{
                $anno = DB::table('announce_page_file')->whereSeqId($id)->get();
                foreach($anno as $data){
                    DB::table('announce_page_file')->whereId($data->id)->delete();
                }
            }


            
           
        }
       
        return redirect('/announcement')->with('success', "Added New Announcement");
    }

    public function upPinPost()
    {
        $up = request('number')+1;
        $down = $up-1;
        DB::table('announce_pages')->update( [
            'pin' => DB::raw("CASE WHEN announce_pages.pin='".request('number')."'
            THEN '".$up."'
            ELSE '".$down."' END
            , log_status='e', date_time_ex=current_timestamp()
            WHERE
            pin IN ('".$up."', '".$down."')
            AND (SELECT * FROM (
                SELECT COUNT(*) FROM announce_pages WHERE pin IN ('".$up."', '".$down."')) s )=2")
         ] );
        return response()->json([
            'status' => 200,
        ]);
    }

    public function updateUpItem()
    {
        $up = request('number')-1;
        $down = $up+1;

        DB::table('announce_pages')->update( [
            'number' => DB::raw("CASE WHEN announce_pages.number='".request('number')."'
            THEN '".$up."'
            ELSE '".$down."' END
            , log_status='e', date_time_ex=current_timestamp()
            WHERE
            number IN ('".$up."', '".$down."')
            AND (SELECT * FROM (
                SELECT COUNT(*) FROM announce_pages WHERE number IN ('".$up."', '".$down."')) s )=2")
         ] );
        return response()->json([
            'status' => 200,
        ]);
    }


    public function downPin()
    {
        $down = request('number')-1;
        $up = $down+1;
        DB::table('announce_pages')->update( [
            'pin' => DB::raw("CASE WHEN announce_pages.pin='".request('number')."'
            THEN '".$down."'
            ELSE '".$up."' END
            , log_status='e', date_time_ex=current_timestamp()
            WHERE
            pin IN ('".$down."', '".$up."')
            AND (SELECT * FROM (
                SELECT COUNT(*) FROM announce_pages WHERE pin IN ('".$down."', '".$up."')) s )=2")
         ] );
        return response()->json([
            'status' => 200,
        ]);
    }

    public function updateDown()
    {
        $down = request('number')+1;
        $up = $down-1;
        DB::table('announce_pages')->update( [
            'number' => DB::raw("CASE WHEN announce_pages.number='".request('number')."'
            THEN '".$down."'
            ELSE '".$up."' END
            , log_status='e', date_time_ex=current_timestamp()
            WHERE
            number IN ('".$down."', '".$up."')
            AND (SELECT * FROM (
                SELECT COUNT(*) FROM announce_pages WHERE number IN ('".$down."', '".$up."')) s )=2")
         ] );
        return response()->json([
            'status' => 200,
        ]);
    }

 

    public function checkPinBox()
    {
        //get number with current id
        $number_old = Announcement::whereIdAndStatus(request('id'), 1)->orderBy('number')->pluck('number')->first();
        $query_numbers = Announcement::whereStatus(1)->where('number', '!=',"")->orderBy('number')->get();
        foreach($query_numbers as $query_num){
            if($number_old == $query_num->number){
                Announcement::whereId(request('id'))->update([
                    'pin' => $this->get_up_number_pin(),
                    'number' => 0,
                    'log_status' => 'e',
                    'date_time_ex' => \Carbon\Carbon::now()
                ]);
            }else if($number_old < $query_num->number){
                $number_s = $query_num->number - 1;
                Announcement::whereId( $query_num->id)->update([
                    'number' =>  $number_s,
                    'log_status' => 'e',
                    'date_time_ex' => \Carbon\Carbon::now()
                ]);
            }
        }
        return response()->json([
            'status' => 200,
        ]);
    }

    public function dropPin()
    {
       $old_pin = Announcement::whereIdAndStatus(request('id'), 1)->orderByDesc('pin')->pluck('pin')->first();
       $query_pins = Announcement::whereStatus(1)->where('pin', '!=', "")->orderBy('pin')->get();
       
        foreach($query_pins as $pins){
            if($old_pin == $pins->pin){
                Announcement::whereId(request('id'))->update([
                    'pin' => 0,
                    'log_status' => 'e',
                    'date_time_ex' => \Carbon\Carbon::now()
                ]);
            } elseif($old_pin < $pins->pin){
                    $pin_down = $pins->pin - 1;
                    Announcement::whereId($pins->id)->update([
                        'pin' => $pin_down,
                        'log_status' => 'e',
                        'date_time_ex' => \Carbon\Carbon::now()
                    ]);
            }
        }
       $query_numbers = Announcement::whereStatus(1)->where('number', '!=', '')->orderBy('number')->get();
       foreach($query_numbers as $query_num){
        $num_id = $query_num->id;
        $number = $query_num->number;
        $number_s = $number + 1;
        Announcement::whereId($num_id)->update([
            'number' => $number_s,
            'log_status' => 'e',
            'date_time_ex' => \Carbon\Carbon::now()
        ]);
       }
      
        Announcement::whereId(request('id'))->update([
            'number' => 1,
            'log_status' => 'e',
            'date_time_ex' => \Carbon\Carbon::now()
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function orderByNumber()
    {
        $numOrder = Announcement::whereStatus(1)->where('number','<>', 0)->orderBy('number')->get();
        foreach($numOrder as $pin){
            Announcement::whereId($pin->id)->update([
                'number' => $pin->number + 1
            ]);
        }
    }
    public function get_up_number_pin()
    {
        $latest_pin = Announcement::whereStatus(1)->where('pin','!=', '')->orderByDesc('pin')->pluck('pin')->first();
        if($latest_pin != 0){
            $pin_number = $latest_pin + 1;
        } else {
            $pin_number = 1;
        }
        return  $pin_number;
          
    }
}
