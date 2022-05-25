<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Carbon\Carbon;
use Hash;
use Auth;
use Notification;
use App\User;
use Charts;
use DB;
use App\Model\CardLogo;
use App\Notifications\ImportAppNotification;
class HomeController extends Controller
{
    function __construct()
    {   
         
        $this->middleware('permission:Vehicle-Api-Guide', ['only' => ['apiGuide']]);
        $this->middleware('permission:Smart-Card-Api-Guide', ['only' => ['smartcardGuide']]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
    {
        $data['month'] = array('Jan', 'Feb', 'Mar', 'Apr', 'May','June',"July",'Aug');
        $data['data'] = User::select('id', 'created_at')->whereUserType('staff')->get()->groupBy(function($val) {
        return Carbon::parse($val->created_at)->format('M');});
        $data['latest_app'] = \App\Model\PreRegisterApp::where('user_id',auth()->user()->id)->orderByDesc('created_at')->limit(5)->get();
        $data['latest_reg_vehicle'] = \App\Model\Vehicle::whereProvinceCode(auth()->user()->user_info->province_code)->orderByDesc('created_at')->limit(5)->get();
        $data['latest_user'] = \App\User::orderByDesc('created_at')->limit(5)->get();
        return view('home',$data);
    }

    public function customer(){
        return view('customer.dashboard');
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

     public function newPassBystaff($id)
     {
        $data = \App\User::find($id);
        return view('users.create-password',compact('data'));
    }
    public function saveNewPassBystaff(Request $request,$id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $user = \App\User::find($id);
        $user->password = Hash::make($request['password']);
        
        $user->save();
        Auth::login($user);
        return redirect('/home')->with('success',"Successful Login!");
    }

    public function sendNotification()
    {
        $user = User::first();
       
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => 101
        ];
        
        
        Notification::send($user, new ImportAppNotification($details));
   
        dd('done');
    }

    public function chart()
    {
        $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');
        $data  = array(1, 2, 3, 4, 5);
        return view('chart',['Months' => $month, 'Data' => $data]);

    }

    //api user guide
    public function apiGuide(){
        return view("UserGuide.api-guide");
    }

    //smart card user guide
    public function smartcardGuide()
    {
        return view("UserGuide.smart-card-api-guide");
    }
    public function smartcard()
    {
        $cardlogo =App\Model\CardLogo::orderByDesc('created_at')->get();
        return view('Card-Logo.index',compact('cardlogo'));
    }  

    public function userLogin()
    {
        // create our user data for the authentication
    $userdata = array(
        'email'     => request('email'),
        'password'  => request('password')
    );
   
    // attempt to do the login
    if (auth()->attempt($userdata)) {

        // validation successful!
        // redirect them to the secure section or whatever
        // return Redirect::to('secure');
        // for now we'll just echo success (even though echoing in a controller is bad)
        return redirect()->to('home');

    } else {        

        // validation not successful, send back to form 
        return redirect()->to('/');

    }
    }

    public function homePage()
    {
        return view('vrms2.home');
    }

    public function retrieveData()
    {
        $data['vehKinds'] = \App\Model\VehicleKind::pluck('name');
        $data['provinces'] = \App\Model\Province::pluck('name');
        $data['districts'] = \App\Model\District::pluck('name');
        $data['vehType'] = \App\Model\VehicleType::pluck('name');
        $data['brands'] = \App\Model\VehicleBrand::pluck('name');
        $data['models'] = \App\Model\VehicleModel::pluck('name');
        $data['colors'] = \App\Model\Color::pluck('name');
        $data['steerings'] = \App\Model\Steering::pluck('name');
        $data['engine_brands'] = \App\Model\EngineBrand::pluck('name');
        $data['engine_types'] = \App\Model\EngineType::pluck('name');
        return view('retrieve-mod3', $data);
    }

   
}
