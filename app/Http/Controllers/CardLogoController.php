<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\CardLogo;
use App\Helpers\Helper;
use App\Models\Social;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
class CardLogoController extends Controller
{
    
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
        
         return view('Card-Logo.index',compact('cardlogo'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        return view('Card-Logo.indax',$data);
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
          $input = $request->all();
       
          if($files=$request->file('image')){
            $name=uniqid().'_'.$files->getClientOriginalName();
           
            $dest =public_path('images');
             
            $files->move($dest,$name);
           $input['logo'] =$name;
          
        }
        
        $user = User::find($id); 
         $user->update($input);
          return redirect('smart-card-logo')->with('success','Successful Smart Card Logo Update Update.'); 
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
   
    }
     public function updateLogo(Request $request)
    {
        $this->validate($request, [
           
            'favicon' => 'mimes:png',
            'freeloader' => 'mimes:gif'
        ]);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = 'logo1.png';
            $location = 'images/' . $filename;
            Image::make($image)->save($location);
        }
      
        $notification = array('message' => 'Update Successfully', 'alert-type' => 'success');
        return back()->with($notification);
    }
}
