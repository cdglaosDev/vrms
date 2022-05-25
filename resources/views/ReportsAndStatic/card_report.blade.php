@extends('vrms2.layouts.master')
@section('card_report','active') 
@section('content') 
@php $users = App\User::where('user_type',"!=",'customer')->get(); 
@endphp
@include('vrms2.report-submenu')
<h3>{{trans('title.print_card_report')}}</h3>
@include('flash')
<div class="card-body">
   <form action="{{url('/print-card-report')}}" method="POST">
      {{ csrf_field() }}
      <div class="row">
         <div class="form-group col-md-4">
            <label class="col-auto">{{ trans('common.username') }} :</label>
            <div class="col-auto">
               <select name="user_id" class="form-control js-example-basic-single" required="">
                  <option value="" selected disabled hidden>{{ trans('common.username') }}</option>
                  @foreach($users as $data)
                  <option value="{{$data-> id}}" {{ session()->get('user_id') == $data->id?'selected':'' }}><span>{{$data->name}}</span></option> 
                  @endforeach 
               </select>
            </div>
         </div>
         <div class="form-group col-md-4">
            <label class="col-auto">{{ trans('common.date') }} :</label>
            <div class="col-auto">
               <input type="text" class="form-control date" format="dd-mm-yyyy" name="date" value="{{ session()->get('date') }}" placeholder="Choose Date" required=""> 
            </div>
         </div>
         <div class="form-group col-md-4">
            <label class="col-auto">&nbsp;</label>
            <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm" name="type">{{ trans('finicialreports.search') }}</button>
               <button type="submit" class="btn btn-success btn-sm" name="type" value="excel">ExportExcel</button>
            </div>
         </div>
      </div>
   </form>
   <br/>
   <table id="table" class="table table-striped">
      <thead>
         <tr>
            <th>#</th>
            <th>{{trans('module4.division_number')}}</th>
            <th>{{trans('module4.province_number')}}</th>
            <th>{{trans('module4.owner_name')}}</th>
            <th>{{trans('module4.village')}}</th>
            <th>{{trans('module4.license_no')}}</th>
            <th>{{trans('module4.vehicle_type')}}</th>
            <th>{{trans('module4.purpose')}}</th>
            <th>{{trans('module4.brand')}}</th>
            <th>{{trans('module4.model')}}</th>
            <th>{{trans('module4.print')}}</th>
            <th>{{trans('module4.remark')}}</th>
            <th>eCode</th>
            <th>{{ trans('module4.print_name') }}</th>
            <th>{{trans('module4.forerunner')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($card_print as $key=>$data)
            <tr>
               <td>{{  ++$key }}</td>
               <td>{{  $data->division_no }}</td>
               <td>{{  $data->province_no }}</td>
               <td>{{  $data->owner_name }}</td>
               <td>{{  $data->village_name }}</td>
               <td>{{  $data->licence_no }}</td>
               <td>{{  $data->vtype_name }}</td>
               <td>{{  $data->vkind_name }}</td>
               <td>{{  $data->brand_name }}</td>
               <td>{{  $data->model_name }}</td>
               <td>{{ $data->print_count }}</td>
               <td>{{  $data->remark }}</td>
               <td>&nbsp;</td>
               <td>{{  $data->first_name }} {{ $data->last_name }}</td>
               <td></td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection 