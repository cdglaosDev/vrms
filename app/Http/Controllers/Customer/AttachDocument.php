<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AppDocument;
use Illuminate\Support\Facades\File;
use DB;
class AttachDocument extends Controller
{
    protected $doc_folder;
    public function __construct(){
        $this->doc_folder = new \App\Library\DocFilename();
    }
    
    //store document file from excel import attach file, edit and detail page
    public function attchDocument(Request $request, $id)
    {  
        
         if ( empty($request->file()) && $request['2'] == null && $request['3'] == null && $request['4'] == null && 
                $request['5'] == null && $request['6'] == null && $request['7'] == null && $request['8'] == null) {
            return back()->with('error','At least one file choose.');
         } else {
            // $this->validate($request, [
            //     '2' => 'mimes:pdf,jpeg,png',
            //     '3' => 'mimes:pdf,jpeg,png',
            //     '4' => 'mimes:pdf,jpeg,png',
            //     '5' => 'mimes:pdf,jpeg,png',
            //     '6' => 'mimes:pdf,jpeg,png',
            //     '7' => 'mimes:pdf,jpeg,png',
            //     '8' => 'mimes:pdf,jpeg,png'
            // ],[
            //     '2.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '3.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '4.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '5.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '6.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '7.mimes' => 'Only pdf,jpeg and png images are allowed.',
            //     '8.mimes' => 'Only pdf,jpeg and png images are allowed.'
            // ]);
          
            $doc = AppDocument::whereVehicleDetailId($id)->get();
            if (!$doc->isEmpty()) {
                foreach($request->doc_type_id as $doc_type_id => $value) { 
                        $app_doc = AppDocument::whereVehicleDetailIdAndDocTypeId($id, $value)->first();
                        if( $request[$value] == 0){
                            $path = public_path().'/images/doc/'. $this->doc_folder->getDocFolder($id).'/'. $app_doc->filename;
                            File::delete($path); //remove old file from public folder
                            DB::table('app_documents')->whereVehicleDetailIdAndDocTypeId($id, $value)->update(['filename' => null]);
                       } else if( $request[$value] == 1){
                            DB::table('app_documents')->whereVehicleDetailIdAndDocTypeId($id, $value)->update(['filename' => $app_doc->filename]);
                        } else {
                            $filename = $this->unique_filename($request->file($value),  $value, $id);
                            AppDocument::whereVehicleDetailIdAndDocTypeId($id, $value)->update(['filename' => $filename]);
                        }
                       
                }
              
            } else {
                foreach ($request->doc_type_id as $doc_type_id => $value) { 
                    $appdoc = array(
                        'vehicle_detail_id' => $id,
                        'doc_type_id' => $value,
                        'filename'=>$this->unique_filename($request->file($value), $value, $id)
                    );
                    AppDocument::insert($appdoc);
                }
            }
            return back()->with('success', 'Successful uploaded document file.');
         }  
    }

     //attach document in new modal form
     public function addNewDoc(Request $request)
     {   
          if ( empty($request->file())) {
            return redirect('/customer/vehicle-detail')->with('error','No file choosing.');
          } else {
             $this->validate($request, [
                 '2' => 'mimes:pdf,jpeg,png',
                 '3' => 'mimes:pdf,jpeg,png',
                 '4' => 'mimes:pdf,jpeg,png',
                 '5' => 'mimes:pdf,jpeg,png',
                 '6' => 'mimes:pdf,jpeg,png',
                 '7' => 'mimes:pdf,jpeg,png',
                 '8' => 'mimes:pdf,jpeg,png'
             ],[
                 '2.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '3.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '4.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '5.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '6.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '7.mimes' => 'Only pdf,jpeg and png images are allowed.',
                 '8.mimes' => 'Only pdf,jpeg and png images are allowed.'
             ]);
        
                 foreach ($request->doc_type_id as $doc_type_id => $value) { 
                     $appdoc = array(
                         'vehicle_detail_id' => request('vehicle_id'),
                         'doc_type_id' => $value,
                         'filename'=>$this->unique_filename($request->file($value), $value, request('vehicle_id'))
                     );
                     AppDocument::insert($appdoc);
                 }
                 return response()->json([
                    'msg' => "Successful uploaded document file."
                 ]);
           
          }  
     }
 
     public function unique_filename($filename, $value, $id)
     {   
        
         $file = $filename;
         if ($file != null) {
             //generate filename same as doc type
             $name = $this->doc_folder->DocFile($file, $value);
             $file->move(public_path().'/images/doc/'.$this->doc_folder->getDocFolder($id).'/', $name);  
             $filename = $name;
         } else {
             $filename = null;
         }
         return $filename; 
     }
   

    //update document file from vehicle import detail and edit   page
    public function updateDocument(Request $request)
    {
        $this->validate($request, [
            'filename' => 'mimes:pdf,jpeg,png',
        ],[
            'filename.mimes' => 'Only pdf,jpeg and png images are allowed.',
        ]);
       $app_doc = AppDocument::whereVehicleDetailIdAndDocTypeId($request->vehicle_detail_id, $request->doc_type_id)->first();
       if ($request->hasfile('filename')) {
                $file = $request->file('filename');
                $name = $this->doc_folder->DocFile($file, $request->doc_type_id);
                $file->move(public_path().'/images/doc/'.$this->doc_folder->getDocFolder($request->vehicle_detail_id).'/', $name); 
             
               $filename = $name;  
        }
        $app_doc->filename = $filename;
        $app_doc->save();
        return back()->with('success', 'Successful updated document file');
    }
    
   //show attach document modal after import excel page
   public function attachDocumentModal($id)
   {
        $data = AppDocument::DocData($id);
        $data['id'] = $id;
        return view('customer.ExcelImport.attachDocument', $data);
      
   }
}
