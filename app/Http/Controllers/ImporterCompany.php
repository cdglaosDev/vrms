<?php

namespace App\Http\Controllers;
use App\Model\Company;
use App\Model\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\Controller;

class ImporterCompany extends Controller
{
    public function index()
    {
        $importercompany = Company::all();
        return view('Importer.Company.index',compact('importercompany'));
    }

    public function create()
    {
        $importercompany = Company::all();
        $importer_country = Country::all();
        return view('Importer.Company.create',compact('importercompany','importer_country'));
    }

    public function store()
    {
        $data = request() -> validate([
                    'contact_name' => 'required',
                    'contact_name_en' => 'required',
                    'contact_phone' => 'required|numeric',
                    'name' => 'required',
                    'name_en' => 'required',
                    'code' => 'required|unique:companies',
                    'tax_number' => 'required',
                    'country_id' => 'required',
                    'address' => 'required',
                    'phone' => 'required|numeric',
                    'fax' => '',
                    'email' => 'required|email',
                ]);

        $id = auth()->user()->id;
        $importercompany = new Company();
        $importercompany -> contact_name = request('contact_name');
        $importercompany -> contact_name_en = request('contact_name_en');
        $importercompany -> contact_phone = request('contact_phone');
        $importercompany -> name = request('name');
        $importercompany -> name_en = request('name_en');
        $importercompany -> code = request('code');
        $importercompany -> tax_number = request('tax_number');
        $importercompany -> country_id = request('country_id');
        $importercompany -> address = request('address');
        $importercompany -> phone = request('phone');
        $importercompany -> fax = request('fax');
        $importercompany -> email = request('email');
        $importercompany -> user_id = $id;
        $importercompany -> save();

        return redirect('import-company')->with('success',"Successfully Created");
    }

    public function show(Company $import_company)
    {
        return view('Importer.Company.show',compact('import_company'));
    }

    public function edit(Company $import_company)
    {
        $importer_country = Country::all();
        return view('Importer.Company.edit',compact('import_company','importer_country'));
    }

    public function update(Company $import_company)
    {
        $import_company -> update($this -> validateRequest());
        return redirect('import-company')->with('success',"Successfully Updated");
    }

    public function destroy(Company $import_company)
    {
        //dd($priceitem);
        $import_company -> delete();
        return redirect('import-company')->with('success',"Successfully Deleted");
    }

    private function validateRequest(){
        return request() -> validate([
            'contact_name' => 'required',
            'contact_name_en' => 'required',
            'contact_phone' => 'required|numeric',
            'name' => 'required',
            'name_en' => 'required',
            'code' => '',
            'tax_number' => 'required',
            'country_id' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'fax' => '',
            'email' => 'required|email',
        ]);
    }
}
