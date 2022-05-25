@php
$counters = \App\Model\ServiceCounter::whereStatus(1)->get();
if (auth()->user()->user_level == "admin") {
$provinces = \App\Model\Province::whereStatus(1)->get();
$users =  \App\User::whereUserTypeAndCustomerStatus('staff', 'approve')->get();
} else {
$provinces = \App\Model\Province::whereProvinceCodeAndStatus(\App\Helpers\Helper::current_province(),1)->get();
$service_counters = \App\Model\ServiceCounter::whereProvinceCodeAndStatus(\App\Helpers\Helper::current_province(), 1)->get();
$users =  \App\User::userLists(\App\Helpers\Helper::current_province());
}
@endphp
<!-- start New modal pop -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <div class="col-md-11 text-center">
               <h3 class="text-center">{{ trans('finance_title.add_counter_matching') }}</h3>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('counter-matching.store')}}" method="POST" >
            @method('POST')
            @csrf
            <div class="modal-body">
               <div class="col-md-12 col-sm-12 mb-3">
                  <label for="validationCustom01">{{ trans('common.province') }}:</label>
                  <select name="province_code" class="form-control" id="province" required="">
                     @if(auth()->user()->user_level == "admin")
                     <option value="" selected disabled hidden>Select Province</option>
                     @endif
                     @foreach($provinces as $province)
                     <option value="{{$province->province_code}}">{{$province->name}}({{$province->name_en}})</option>
                     @endforeach
                  </select>
               </div>
               @if (auth()->user()->user_level == "admin")
               <div class="col-md-12 col-sm-12 mb-3">
                  <label for="validationCustom01">{{ trans('finance_title.service_counter') }}:</label>
                  <select name="service_counter_id" class="form-control" id="service" required="">
                     <option value="" >Select Service Counter </option>
                    
                  </select>
               </div>
               <div class="col-md-12 col-sm-12 mb-3">
               <label for="validationCustom01">{{ trans('app_form.staff') }}:</label>
                  <select name="staff_id" class="form-control" id="staff" required="">
                     <option value="" >Select Staff </option>
                  </select>
               </div>
               @else
               <div class="col-md-12 col-sm-12 mb-3">
                  <label for="validationCustom01">{{ trans('finance_title.service_counter') }}:</label>
                  <select name="service_counter_id" class="form-control" id="service" required="">
                     <option value="" >Select Service Counter </option>
                     @foreach($service_counters as $scounter)
                     <option value="{{ $scounter->id}}">{{$scounter->name_en }}</option>
                     @endforeach
                    
                  </select>
               </div>
               <div class="col-md-12 col-sm-12 mb-3">
                  <label for="validationCustom01">{{ trans('app_form.staff') }}:</label>
                  <select name="staff_id" id="staff" class="form-control" required="">
                     <option value="" selected disabled hidden>Select Staff </option>
                     @foreach($users as $user)
                     <option value="{{ $user->id}}" >{{$user->name}}</option>
                     @endforeach
                  </select>
               </div>
               @endif
              
               <div class="col-md-12 col-sm-12 mb-3">
                  <label for="validationCustom01">{{ trans('finance_title.start_bill_no') }}:</label>
                  <input type="number" name="start_bill_no" class="form-control bill_no"  required value="" placeholder="Enter Start bill numbe">
               </div>
               <div class="col-md-12 col-sm-12 mb-3">
               <label for="validationCustom01">{{ trans('finance_title.bill_no_present') }}:</label>
                  <input type="number" name="bill_no_present" class="form-control"   value="" readonly>
               </div>
            </div>
            <div class="modal-footer">
               <a class="btn  btn-secondary btn-sm" href="{{route('counter-matching.index')}}">{{trans('button.cancel')}}</a>
               <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end New modal pop -->

