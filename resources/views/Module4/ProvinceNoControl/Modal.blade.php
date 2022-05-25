@php
$province = \App\Model\Province::whereStatus(1)->get();
@endphp
<div class="modal fade bigger" id="addModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content w-150">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.add_province_control') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{ route('province-no-control.store') }}" method="POST" id="newForm">
            @method('post')
            @csrf
            <input type="hidden" value="" name="pro_ctrl_msg_title" id="pro_ctrl_msg_title" title="{{trans('module4.pro_ctrl_msg_title')}}">
            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-12 ">
                     <label for="validationCustomUsername">{{ trans('common.province') }}</label>
                     <select class="js-example-basic-single form-control province-code" id="province" name="province_code" style="width:100%" required="">
                        <option value="" selected disabled hidden>--Select Province--</option>
                        @foreach($province as $pro)
                        <option value="{{$pro->province_code}}" @if(auth()->user()->user_level == "province"){{$pro->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.province_no_start') }}</label>
                        <input type="text" class="form-control pro_no province-start" value="{{old('province_no_start')}}" placeholder="{{trans('Enter License Number')}}" name="province_no_start" maxlength="7" required="">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.present_province') }} </label>
                        <input type="text" class="form-control pro_no province-present" value="{{old('province_no_start')}}" placeholder="{{trans('Enter License Number')}}" name="present_province_no" maxlength="7" required="">
                     </div>
                  </div>
                  <input type="hidden" id="new-id" value="">
                  <div class="col-sm-12 col-md-12">
                     <div class="form-group">
                        <label for="status">{{ trans('common.status') }}:</label>
                        <select name="status" class="form-control status" required>
                           <option value="" selected disabled>Select Status</option>
                           @foreach(\App\Model\ProvinceNoControl::getEnumList("status") as $key => $value)
                           <option value="{{$key}}">{{$value}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="province-new">{{trans('button.save')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade bigger" id="editModel" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow:hidden;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.edit_province_control') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="" id="editform" name="editform" method="POST">
            @method('patch')
            @csrf
            <div class="modal-body" style="overflow:hidden;">
               <div class="row">
                  <div class="col-sm-12">
                     <label for="validationCustomUsername">{{ trans('common.province') }}</label>
                     <select class="js-example-basic-single form-control province-code" style="width:100%" id="edit-province" name="province_code" required="">
                        <option value="" selected disabled hidden>--Select Province--</option>
                        @foreach($province as $pro)
                        <option value="{{$pro->province_code}}" class="style1" @if(auth()->user()->user_level == "province"){{$pro->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif>{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.province_no_start') }}</label>
                        <input type="text" class="form-control pro_no province-start" value="" placeholder="{{trans('Enter License Number')}}" name="province_no_start" maxlength="7" required="">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="validationCustom01">{{ trans('module4.present_province') }}</label>
                        <input type="text" class="form-control pro_no province-present" value="" placeholder="{{trans('Enter License Number')}}" name="present_province_no" maxlength="7" required="">
                     </div>
                  </div>
                  <input type="hidden" id="edit-id" value="">
                  <div class="col-sm-12 col-md-12">
                     <div class="form-group">
                        <label for="status">{{ trans('common.status') }}:</label>
                        <select name="status" class="form-control status" required>
                           <option value="" selected disabled>Select Status</option>
                           @foreach(\App\Model\ProvinceNoControl::getEnumList("status") as $key => $value)
                           <option value="{{$key}}">{{$value}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="province-update">{{trans('button.update')}}</button>
            </div>

         </form>
      </div>
   </div>
</div>