@extends('layouts.master') 
@section('register','active') 
@section('content') 
@php $kinds = \App\Model\VehicleKind::whereStatus(1)->get(); 
$brands = \App\Model\VehicleBrand::whereStatus(1)->get(); 
$types = \App\Model\VehicleType::whereStatus(1)->get(); 
$models = \App\Model\VehicleModel::whereStatus(1)->whereBrandId($data->make)->get(); 
$pros = \App\Model\Province::whereStatus(1)->get(); 
$eng_type = \App\Model\EngineBrand::whereStatus(1)->get(); 
$dists = \App\Model\District::whereStatus(1)->whereProvinceCode($data->province)->get(); 
$color =\App\Model\Color::whereStatus(1)->get(); 
$veh_purpose_yellow = \App\Model\VehiclePurpose::whereType('y')->pluck('id','name_en'); 
$veh_purpose_green = \App\Model\VehiclePurpose::whereType('g')->pluck('id','name_en'); 
$veh_purpose_pink = \App\Model\VehiclePurpose::whereType('p')->pluck('id','name_en'); 
@endphp
<h1 class="page-header">{{trans('title.edit_reg')}}</h1>
<div class="card">
	<div class="card-body">
		<form class="needs-validation" method="POST" action="{{route('car-register.update',[$data->id])}}"> {{ csrf_field() }} @method('PATCH')
			<div class="card-body">
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.license_no')}}</label>
						<input type="text" class="form-control" id="validationCustom02" name="license_no" placeholder="Enter License No." value="{{$data->license_no !=null?$data->license_no:''}}">
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.name')}}(Lao)</label>
						<div class="input-group">
							<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Owner Name" value="{{$data->name !=null?$data->name:''}}" name="name" required="">
							<div class="invalid-feedback"> Please choose a username. </div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.name')}}(Eng)</label>
						<div class="input-group">
							<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Owner Name" value="{{$data->name_en !=null?$data->name_en:''}}" name="name_en" required="">
							<div class="invalid-feedback"> Please choose a username. </div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.telephone')}}</label>
						<div class="input-group">
							<input type="number" class="form-control" id="validationCustomUsername" placeholder="Enter Telephone" value="{{$data->telephone !=null?$data->telephone:''}}" name="telephone">
							<div class="invalid-feedback"> Please choose a username. </div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 col-sm-3 mb-2">
						<label>{{trans('register.veh_purpose')}}</label>
						<div class="input-group">
						<select id="vehicle-purpose" name="vehicle_purpose_id" class="form-control js-example-basic-single" style="width: 100%;" data-size="20" required="">
							<option value="" selected disabled>Select Vehicle Purpose</option>
							<optgroup class="pl-3" label="Yellow Book"> @foreach($veh_purpose_yellow as $key=>$value)
								<option value="{{ $value }}" {{ $data->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach </optgroup>
							<optgroup class="pl-3" label="Green Book"> @foreach($veh_purpose_green as $key=>$value)
								<option value="{{ $value }}" {{ $data->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach </optgroup>
							<optgroup class="pl-3" label="Pink Book"> @foreach($veh_purpose_pink as $key=>$value)
								<option value="{{ $value }}" {{ $data->vehicle_purpose_id == $value?'selected':''}}>{{ $key}}</option> @endforeach </optgroup>
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.vehicletype')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single" style="width: 100%;"  name="vehicletype" required="">
							<option value="" selected disabled>--Select Vehicle Type--</option> @foreach($types as $type)
							<option value="{{$type->id}}" @if($data->vehicletype == $type->id) selected="selected" @endif>{{ $type->name }}({{$type->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.make')}}</label>
						<div class="input-group">
							<select class="form-control js-example-basic-single" style="width: 100%;"  name="make" id="vbrand" required="">
								<option value="" selected disabled>--Select Vehicle Brand--</option> @foreach($brands as $brand)
								<option value="{{$brand->id}}" @if($data->make == $brand->id) selected="selected" @endif>{{ $brand->name }}({{$brand->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.model')}}</label>
						<div class="input-group">
							<select class="form-control js-example-basic-single" style="width: 100%;" name="model" id="vmodel" required="">
								<option value="" selected disabled>--Select Vehicle Model--</option>
								 @foreach($models as $model)
								<option value="{{$model->id}}" @if($data->model == $model->id) selected="selected" @endif>{{ $model->name }}({{$model->name_en}})</option> @endforeach </select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom01">{{ trans('register.color')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single" style="width: 100%;"  name="color">
							<option value="" disabled>--Select Color--</option> @foreach($color as $co)
							<option value="{{$co->id}}" {{$data->color==$co->id?"Selected":''}}>{{ $co->name }}&nbsp;({{$co->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.motor_make')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single" style="width: 100%;" name="motor_make" required>
							<option value="" selected disabled>--Select Engine Brand--</option> @foreach($eng_type as $engine)
							<option value="{{$engine->id}}" @if($data->motor_make == $engine->id) selected="selected" @endif>{{ $engine->name }}&nbsp;({{$engine->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.engine_no')}}</label>
						<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Engine No" value="{{$data->engine_no !=null?$data->engine_no:''}}" name="engine_no"> </div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.chassis_no')}}</label>
						<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Chaasis no." value="{{$data->chassis_no !=null?$data->chassis_no:''}}" name="chassis_no">
						<div class="invalid-feedback"> Please choose a username. </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom01">{{ trans('register.width')}}</label>
						<input type="number" class="form-control" id="validationCustom01" name="width" placeholder="Enter Width" value="{{$data->width !=null?$data->width:''}}">
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.height')}}</label>
						<input type="number" class="form-control" id="validationCustom02" name="height" placeholder="Enter Height" value="{{$data->height !=null?$data->height:''}}">
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.length')}}</label>
						<input type="number" class="form-control" id="validationCustomUsername" placeholder="Enter Length" value="{{$data->length !=null?$data->length:''}}" name="length">
						<div class="invalid-feedback"> Please choose a username. </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.seats')}}</label>
						<input type="number" class="form-control" id="validationCustomUsername" placeholder="Number of Seats" name="seats" value="{{$data->seats !=null?$data->seats:''}}">
						<div class="invalid-feedback"> Please choose a username. </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom01">{{ trans('register.weight_empty')}}</label>
						<input type="text" class="form-control" id="validationCustom01" name="weight_empty" placeholder="Net weight" value="{{$data->weight_empty != null?$data->weight_empty:''}}">
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.swheel')}}</label>
						<div class="input-group">
						<select name="swheel" class="form-control js-example-basic-single" style="width: 100%;" required>
							<option value="" selected disabled>--Select Steering--</option>
							<option value="left" @if($data->swheel == "left") selected="selected" @endif>Left</option>
							<option value="right" @if($data->swheel == "right") selected="selected" @endif>Right</option>
						</select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.cylinder')}}</label>
						<div class="input-group">
							<input type="text" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="Number of Cylinder" value="{{$data->cylinder !=null?$data->cylinder:''}}" aria-describedby="inputGroupPrepend"> </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.unit')}}</label>
						<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Unit" name="unit" value="{{$data->unit !=null?$data->unit:''}}">
						<div class="invalid-feedback"> Please choose a username. </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom01">{{ trans('register.street')}}</label>
						<input type="text" class="form-control" id="validationCustom01" name="street" placeholder="Street" value="{{$data->street !=null?$data->street:''}}">
						<div class="valid-feedback"> Looks good! </div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.province')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single"  style="width: 100%;" id="province" name="province" required readonly>
							<option value="" disabled>--Select Province--</option> @foreach($pros as $pro)
							<option value="{{$pro->province_code}}" @if($data->province == $pro->province_code) selected="selected" @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.district')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single" style="width: 100%;" name="district" id="district" required>
							<option value="" disabled>--Select District--</option>
							 @if(isset($data->district)) @foreach($dists as $dis)
							<option value="{{$dis->district_code}}" @if($data->district == $dis->district_code) selected="selected" @endif>{{ $dis->name }}&nbsp;({{$dis->name_en}})</option> 
							@endforeach @else @endif
						 </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.village')}}</label>
						<input type="text" name="village" class="form-control" value="{{$data->village}}" placeholder="Enter Village Name"> </div>
				</div>
				<div class="form-row">
					<div class="col-md-3 mb-3">
						<label for="validationCustom01">{{ trans('register.issue_date')}}</label>
						<input type="text" class="form-control" id="validationCustom01" name="issue_date" placeholder="Date" value="{{ Carbon\Carbon::parse($data->issue_date)->format('d-m-Y') }}" required readonly=""> </div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.expire_date')}}</label>
						<input type="text" id="datetime" class=" form-control" id="datetime" name="expire_date" placeholder="Expire Date" value="{{ Carbon\Carbon::parse($data->expire_date)->format('d-m-Y') }}" required> </div>
					<div class="col-md-3 mb-3">
						<label for="validationCustomUsername">{{ trans('register.doneat')}}</label>
						<div class="input-group">
						<select class="form-control js-example-basic-single" style="width: 100%;"  name="doneat">
							<option value="" disabled>--Select Province--</option> @foreach($pros as $prov)
							<option value="{{$prov->province_code}}" {{$data->doneat==$prov->province_code?"Selected":''}}>{{ $prov->name }}&nbsp;({{$prov->name_en}})</option> @endforeach </select>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom02">{{ trans('register.fax')}}</label>
						<div class="input-group">
						<input type="text" class="form-control" id="validationCustom02" name="fax" placeholder="Fax" value="{{$data->fax !=null?$data->fax:''}}"> </div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3 col-sm-3">
					
							<label for="validationCustomUsername">{{ trans('register.cc')}}</label>
							<div class="input-group">
								<input type="text" class="form-control" id="validationCustomUsername" placeholder="CC" name="cc" value="{{$data->cc !=null?$data->cc:''}}"> </div>
					
					</div>
					<div class="col-md-3 col-sm-3">
						<label> {{trans('register.book_no_ref')}} </label>
						<input type="text" class="form-control" id="validationCustomUsername" placeholder="Enter Book Number Ref" name="book_no_ref" value="{{$data->book_no_ref}}"> </div>
					<div class="col-md-6 col-sm-6">
						<div class="col-md-8 mb-8">
							<label for="validationCustom01">{{trans('register.book_no')}} (format: 01-000001-2020)</label>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="validationCustom01">Province Code</label>
								<input type="text" name="pro_code" id="pro_code" value="{{$data->pro_code}}" class="form-control" readonly="" required=""> </div>
							<div class="col-sm-4">
								<label for="validationCustom01"> Code</label>
								<input type="text" name="code_no" id="book_code" class="form-control" value="{{$data->code_no}}" readonly=""> </div>
							<div class="col-sm-2">
								<label for="validationCustom01">Year</label>
								<input type="text" name="year" class="form-control" value="{{$data->year}}" readonly=""> </div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-12">
						<label for="validationCustom01">{{ trans('register.remark')}}</label>
						<textarea name="remark" rows="5" class="form-control">{{$data->remark !=null?$data->remark:''}}</textarea>
					</div>
				</div>
				<!-- hidden field -->
				<input type="hidden" id="division_no" class="form-control col-sm-7" name="division_no" placeholder="" value="{{$data->division_no}}" />
				<input type="hidden" id="province_no" class="form-control col-sm-7" name="province_no" placeholder="" value="{{$data->province_no}}" />
				<input type="hidden" id="lastname" class="form-control col-sm-7" name="lastname" placeholder="" value="{{$data->lastname}}" />
				<input type="hidden" id="driverseat" class="form-control col-sm-7" name="driverseat" placeholder="" value="{{$data->driverseat}}" />
				<input type="hidden" id="energy" class="form-control col-sm-7" name="energy" placeholder="" value="{{$data->energy}}" />
				<input type="hidden" id="weight_filled" class="form-control col-sm-7" name="weight_filled" placeholder="" value="{{$data->weight_filled}}" />
				<input type="hidden" id="weight_total" class="form-control col-sm-7" name="weight_total" placeholder="" value="{{$data->weight_total}}" />
				<input type="hidden" id="axis" class="form-control col-sm-7" name="axis" placeholder="" value="{{$data->axis}}" />
				<input type="hidden" id="wheels" class="form-control col-sm-7" name="wheels" placeholder="" value="{{$data->wheels}}" />
				<input type="hidden" id="year_manufactured" class="form-control col-sm-7" name="year_manufactured" placeholder="" value="{{$data->year_manufactured}}" />
				<input type="hidden" id="import_permit_no" class="form-control col-sm-7" name="import_permit_no" placeholder="" value="{{$data->import_permit_no}}" />
				<input type="hidden" id="import_permit_date" class="form-control col-sm-7" name="import_permit_date" value="{{$data->import_permit_date}}">
				<input type="hidden" id="industrial_doc_no" class="form-control col-sm-7" name="industrial_doc_no" placeholder="" value="{{$data->industrial_doc_no}}" />
				<input type="hidden" id="industrial_doc_date" class="form-control col-sm-7" name="industrial_doc_date" placeholder="" value="{{$data->industrial_doc_date}}" />
				<input type="hidden" id="technical_doc_no" class="form-control col-sm-7" name="technical_doc_no" placeholder="" value="{{$data->technical_doc_no}}" />
				<input type="hidden" id="technical_doc_date" class="form-control col-sm-7" name="technical_doc_date" placeholder="" value="{{$data->technical_doc_date}}" />
				<input type="hidden" id="commerce_permit" class="form-control col-sm-7" name="commerce_permit" placeholder="" value="{{$data->commerce_permit}}" />
				<input type="hidden" id="commerce_permit_no" class="form-control col-sm-7" name="commerce_permit_no" placeholder="" value="{{$data->commerce_permit_no}}" />
				<input type="hidden" id="commerce_permit_date" class="form-control col-sm-7" name="commerce_permit_date" placeholder="" value="{{$data->commerce_permit_date}}" />
				<input type="hidden" id="tax_no" class="form-control col-sm-7" name="tax_no" placeholder="" value="{{$data->tax_no}}" />
				<input type="hidden" id="tax_date" class="form-control col-sm-7" name="tax_date" placeholder="" value="{{$data->tax_date}}" />
				<input type="hidden" id="tax_payment_no" class="form-control col-sm-7" name="tax_payment_no" placeholder="" value="{{$data->tax_payment_no}}" />
				<input type="hidden" id="tax_payment_date" class="form-control col-sm-7" name="tax_payment_date" value="{{$data->tax_payment_date}}">
				<input type="hidden" id="police_doc_no" class="form-control col-sm-7" name="police_doc_no" placeholder="" value="{{$data->police_doc_no}}" />
				<input type="hidden" id="police_doc_date" class="form-control col-sm-7" name="police_doc_date" placeholder="" value="{{$data->police_doc_date}}" />
				<input type="hidden" id="mistakeby" class="form-control col-sm-7" name="mistakeby" placeholder="" value="{{$data->mistakeby}}" />
				<input type="hidden" id="advance" class="form-control col-sm-7" name="advance" placeholder="" value="{{$data->advance}}" />
				<input type="hidden" id="fax1" class="form-control col-sm-7" name="fax1" placeholder="" value="{{$data->fax1}}" />
				<input type="hidden" id="tax_10_40" class="form-control col-sm-7" name="tax_10_40" placeholder="" value="{{$data->tax_10_40}}" />
				<input type="hidden" id="tax_exem" class="form-control col-sm-7" name="tax_exem" placeholder="" value="{{$data->tax_exem}}" />
				<input type="hidden" id="tax_12" class="form-control col-sm-7" name="tax_12" placeholder="" value="{{$data->tax_12}}" />
				<input type="hidden" id="tax_50" class="form-control col-sm-7" name="tax_50" placeholder="" value="{{$data->tax_50}}" />
				<input type="hidden" id="tax_receipt" class="form-control col-sm-7" name="tax_receipt" placeholder="" value="{{$data->tax_receipt}}" />
				<input type="hidden" class="form-control col-sm-7" name="tax_permit" id="tax_permit" placeholder="" value="{{$data->tax_permit}}" />
				<input type="hidden" class="form-control col-sm-7" name="import_permit_hsny" id="import_permit_hsny" placeholder="" value="{{$data->import_permit_hsny}}" />
				<input type="hidden" id="import_permit_invest" class="form-control col-sm-7" name="import_permit_invest" placeholder="" value="{{$data->import_permit_invest}}" />
				<input type="hidden" class="form-control col-sm-7" name="print_count" id="print_count" placeholder="" value="{{$data->print_count}}" />
				<input type="hidden" class="form-control col-sm-7" name="print-template-file" id="print-template-file" placeholder="" value="" />
				<input type="hidden" id="submit_by" class="form-control col-sm-7" name="submit_by" placeholder="" value="{{$data->submit_by}}" />
				<input type="hidden" id="submit_date" class="form-control col-sm-7" name="submit_date" placeholder="" value="{{$data->submit_date}}" />
				<input type="hidden" id="checked" class="form-control col-sm-7" name="checked" placeholder="" value="{{$data->checked}}" />
				<input type="hidden" id="date_collected" class="form-control col-sm-7" name="date_collected" placeholder="" value="{{$data->date_collected}}" />
				<input type="hidden" id="special" class="form-control col-sm-7" name="special" placeholder="" value="{{$data->special}}" />
				<input type="hidden" id="special_remark" class="form-control col-sm-7" name="special_remark" placeholder="" value="{{$data->special_remark}}" />
				<input type="hidden" id="special_date" class="form-control col-sm-7" name="special_date" placeholder="" value="{{$data->special_date}}" />
				<input type="hidden" class="form-control col-sm-7" name="log" id="log" placeholder="" value="{{$data->log}}" />
				<input type="hidden" class="form-control col-sm-7" name="printlog" id="printlog" placeholder="" value="{{$data->printlog}}" />
				<input type="hidden" id="changelog" class="form-control col-sm-7" name="changelog" placeholder="" value="" />
				<input type="hidden" class="form-control col-sm-7" name="encoder" id="encoder" placeholder="" value="{{$data->encoder}}" />
				<input type="hidden" class="form-control col-sm-7" name="user" id="user" placeholder="" value="{{auth()->user()->id}}" />
				<!-- end hidden field -->
			</div>
			<div class="row">
				<div class="col-md-6 ">
					<a href="{{ url('/car-register') }}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>
					
				</div>
				<div class="col-md-6 text-right">
					<a href="{{url('print',$data->id)}}" class="btn btn-secondary btn-sm">{{trans('button.print')}}</a>
					<button class="btn btn-success btn-sm" type="submit">{{trans('button.save')}}</button>
				</div>
			</div>
			
		</form>
	</div>
</div> 
@endsection 
@push('page_scripts')
<script type="text/javascript">
var getCode = "{{url('getCode')}}";
var dist_url = "{{url('getDistrict')}}";
var get_vmodal = "{{url('getVmodel')}}";
</script>
<script type="text/javascript" src="{{asset('js/dropdownlist.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('js/book_no.js')}}"></script> -->
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script>
$('#register').validate({
	rules: {
		province: "required",
	},
	messages: {
		province: "Province is required.",
	},
});
</script> @endpush