<?php

namespace App\Http\Controllers\Vrms2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vehicle;
class VehicleController extends Controller
{
    public function index()
    {
        $data = \App\Helpers\getData::vehInfo();
        $vehicles = Vehicle::skip(0)->take(20)->get();

        return view('vrms2.vehicle.all-vehicles', compact('vehicles', 'data'));
    }
}
