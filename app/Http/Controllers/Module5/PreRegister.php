<?php
namespace App\Http\Controllers\Module5;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\PreRegisterApp;
class PreRegister extends Controller
{
    public function updatePreApp(Request $request, $id)
    {
        $pre_app = PreRegisterApp::find($id);
        $pre_app->update($request->all());
        return back()->with('success', 'Update Pre Register form successful.');
    }

    //print appform when approved

    public function printAppForm($app_number)
    {
        $data = \App\Model\AppForm::whereAppNo($app_number)->first();
       
        return view('Module5.importvehicle.print', compact('data'));
    }
}
