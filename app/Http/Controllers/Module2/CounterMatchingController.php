<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CounterMatching;
use App\Helpers\Helper;
class CounterMatchingController extends Controller
{
    function __construct()
    {   
        $this->middleware('permission:Service-Counter-Matching-All|Service-Counter-Matching-List-View|Service-Counter-Matching-Create|Service-Counter-Matching-Edit|Service-Counter-Matching-Delete');
        $this->middleware('permission:Service-Counter-Matching-List-View');
        $this->middleware('permission:Service-Counter-Matching-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Service-Counter-Matching-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Service-Counter-Matching-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
       
        if (auth()->user()->user_level == "admin") {
            $counter = CounterMatching::with('service_counter')->get()->sortBy('service_counter.name_en');
        } else{
            $counter = CounterMatching::whereProvinceCode(Helper::current_province())->with('service_counter')->get()->sortBy('service_counter.name_en');
        }
      
        return view('module2.CounterMatch.index', compact('counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['counters'] = \App\Model\ServiceCounter::whereStatus(1)->get();
        if (auth()->user()->user_level == "admin") {
            $data['provinces'] = \App\Model\Province::whereStatus(1)->get();
            $data['users'] =  \App\User::whereUserTypeAndCustomerStatus('staff', 'approve')->get();
        }  else {
            $data['provinces'] = \App\Model\Province::whereStatus(1)->whereProvinceCode(Helper::current_province())->get();
            $data['users'] =  \App\User::whereHas('user_info', function($query) {
                $query->where('province_code', Helper::current_province());
                })->whereUserTypeAndCustomerStatus('staff', 'approve')->get();
        }
        
        return view('module2.CounterMatch.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $counter_match = CounterMatching::whereProvinceCode(request('province_code'))->pluck('service_counter_id')->toArray();
        if (in_array(request('service_counter_id'), $counter_match)) {
        return back()->with('error', 'This counter already assigned.');
        }
        $this->validate($request, [
            'service_counter_id' => 'required',
            'province_code' => 'required',
            'staff_id' => 'required',
            'start_bill_no' => 'required'    
        ]);
        CounterMatching::create($request->all());
        return redirect('/counter-matching')->with('success','Successful created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $counter =  CounterMatching::find($id);
        if (auth()->user()->user_level == "admin") {
            $provinces = \App\Model\Province::whereStatus(1)->get();
            $users = \App\User::userLists($counter->province_code);
            $scounters = \App\Model\ServiceCounter::whereProvinceCodeAndStatus($counter->province_code, 1)->get();
        }  else {
            $provinces = \App\Model\Province::whereStatus(1)->whereProvinceCode(Helper::current_province())->get();
            $users = \App\User::userLists(Helper::current_province());
            $scounters = \App\Model\ServiceCounter::whereProvinceCodeAndStatus(\App\Helpers\Helper::current_province(), 1)->get();
        }
    
        return view('module2.CounterMatch.editCounter', compact('provinces', 'users', 'scounters', 'counter'));
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
        $this->validate($request, [
            'staff_id' => 'required', 
            'start_bill_no' => 'required'  
        ]);
        $data = CounterMatching::find($id);
        $data->update($request->only('province_code', 'staff_id', 'start_bill_no', 'bill_no_present'));
        return redirect('counter-matching')->with('success','Successful updated.');
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CounterMatching::destroy($id);
        return back()->with('success','Successful deleted.');
    }
}
