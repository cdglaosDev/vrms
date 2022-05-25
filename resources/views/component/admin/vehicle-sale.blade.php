<div class="modal fade" id="addModel" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="myForm" action="{{route('vehicle-sale.store')}}" method="POST">
        @method('post')
        @csrf
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_verhicle_sale')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-6 ">
              <label for="validationCustom01">{{trans('table_man.vsale_name')}}(Lao):</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Name(Laos)" name="name" required="" title="{{trans('table_man.v_sale_msg_name')}}">
            </div>
            <div class="col-md-6">
              <label for="validationCustom01">{{trans('table_man.vsale_name')}}(Eng):</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Name(English)" name="name_en" required="" title="{{trans('table_man.v_sale_msg_name_en')}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('user.phone')}}:</label>
              <input type="number" class="form-control phone" value="" placeholder="Enter Phone Number" name="phone" required="" title="{{trans('table_man.v_sale_msg_phone')}}">
            </div>
            <div class="col-md-6 mb-9">
              <div class="form-group">
                <label for="exampleInputEmail1">{{trans('user.email')}}:</label>
                <input id="email" type="email" class="form-control email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required="" title="{{trans('table_man.v_sale_msg_email')}}">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('user.address')}}:</label>
              <input type="text" class="form-control address" value="" placeholder="Enter Address" name="address" required="" title="{{trans('table_man.v_sale_msg_address')}}">
            </div>
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('table_man.cont')}}:</label>
              <input type="text" class="form-control contact" value="" placeholder="Enter Contact" name="contact" required="" title="{{trans('table_man.v_sale_msg_contact')}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 ">
              <label for="validationCustomUsername">{{ trans('register.province')}}</label>
              <select class="js-example-basic-single form-control province" id="province" name="province_code" style="width:100%" required="" title="{{trans('table_man.v_sale_msg_province')}}">
                <option value="" selected disabled hidden>--Select Province--</option>
                @foreach($province as $pro)
                <option value="{{$pro->province_code}}">{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 ">
              <label for="validationCustom02">District</label>
              <select class="form-control js-example-basic-single district" style="width:100%" name="district_code" id="district" required="" title="{{trans('table_man.v_sale_msg_district')}}">
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('table_man.vill_name')}}:</label>
              <input type="text" class="form-control" value="" placeholder="Enter Village Name" name="village_code" required="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
          <button type="submit" class="btn btn-success btn-sm btn-save" id="add-form">{{trans('button.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModel" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform">
        @method('PATCH')
        @csrf
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.update_verhicle_sale')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-6 ">
              <label for="validationCustom01">{{trans('table_man.vsale_name')}}(Lao):</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Name(Laos)" name="name" required="" title="{{trans('table_man.v_sale_msg_name')}}">
            </div>
            <div class="col-md-6">
              <label for="validationCustom01">{{trans('table_man.vsale_name')}}(Eng):</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Name(English)" name="name_en" required="" title="{{trans('table_man.v_sale_msg_name_en')}}">
            </div>
          </div>

          <div class="form-row">

            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('user.phone')}}:</label>
              <input type="number" class="form-control phone" value="" placeholder="Enter Phone" name="phone" required="" title="{{trans('table_man.v_sale_msg_phone')}}">
            </div>
            <div class="col-md-6 mb-9">
              <div class="form-group">
                <label for="exampleInputEmail1">{{trans('user.email')}}:</label>
                <input id="email" type="email" class="form-control email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required="" title="{{trans('table_man.v_sale_msg_email')}}">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('user.address')}}:</label>
              <input type="text" class="form-control address" value="" placeholder="Enter Address" name="address" required="" title="{{trans('table_man.v_sale_msg_address')}}">
            </div>
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('table_man.cont')}}:</label>
              <input type="text" class="form-control contact" value="" placeholder="Enter Contact" name="contact" required="" title="{{trans('table_man.v_sale_msg_contact')}}">
            </div>
          </div>
          <div class="form-row">

            <div class="col-md-6 ">
              <label for="validationCustomUsername">{{ trans('register.province')}}</label>
              <select class="js-example-basic-single form-control province" id="province_code" name="province_code" style="width: 100%; padding:1px 10px !important" title="{{trans('table_man.v_sale_msg_province')}}">
                @foreach($province as $pro)
                <option value="{{$pro->province_code}}">{{ $pro->name }}&nbsp;({{$pro->name_en}})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustomUsername">{{trans('user.district')}}:</label>
              <select name="district_code" class="form-control js-example-basic-single district" style="width:100%" id="district_code" required="" title="{{trans('table_man.v_sale_msg_district')}}">
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-9">
              <label for="validationCustom01">{{trans('table_man.vill_name')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="village_code" required="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
          <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('table.update')}}" id="edit-form">
        </div>
      </form>
    </div>
  </div>
</div>
