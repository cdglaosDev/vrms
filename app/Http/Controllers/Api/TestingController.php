<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testing;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TestingCollection;
use App\Http\Resources\TestingResource;
use Carbon\Traits\Test;

class TestingController extends Controller
{
    public function index()
    {
        $testing = Testing::paginate(10);

        return new TestingCollection($testing);
    }

    public function store(Request $request)
    {
      
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $testing = Testing::create($data);

        return response([ 'data' => new TestingResource($testing), 'message' => 'Created successfully'], 200);
    }
    public function show(Testing $testing)
    {
       return new TestingResource($testing);
    }

    public function update(Request $request, Testing $testing)
    {

        $testing->update($request->all());

        return response([ 'data' => new TestingResource($testing), 'message' => 'update successfully'], 200);
    }

    public function destroy(Testing $testing)
    {
        $testing->delete();

        return response(['message' => 'Deleted']);
    }
}
