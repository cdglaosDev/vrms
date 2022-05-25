<style>
  #search input {
    margin-right: 5px;
  }
</style>
<h3>Search License</h3>
<div class="row" id="search" style="padding-left: 10px; padding-right:10px; margin:0px;">
  {{ trans('module4.license_no_search')}}:<input type="text" class="w60">
  {{ trans('module4.general')}}:<input type="text" class="w180">
  {{ trans('module4.province')}}:<input type="text" class="w90">
  {{ trans('module4.village')}}:<input type="text" class="w90">
  {{ trans('module4.name')}}:<input type="text" class="w100">
  {{ trans('module4.target_number')}}:<input title="ລະຫັດ 1,11,2,3,4,5,6,8,51" type="text" class="w40">
  {{ trans('module4.issue_date')}}:<input type="text" class="w70">
  {{ trans('module4.sort')}}:
  <div class="form-group" style="display: inline;margin-right:5px;">
    <select class="form-control js-example-basic-single" style="width: 100%;height: 28px;padding:0px;" name="vehicle_id" required>
      <option value="0" selected></option>
      <option value="1">-modify_date</option>
      <option value="2">division_no</option>
      <option value="3">province_no</option>
      <option value="4">name</option>
      <option value="5">license_no</option>
      <option value="6">issue_date</option>
    </select>
  </div>

  <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideDown();$(this).hide();" style="display: inline-block; margin-top:0px; padding-top: 1px;padding-bottom: 1px;">{{ trans('module4.advanced_search')}}</a>

  <div id="advanced-search" style="width: 100%; background: rgb(204, 221, 255); border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.3) 4px 4px 10px; padding: 3px; display: none;">
    {{ trans('module4.vehicle_type')}}: <input type="text" class="w70">
    {{ trans('module4.brand')}}: <input type="text" class="w70">
    {{ trans('module4.model')}}: <input type="text" class="w70">
    {{ trans('module4.engine_no')}}: <input type="text" class="w100">
    {{ trans('module4.chassis_no')}}: <input type="text" class="w100">
    {{ trans('module4.traffic_color')}}: <input type="text" class="w70">
    {{ trans('module4.cc')}}: <input type="text" class="w70">
    {{ trans('module4.year')}}: <input type="text" class="w70">
    <br>

    {{ trans('module4.import_permit_no')}}: <input type="text" class="w120 mt-2 mb-2">
    {{ trans('module4.industrial_doc_no')}}: <input type="text" class="w120 mt-2 mb-2">
    {{ trans('module4.technical_doc_no')}}: <input type="text" class="w120 mt-2 mb-2">
    {{ trans('module4.comerce_permit_no')}}: <input type="text" class="w120 mt-2 mb-2">
    <br>

    {{ trans('module4.special_case_car')}}: <input type="text" class="w120">
    {{ trans('module4.license_3_digits')}}: <input type="text" class="w120">
    <br>

    <a href="#" id="advanced-show" class="button" onclick="$(&quot;#advanced-search&quot;).slideUp();$(&quot;#advanced-show&quot;).show()">{{ trans('module4.close_advanced_search')}}</a>
  </div>
<div scrollid="101" bottom="10" style="overflow-y: scroll; height: 2205px;">
<div style="color:red; padding-left: 10px;">{{ trans('module4.not_allow_to_publish')}}</div>
<div class="card-body">
  <div class="row">
    <div class="table-responsive">
      <table id="order-listing" class="table table-striped">
        <thead>
          <tr>
            <th>{{ trans('module4.license_no_header')}}</th>
            <th>{{ trans('module4.model')}}</th>
            <th>{{ trans('module4.engine_no_chassis_no')}}</th>
            <th>{{ trans('module4.name')}}</th>
            <th>{{ trans('module4.village_district_province')}}</th>
            <th>{{ trans('module4.number')}}</th>
            <th>{{ trans('module4.expire_date_header')}}</th>
            <th>{{ trans('module4.tool_techincalFee')}}</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>
                <a href="#" class="link license_no" purpose_no="{{$vehicle->vehicle_kind_code ?? ''}}" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->licence_no}}</a>
                <br>
                {{ $vehicle->vehicle_kind_name ?? '' }}
            </td>
            <td>
                <div>{{ $vehicle->brand_name ?? '' }}</div>
                <div style="font-weight: bold;">{{ $vehicle->model_name ?? '' }}</div>
                <div>{{ $vehicle->color_name ?? '' }}</div>
            </td>
            <td>
                <div>{{ $vehicle->engine_no }}</div>
                <div>
                    <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->chassis_no }}</a>
                </div>
            </td>
            <td>
                <a href="#" class="link" data-url="{{ route('showTrafficPolice',['id' => $vehicle->id ])}}" data-id="{{$vehicle->id}}" onclick="vehicleModal(this)">{{ $vehicle->owner_name }}</a>
            </td>
            <td>
                <div style="font-weight: bold;">{{ $vehicle->village_name }}</div>
                <div style="color: #666;"><small>ມ.</small>{{ $vehicle->district_name ?? '' }}</div>
                <div class="province" province_code="{{$vehicle->province_code}}">{{ $vehicle->province_name ?? '' }}</div>
            </td>
            <td>
                <div style="white-space:nowrap;color: #777;">ກມ {{ $vehicle->division_no }}</div>
                <div style="color: #aaa;">ຂວ {{ $vehicle->province_no }}</div>
              
            </td>
            <td>
                <div style="color: #f99;">ອອກ {{ $vehicle->issue_date }}</div>
                <div style="color: #f99;">ໝົດ {{ $vehicle->expire_date }}</div>
            </td>
            <td>
                <div>ຄ່າທາງ: </div>
               
                <div>{{ $vehicle->remark }}</div>
            </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

