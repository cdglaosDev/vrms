<div class="row">

            <div class="col-md-2 ">
              <div class="form-group">
                <label for="licence_number">{{ trans('vehicle.pre_license') }}</label>
                <input type="text" class="form-control" value="{{$vehicle->licence_no_need??''}}" readonly>
              </div>
            </div>
                    
            <div class="col-md-2 ">
              <div class="form-group">
              <label for="validationCustom02">{{ trans('vehicle.vehicle_type') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->type->name??''}}({{$vehicle->type->name_en}})" readonly>
            </div>
          </div>
                      
            <div class="col-md-2">
              <div class="form-group">
              <label for="width">{{ trans('vehicle.width') }}</label>
              <input type="number" class="form-control "value="{{$vehicle-> width??''}}" min="1" readonly>
            </div>
          </div>
                     
            <div class="col-md-1">
              <div class="form-group">
              <label for="height">{{ trans('vehicle.height') }}</label>
              <input type="number" class="form-control "  value="{{$vehicle-> height??''}}" readonly>
            </div>
          </div>

            <div class="col-md-1">
              <div class="form-group">
              <label for="long">{{ trans('vehicle.long') }}</label>
              <input type="number" class="form-control " id="long" placeholder="Long" value="{{$vehicle-> long??''}}" name="long" min="1" readonly>
            </div>
          </div>
                     
            <div class="col-md-2">
              <div class="form-group">
              <label for="import_permit_no">{{ trans('vehicle.permit_no') }}</label>
              <input type="text" class="form-control " id="import_permit_no" name="import_permit_no" placeholder="Permit No" value="{{$vehicle-> import_permit_no??''}}" readonly>
            </div>
          </div>
                             
            <div class="col-md-2">
              <div class="form-group">
              <label for="import_permit_date">{{ trans('vehicle.permit_date') }}</label>
              <div class="input-group">
                <input type="text" class="datetime form-control" id="import_permit_date" name="import_permit_date" placeholder="Permit date" value="{{$vehicle-> import_permit_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
              </div>
            </div>
          </div>
          </div>
          
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="vehicle_kind">{{ trans('vehicle.vehicle_kind') }}</label>
                <input type="text" class="form-control" value="{{$vehicle->vehicleKind->name??''}}({{$vehicle->vehicleKind->name_en??''}})" readonly>
               
            </div>
          </div>
                     
            <div class="col-md-2">
              <div class="form-group">
              <label for="brand_id">{{ trans('vehicle.brand') }}</label>
                <input type="text" class="form-control" value="{{$vehicle->brand->name??''}}({{$vehicle->brand->name_en??''}})" readonly>
            </div>
          </div>
                    
            <div class="col-md-2">
              <div class="form-group">
              <label for="weight">{{ trans('vehicle.weight') }}</label>
              <input type="number" class="form-control " id="weight" placeholder=" Weight" value="{{$vehicle-> weight??''}}" name="weight" min="1" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="weight_filled">{{ trans('vehicle.weight_filled') }}</label>
              <input type="number" class="form-control" placeholder="Enter Weight" value="{{$vehicle-> weight_filled??''}}" name="weight_filled" min="1" readonly>
            </div>
          </div>
                    
            <div class="col-md-2">
              <div class="form-group">
              <label for="industrial_doc_no">{{ trans('vehicle.indus_doc_no') }}</label>
                <div class="input-group">
                  <input type="text" class="form-control " id="industrial_doc_no" name="industrial_doc_no" placeholder="Industrial Doc No" value="{{$vehicle-> industrial_doc_no??''}}" aria-describedby="inputGroupPrepend" readonly>
                </div>
            </div>
          </div>
                  
            <div class="col-md-2">
              <div class="form-group">
              <label for="industrial_doc_date">{{ trans('vehicle.indus_doc_date') }}</label>
                <div class="input-group">
                  <input type="text" class="datetime form-control" id="industrial_doc_date" name="industrial_doc_date" placeholder="Industrial Doc Date" value="{{$vehicle-> industrial_doc_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
                </div>
            </div>
          </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="owner_name">{{ trans('vehicle.owner_name') }}</label>
              <input type="text" class="form-control required" id="owner_name" placeholder="Enter Owner Name" value="{{$vehicle->owner_name??''}}" name="owner_name" readonly>
            </div>
          </div>
                     
            <div class="col-md-2 ">
              <div class="form-group">
              <label for="model_id">{{ trans('vehicle.model') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->model->name??''}}({{$vehicle->model->name_en??''}})" readonly>
           </div>
          </div>
                      
            <div class="col-md-2">
              <div class="form-group">
              <label for="total_weight">{{ trans('vehicle.total_weight') }}</label>
              <input type="number" class="form-control " id="total_weight" name="total_weight" placeholder="Total Weight" value="{{$vehicle->total_weight??''}}" min="1" readonly>
            </div>
          </div>
                      
            <div class="col-md-2">
              <div class="form-group">
              <label for="color_id">{{ trans('vehicle.color') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->color->name??''}}({{$vehicle->color->name_en??''}})" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="technical_doc_no">{{ trans('vehicle.tech_no') }} </label>
            <input type="text" class="form-control " id="technical_doc_no" name="technical_doc_no" placeholder="Technical Doc No" value="{{$vehicle->technical_doc_no??''}}" readonly>
            </div>
          </div>
                    
            <div class="col-md-2">
              <div class="form-group">
              <label for="technical_doc_date">{{ trans('vehicle.tech_date') }}</label>
              <input type="text" class="datetime form-control " id="technical_doc_date" name="technical_doc_date" placeholder="Technical Doc Date" value="{{$vehicle->technical_doc_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
            </div>
          </div>
        </div>
          
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="tenant_name">{{ trans('vehicle.tenant_name') }}</label>
              <input type="text" class="form-control required" id="tenant_name" placeholder="Enter Tenant Name" value="{{$vehicle->tenant_name??''}}" name="tenant_name" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="validationCustomUsername">{{ trans('vehicle.engine_no') }}</label>
              <input type="text" class="form-control " id="validationCustomUsername" name="engine_no" placeholder="Engine Number" value="{{$vehicle->engine_no??''}}" aria-describedby="inputGroupPrepend" oninput="this.value = this.value.toUpperCase()" readonly>
            </div>
          </div>
                     
            <div class="col-md-2">
              <div class="form-group">
              <label for="seat">{{ trans('vehicle.seat') }}</label>
              <input type="number" class="form-control " id="seat" placeholder="Seats" name="seat"  value="{{$vehicle->seat??''}}" min="1" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="steering_id">{{ trans('vehicle.steering') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->steering->name??''}}({{$vehicle->steering->name??''}})" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="comerce_permit_no">{{ trans('vehicle.commerce_permit_no') }}</label>
              <input type="text" class="form-control " id="comerce_permit_no" name="comerce_permit_no" placeholder="Commerce Permit No" value="{{$vehicle->comerce_permit_no??''}}" aria-describedby="inputGroupPrepend" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="comerce_permit_date">{{ trans('vehicle.commerce_permit_date') }}</label>
              <input type="text" class="datetime form-control " id="comerce_permit_date" name="comerce_permit_date" placeholder="Commerce Permit Date" value="{{$vehicle->comerce_permit_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
            </div>
          </div>
          </div>
            
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="province">{{ trans('vehicle.province') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->province->name??''}}({{$vehicle->province->name_en??''}})" readonly>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="chassis_no">{{ trans('vehicle.chassis_no') }}</label>
            <input type="text" class="form-control " id="chassis_no" name="chassis_no" placeholder="Chassis No" value="{{$vehicle->chassis_no??''}}" aria-describedby="inputGroupPrepend" oninput="this.value = this.value.toUpperCase()" readonly>
          </div>
        </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="engine_type_id">{{ trans('vehicle.engine_type') }}</label>
               <input type="text" class="form-control" value="{{$vehicle->engine_type->name??''}}({{$vehicle->engine_type->name_en??''}})" readonly>
             </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label for="cylinder">{{ trans('vehicle.cylinder') }}</label>
              <input type="number" class="form-control" id="validationCustomUsername" name="cylinder" placeholder="" value="{{$vehicle->cylinder??''}}" min="1" readonly>
            </div>
          </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="tax_no">{{ trans('vehicle.tax_no') }}</label>
              <input type="text" class="form-control " id="tax_no" name="tax_no" placeholder="Tax No" value="{{$vehicle->tax_no??''}}" readonly>
            </div>
          </div>
          
            <div class="col-md-2">
              <div class="form-group">
              <label for="tax_date">{{ trans('vehicle.tax_date') }}</label>
              <input type="text" class="datetime form-control " id="tax_date" name="tax_date" placeholder="Tax Date" value="{{$vehicle->tax_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
            </div>
          </div>
          </div>
            
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="district">{{ trans('vehicle.district') }}</label>
              <input type="text" class="form-control" value="{{$vehicle->district->name??''}}({{$vehicle->district->name_en??''}})" readonly>
            </div>
          </div>

          <div class="col-md-2 ">
            <div class="form-group">
            <label for="motor_brand_id">{{ trans('vehicle.motor_brand') }}</label>
            <input type="text" class="form-control" value="{{$vehicle->engine_brand->name??''}}({{$vehicle->engine_brand->name_en??''}})" readonly>
         </div>
        </div>

            <div class="col-md-2">
              <div class="form-group">
              <label for="validationCustomUsername">{{ trans('vehicle.cc') }}</label>
              <input type="number" class="form-control " id="validationCustomUsername" name="cc" placeholder="Enter CC" value="{{$vehicle->cc??''}}" min="1" aria-describedby="inputGroupPrepend" readonly>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="year_manufacture">{{ trans('vehicle.year_mnf') }}</label>
            <input type="number" class="form-control date-year" id="year_manufacture" placeholder="Year" name="year_manufacture"  onKeyDown="if(this.value.length==4) return false;" value="{{$vehicle->year_manufacture??''}}" readonly>
          </div>
        </div>
            
            <div class="col-md-2">
              <div class="form-group">
              <label for="tax_payment_no">{{ trans('vehicle.tax_payment_no') }}</label>
              <input type="text" class="form-control" id="tax_payment_no" name="tax_payment_no" placeholder="Tax Payment" value="{{$vehicle->tax_payment_no??''}}" aria-describedby="inputGroupPrepend" readonly>
            </div>
          </div>
              
            <div class="col-md-2">
              <div class="form-group">
              <label for="tax_payment_date">{{ trans('vehicle.tax_payment_date') }}</label>
              <input type="text" class="datetime form-control" id="tax_payment_date" name="tax_payment_date" placeholder="Tax Payment Date" value="{{$vehicle->tax_payment_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
            </div>
          </div>
          </div>
            
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label for="village_name">{{ trans('vehicle.village') }}</label>
              <input type="text" class="form-control" id="village_name" placeholder="Enter Village" value="{{$vehicle->village_name??''}}" name="village_name" readonly>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="remark">{{ trans('vehicle.vehicle_remark') }}</label>
            <input type="text" class="form-control" id="remark" name="remark" placeholder="Vehicle Remark" value="{{$vehicle->remark??''}}" aria-describedby="inputGroupPrepend" readonly>
          </div>
        </div>
           
          <div class="col-md-2">
            <div class="form-group">
            <label for="Axis">{{ trans('vehicle.axis') }}</label>
            <input type="number" class="form-control" id="Axis" placeholder="Axis" name="axis"  value="{{$vehicle->axis??''}}" min="1" readonly>
          </div>
        </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="wheels">{{ trans('vehicle.wheel') }}</label>
            <input type="number" class="form-control" id="wheels" placeholder="Wheels" name="wheels"  value="{{$vehicle->wheels??''}}" min="1" readonly>
          </div>
        </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="police_doc_no">{{ trans('vehicle.polic_doc_no') }}</label>
            <input type="text" class="form-control " id="police_doc_no" name="police_doc_no" placeholder="Police Doc No" value="{{$vehicle->police_doc_no??''}}" readonly>
         </div>
        </div>

         <div class="col-md-2">
          <div class="form-group">
            <label for="police_doc_date">{{ trans('vehicle.polic_doc_date') }}</label>
            <input type="text" class="datetime form-control " id="police_doc_date" name="police_doc_date" placeholder="Police Doc Date" value="{{$vehicle->police_doc_date??''}}" aria-describedby="inputGroupPrepend" format="yyyy-mm-dd" readonly>
          </div>
        </div>
      </div>