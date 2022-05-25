<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LogTable;
use Maatwebsite\Excel\Concerns\ToArray;

class ActionLogController extends Controller
{
    public function index()
    {
        $action_log = LogTable::orderByDesc('date')->get();
        // $detail = str_replace(",","\n", str_replace(array('{','}','"'),'',$action_log[0] -> action_detail));
        // dd($detail);
        //$detail = str_replace(array('{','}','"'),'',$action_log -> action_detail);
        return view('ActionLog.index', compact('action_log'));
    }

    public function show(LogTable $action_log)
    {
        $detail = str_replace(array('{','}','"'),'',$action_log -> action_detail);
        return view('ActionLog.view', compact('action_log', 'detail'));
    }
}
