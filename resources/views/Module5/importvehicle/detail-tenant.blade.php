<div class="row">
   <div class="col-12 col-md-8">
      <div class="row">
         <div class="col-md-12 col-sm-12 mb-1">
            <label for="validationCustom01">{{ trans('common.name')}}:</label>
            <input type="text" class="form-control tenant_name"  value="" placeholder="Enter Name" name="tenant_name" required>
         </div>
         <div class="col-md-6 col-sm-6 mb-1">
            <label for="validationCustom01">{{ trans('common.province')}}:</label><br/>
            <select name="province_code" class="form-control js-example-basic-single" id="tenant-province" style="width: 100%" required>
               <option value="" disabled>Select Province</option>
               @foreach($data['provinces'] as $pro)
               <option value="{{$pro->province_code}}">{{ $pro->name}}</option>
               @endforeach
            </select>
         </div>
         <div class="col-md-6 col-sm-6 mb-1">
            <label for="validationCustom01">{{ trans('common.district')}}:</label><br/>
            <select class="form-control js-example-basic-single" name="district_code"  required="required" style="width: 100%" id="tenant-district">
               <option value="" selected disabled hidden>--Select District--</option>
            </select>
         </div>
         <div class="col-md-6 col-sm-6 mb-1">
            <label for="validationCustom01">{{ trans('module4.village_name')}}:</label>
            <input type="text" class="form-control village"  value="" placeholder="Enter Village" name="village" required>
         </div>
         <div class="col-md-6 col-sm-6 mb-1">
            <label for="validationCustom01">{{ trans('module4.tel')}}:</label>
            <input type="number" class="form-control phone"  value="" placeholder="Enter Phone" name="phone" required>
         </div>
         <div class="col-md-12 col-sm-12 mb-1">
            <label for="validationCustom01">{{ trans('module4.note')}}:</label>
            <textarea name="note"  class="form-control note" cols="3" rows="3"></textarea>
         </div>
      </div>
   </div>
   <div class="col-6 col-md-4 mt-5">
      <div class="fileinput fileinput-new" data-provides="fileinput">
         <div class="fileinput-new thumbnail" style="height: 100;">
            <img class="abir_image"  src="{{asset('images/default.png')}}"  alt="logo"  width="100"> 
         </div>
         <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
         <div>
            <span class="btn btn-success btn-file">
            <span class="fileinput-new"> Select File </span>
            <span class="fileinput-exists"> Change </span>
            <input type="file" name="image" value="user-default.png">
            </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12 col-sm-12 text-right mt-2">
   <button class="btn btn-success btn-sm tenant">{{ trans('button.save')}}</button>
</div>