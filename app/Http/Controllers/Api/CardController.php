<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Http\Resources\CardCollection;
use App\Http\Resources\CardResource;
use App\Model\Vehicle;
use App\Model\Card;
use App\Http\Resources\ReadDataResource;
class CardController extends Controller
{
    //get vehicle info by licence_no and division_no
    public function getVehicleInfo(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
            $vehicle = Vehicle::whereDivisionNoAndLicenceNo($request->division_no,$request->license_no)->get();
            
            return new CardCollection($vehicle);
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }

    //read card data from card table
    public function readCard(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
             return ReadDataResource::collection(Card::where('card_no', $request->card_no)->get());
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }

    //write card data
    public function writeCard(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
            $all_card_no = Card::whereStatus('active')->pluck('card_no')->toArray();
            if (!in_array($request->card_no, $all_card_no)) {
                $request['status'] = 'active';
                $card = Card::create($request->all());
                return new ReadDataResource($card);
            } else {
                return response()->json(['message' => 'Your card already writed.'], 200);
            }
           
        } else {
           return response()->json(['message' => 'UnAuthorised'], 401);
       }
    }

    //terminate card
    public function terminateCard(Request $request)
    {
        if ($request->access_token == Helper::accessToken()) {
            $card = Card::whereCardNo($request->card_no)->pluck('status')->first();
            if ($card != 'terminate') {
                Card::whereCardNo($request->card_no)->update(['status'=>$request->status]);
                return response()->json([
                    'message' => 'Successful Terminated.'
                ]);
            } else {
                return response()->json([
                    'message' => 'Your card is already terminated.'
                ]);
            }
        } else {
                return response()->json(['message' => 'UnAuthorised'], 401);
       }
    }
    // get smartcard security code
    public function getCode()
    {
        if (request()->access_token == Helper::accessToken()) {
            $code = \App\Model\SmartCardSetting::select('code', 'security_pin')->first();
            return response()->json([
                    'data' => $code
                ], 200);
        } else {
            return response()->json(['message' => 'UnAuthorised'], 401);
        }
    }

}
