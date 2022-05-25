@extends('layouts.master')
@section('dashboard','active')
@section('title','Dashboard')
@section('content')
<div class="row mt-3">
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
                <div class="card-body">
                  <h6 class="font-weight-normal">Total Staffs</h6>
                  <h2 class="mb-0">{{\App\User::whereUserType('staff')->count()}}</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
                <div class="card-body">
                  <h6 class="font-weight-normal">Total Customers</h6>
                  <h2 class="mb-0">{{\App\User::whereUserType('customer')->count()}}</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
                <div class="card-body">
                  <h6 class="font-weight-normal">Vehicle Passports</h6>
                  <h2 class="mb-0">{{\App\Model\ITPRS::count()}}</h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-gradient-info text-white text-center card-shadow-info">
                <div class="card-body">
                  <h6 class="font-weight-normal">Vehicle Imports</h6>
                  <h2 class="mb-0">{{\App\Model\AppForm::whereStatus(1)->count()}}</h2>
                </div>
              </div>
            </div>
		  </div>
		  
		  <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-8">
                      <p class="card-title">Import Vehicles List</p>
                    </div>
                    <div class="col-lg-4">
                      <a class="nav-link" href="{{url('/import-vehicle')}}">
                      <span class="badge badge-outline-info badge-pill float-right"> View all </span>
                      </a>
                    </div>
                  </div>
                  <div class="table-responsive">    
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Pre AppNo.</th> 
                            <th>Status</th>
                            <th>{{trans('customer.action')}}</th>  
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_app as $item)
                                <tr>
                                    <td>{{$item->regapp_number??''}}</td>
                                    @if($item->app_status_id ==4)
                                    <td><label class="badge badge-success">Approved</label></td>
                                    @elseif($item->app_status_id ==5)
                                    <td><label class="badge badge-danger">Rejected</label></td>
                                    @elseif($item->app_status_id == 3)
                                    <td><label class="badge badge-warning">In progress</label></td>
                                    @elseif($item->app_status_id == 6)
                                    <td><label class="badge badge-primary">Draft</label></td>
                                    @elseif($item->app_status_id == 1)
                                    <td><label class="badge badge-info">Complete</label></td>
                                    @elseif($item->app_status_id == 2)
                                    <td><label class="badge badge-secondary">Cancel</label></td>
                                    @endif
                                    <td><a href="{{route('import-vehicle.show',['id'=>$item->vehicle_detail->id])}}" class="btn btn-sm btn-info {{$item['app_status_id'] ==5 ?'disabled':''}}"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              
              </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-8">
                      <p class="card-title">Register List of Vehicles</p>
                    </div>
                    <div class="col-lg-4">
                      <a class="nav-link" href="{{route('all-vehicles.index')}}">
                      <span class="badge badge-outline-info badge-pill float-right"> View all </span>
                      </a>
                    </div>
                  </div>
                  <div class="table-responsive">    
                    <table class="table">
                        <thead>
                          <tr>
                            <th>LicenceNo</th> 
                            <th>Owner</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_reg_vehicle as $reg_veh)
                                <tr>
                                    <td>{{$reg_veh->licence_no??''}}</td>
                                    <td>{{$reg_veh->owner_name??''}}</td>
                                    <td><a href="{{route('all-vehicles.edit',['id'=>$reg_veh->id])}}" class="btn btn-sm btn-info {{$reg_veh['app_status_id'] ==5 ?'disabled':''}}"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              
              </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-8">
                      <p class="card-title">Register List Of Users</p>
                    </div>
                  </div>
                  <div class="table-responsive">    
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th> 
                            <th>LoginID</th>
                            <th>UserType</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_user as $user)
                                <tr style="height:60px;">
                                    <td>{{$user->name??''}}</td>
                                    <td>{{$user->login_id}}</td>
                                    <td>{{$user->user_type??''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              
              </div>
            </div>
			
@endsection

