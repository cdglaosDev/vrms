@php
$app_purpose = \App\Model\AppFormPurpose::whereAppFormId($app_id)->pluck('app_purpose_id')->toArray();
$inspect_places = \App\Model\InspectPlace::whereStatus(1)->get();
@endphp
<style>
  .col-sm-1, .col-sm-1{
    padding-left:0px;
    padding-right:0px;
    margin-bottom: 0px;
  }
  #vehInfo .col-sm-1,#vehInfo .col-sm-2{
    padding: 5px;
}
</style>
<h1 class="page-header">Create Staff</h1>
<div class="card">
    <div class="card-body pb-1">
<form  action="{{route('all-vehicles.update',[$vehicle->id])}}"  method="POST" id="updateVeh">
@method('Patch')
 @csrf
 <input type="hidden" value="{{ $vehicle->id }}" id="vehicle_id">
<input type="hidden" value="{{auth()->user()->user_status}}" id="user_status">
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Division No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Cylinder:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0">1.Import Permit:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">5.Tax:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Province No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">CC:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">HSNY:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax 10* 40</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">VdVC Serial:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Color:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Invest:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">TaxExam:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Issue Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Brand:</label>
    <div class="col-sm-2">
    <select name="brand_id" class="form-control js-example-basic-single" id="vbrand"  style="width: 100%;" >
      <option value="" selected disabled>Select Brand</option>
     
  </select>    
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax 12:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Expire Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Model:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax  50:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Pre License No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Engine No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">2.Industrial Doc:</label>
    <div class="col-sm-1">
      &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Purpose:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1">Chassis No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Name:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Width:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">6.Tax Payment:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Name2:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Long:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label  class="col-sm-2 px-0">3.TechnicalDoc:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax Receipt:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Village:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Height:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Tax Permit:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Unit:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> No. of Seats:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Province:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Wheels:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">4.Commerce Permit:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> District:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Weight:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Commerce Permit:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">7.Police Doc:</label>
    <div class="col-sm-1">
     &nbsp;
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Vehicle Type:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Weight Filled:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Steering:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Total Weight:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1"> Engine Type:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Axis:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Lock No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-2 px-0 ">8.Vehicle Remark:</label>
    <div class="col-sm-1">
      
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Log:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Year MNF:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">CompanyLock:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  
    <div class="col-sm-3">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Send:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Motor Brand:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">StartLock:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
   
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Inspect Result:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Inspect Issue Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">EndLock:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Telephone No.:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>

  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-1">Inspect Place:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm" placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1"> Inspect Expire Date:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Note1:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
    <label for="colFormLabelSm" class="col-sm-1 ">Note2:</label>
    <div class="col-sm-2">
      <input type="email" class="form-control form-control-sm"  placeholder="col-form-label-sm">
    </div>
  </div>
  <div class="form-row">
                            <div class="col-md-6 col-sm-6"> 
                                <a class="btn btn-secondary btn-sm"   href="{{url('/all-vehicles')}}" >Back </a>
                                <a class="btn btn-secondary book-print btn-sm {{$app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}}" >Book</a>
                                <a class="btn btn-secondary btn-sm  {{$app_form_status_id == 4 || $app_form_status_id == 5 || $app_form_status_id == 6?'':'disabled'}}" href="scard:{{$vehicle->licence_no}}|{{$vehicle->province->old_name}}|{{ $vehicle->vehicle_kind->name??''}}|{{$vehicle->vehicle_kind->vehicle_kind_code}}|{{ $vehicle->division_no}}|{{$vehicle->province_no}}|{{$vehicle->owner_name}}|{{$vehicle->engine_no}}|{{$vehicle->chassis_no}}|{{$vehicle->vtype->name??''}}|{{ $vehicle->vbrand->name ?? ''}}|{{$vehicle->vmodel->name ?? ''}}|{{$vehicle->color->name??''}}|{{$vehicle->issue_date}}|{{$vehicle->expire_date}}|{{$vehicle->district->name??''}}|{{$vehicle->village_name}}|{{$smart_card_code->code ?? ''}}|{{auth()->user()->name}}|{{$smart_card_code->security_pin ?? ''}}|{{$vehicle->id}}|{{auth()->id()}}|{{$vehicle->province->abb}}|{{$vehicle->province->abb_en}}">Card</a>
                                <a href="" class="btn btn-secondary btn-sm {{$app_form_status_id == 7?'':'disabled'}}"  data-toggle="modal" data-target="#transferModal"  data-id="">Transfer</a>
                                <a class="btn btn-secondary btn-sm " href="#" onclick="jQuery('#certificate').print()">Certificate</a>
                                <a class="btn btn-secondary btn-sm "   href="#" onclick="jQuery('#printPaper2').print()" >Pink1</a>
                                <a class="btn btn-secondary btn-sm "   href="#" onclick="jQuery('#Pink2').print()" >Pink2</a>
                                
                            </div>
                            <div class="col-md-4 col-sm-4">
                            @if($form_type == "veh_type")<a href="" class="btn btn-secondary btn-sm {{$app_form_status_id == 7?'':'disabled'}}"  data-toggle="modal" data-target="#PinkPaperNewForm"  data-id="">Pink Paper & New Form</a>  @endif
                            @if($form_type == "veh_type")<a class="btn btn-secondary btn-sm {{$app_form_status_id == 7?'':'disabled'}}"  data-toggle="modal" data-target="#NewForm"  data-id="" href="#">New  Form</a>@endif
                                
                            </div>
                          
                            <div class="col-md-2 col-sm-2" >  
                            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                            <button type="submit" class=" btn btn-success btn-sm">{{trans('button.save')}}</button>
                            <input type="hidden" name="app_id" value="{{ session('app_id')}}">
                            </div>
                        </div>
</form>
    </div>
</div>
                 
@include('Module4.Vehicle.TransferModal',['vehicle' => $vehicle]) 
@include('Module4.Vehicle.NewAppFormModal',['vehicle_id' => $vehicle->id]) 
@include('Module4.Vehicle.PinkpaperNewForm',['vehicle_id' => $vehicle->id]) 
@push('page_scripts')
<script>
 var dist_url="{{url('/getdistrict/')}}";
var get_vmodal="{{url('/getVmodel/')}}";
if($("#user_status").val() == "license_control"){
    $('#vehicle_kind, #inspect_place, #inspect_result, #division_no, #province_no, #serial,#show_issue_date, #show_expire_date, #inspect_issue_date, #inspect_expire_date, #lock_no, #company_lock,#startlock, #endlock').attr('disabled',true);
}else if($("#user_status").val() == "card_print"){
    $("#division_no, #province_no, #show_issue_date #show_expire_date #licence_no #vehicle_kind #owner_name #village_name #district #province #vehicle_type #color #vbrand #engine_no #chassis_no").prop('required',true);
    $('#inspect_place, #inspect_result, #inspect_issue_date, #inspect_expire_date, #lock_no, #company_lock,#startlock, #endlock').attr('disabled',true);  
}else if($("#user_status").val() == "book_print"){
    $('input[type="text"], input[type="number"],input[type="checkbox"],select').not('#inspect_issue_date,#inspect_expire_date,#inspect_place,#inspect_result').prop('disabled', true);
    
}else if($("#user_status").val() == "lock_vehicle"){
 
    $('input[type="text"], input[type="number"],input[type="checkbox"],select').not('#lock_no, #company_lock,#startlock, #endlock').prop('disabled', true);
     
}
</script>
<script src="{{ asset('js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
<script src="{{ asset('js/filevalidate.js') }}"></script>
@endpush


