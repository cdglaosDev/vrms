@php
$province = \App\Model\Province::GetProvince();
@endphp
<div class="modal fade bigger" id="addModel"  role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content w-150">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.add_division_control') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <form  action="\division-no-control"  method="POST" id="newForm">
               @method('post')
               @csrf
               <div class="modal-body">
                  <div class="row">
                     <div class="col-sm-6 col-md-6 ">
                        <label for="validationCustomUsername">{{ trans('common.province') }}</label>
                        <select  class="js-example-basic-single form-control province" title="{{ trans('module4.select_province') }}"  name="province_code" style="width:100%" required="" >
                           <option value="" selected disabled hidden>--Select Province--</option>
                           @foreach($province as $pro)
                           <option value="{{$pro->province_code}}" @if(auth()->user()->user_level == "province"){{$pro->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                           <label for="validationCustom01">{{ trans('module4.division_start') }}</label>
                           <input type="text" class="form-control div_no start-no"  title="{{ trans('module4.enter_div_start') }}" value="" placeholder="Enter Division No. Start" name="division_no_start" required="" maxlength="7">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                           <label for="validationCustom01">{{ trans('module4.division_end') }}</label>
                           <input type="text" class="form-control div_no end-no" title="{{ trans('module4.enter_div_end') }}" value="" placeholder="Enter Division No. End" name="division_no_end" required="" maxlength="7">
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                           <label for="validationCustom01">{{ trans('module4.alert_at') }}</label>
                           <input type="text" class="form-control div_no alert-no" title="{{ trans('module4.enter_alert_no') }}" title1="{{ trans('module4.alert_validation') }}" value="" placeholder="Enter Alert At" name="alert_at" required="" maxlength="7">
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                           <label for="status">{{ trans('common.status') }}:</label>
                           <select name="status" class="form-control status" title="{{ trans('module4.select_status') }}" required>
                              <option value="" selected disabled>Select Status</option>
                              @foreach(\App\Model\DivisionNoControl::getEnumList("status") as $key => $value)
                              <option value="{{$key}}">{{$value}}</option>
                              @endforeach
                           </select>
                        </div>
                        <input type="hidden" id="new-id" value="">
                     </div>
                  </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                     <button type="submit"  class="btn btn-success btn-sm" id="add-division">{{trans('button.save')}}</button>
                  </div>
              
            </form>
         </div>
      </div>
   </div>

<div class="modal fade bigger" id="editModel"  role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.edit_division_control') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="" id="editform" name="editform" method="POST">
            @method('patch')
            @csrf
           
            <div class="modal-body">
            <input type="hidden" id="edit-id" value="">
               <div class="row">
                  <div class="col-sm-6 col-md-6">
                     <label for="validationCustomUsername">{{ trans('common.province') }}</label>
                     <select  class="js-example-basic-single form-control province"   name="province_code" style="width:100%" required="" >
                        @foreach($province as $pro)
                        <option value="{{$pro->province_code}}" class="style1" @if(auth()->user()->user_level == "province"){{$pro->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.division_start') }}</label>
                        <input type="text" class="form-control div_no start-no"  value="" placeholder="Enter Division No. Start" name="division_no_start" required="" maxlength="7">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6 col-md-6">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.division_end') }}</label>
                        <input type="text" class="form-control div_no end-no"  value="" placeholder="Enter Division No. End" name="division_no_end" required="" maxlength="7">
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.alert_at') }}</label>
                        <input type="text" class="form-control div_no alert-no"  value="" placeholder="Enter Alert At" name="alert_at" required="" maxlength="7">
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="form-group">
                        <label for="status">{{ trans('common.status') }}:</label>
                        <select name="status" class="form-control status" required>
                           <option value="" selected disabled>Select Status</option>
                           @foreach(\App\Model\DivisionNoControl::getEnumList("status") as $key => $value)
                           <option value="{{$key}}">{{$value}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <button type="submit"  class="btn btn-success btn-sm" id="update-division">{{trans('button.update')}}</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>