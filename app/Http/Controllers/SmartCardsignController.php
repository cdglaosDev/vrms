<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SmartCardSign;
use App\Model\CardLogo;
use DB;
use Hash;
use App\Helpers\Helper;
class SmartCardsignController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
         $data['cardsign'] = SmartCardSign::orderByDesc('created_at')->get();
         $data['province'] = \App\Model\Province::whereStatus(1)->get();
         return view('smart-card-sign.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    
    
    }
    public function store(Request $request)
    {
    
        $input = $request->all();
        if ($request->hasFile('sign_img')) {
            $image = $request->file('sign_img');
            $filename = 'sign.png';
            $location = 'images/sign' . $filename;
            Image::make($image)->save($location);
        }
        $input = SmartCardSign::create($input);
        return redirect('smart-card-sign')->with('success', 'Successful Smart Card Sign  Added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['card-logo'] =CardLogo::find($id);
        return view('Card-Logo.indax', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $data =SmartCardSign::find($id);
        \LogActivity::saveToLog($data, $tb_name = "smart-card-logos", $action = "delete");
        $data->delete();
        return redirect('smart-card-sign')->with('success', 'Successful Smart Card Sign Delete.'); 
    }
     
}
