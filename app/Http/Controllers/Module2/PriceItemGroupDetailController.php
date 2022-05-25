<?php

namespace App\Http\Controllers\Module2;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\PriceItemGroupDetail;

class PriceItemGroupDetailController extends Controller
{
    public function index()
    {
        $price_detail = PriceItemGroupDetail::orderByDesc('created_at')->get();
        return view('module2.PriceItemGroup.group_detail', compact('price_detail'));
    }
}
