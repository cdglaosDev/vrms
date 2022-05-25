<div class="modal fade" id="addModel1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="{{route('village.store')}}" id="addform" method="POST"> 
	  @method('post') 
	  @csrf 
    <input type="hidden" id="new-id" value="">
	  <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_vill')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vill_code')}}:</label>
              <input type="number" class="form-control code" value="" placeholder="Enter Village Code" name="village_code" required="" title="{{trans('table_man.village_msg_code')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vill_name')}}:</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Village Name(Laos)" name="name" required="" title="{{trans('table_man.village_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table_man.vill_namee')}}:</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Village Name(English)" name="name_en" required="" title="{{trans('table_man.village_msg_name_en')}}">
            </div>
          </div>
          <div class="form-row">
          <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.pro_name')}}:</label>
              <select name="province_code" class="js-example-basic-single form-control province_code" id="province" style="width:100%" required="" title="{{trans('table_man.district_msg_pro_code')}}">
                <option value="" selected disabled hidden>-- Select Province Name-- </option> 
                @foreach($province as $data) 
                  <option value="{{ $data->province_code }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option> 
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="validationCustom01">{{trans('table_man.dist_name')}}:</label>
              <select name="district_code" class="js-example-basic-single form-control district_code" id="district" style="width:100%" required="" title="{{trans('table_man.village_msg_dis_code')}}">
                <option value="" selected disabled hidden>-- Select New District Name-- </option> 
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.desc')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Village Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
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

<!-- edit modal for village -->
<div class="modal fade" id="editModel" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST"> 
    @method('PATCH') 
    @csrf 
  <input type="hidden" id="edit-id" value="">
    <div class="modal-header">
        <div class="col-md-11 text-center">
          <h3 class="text-center">{{trans('table_man.update_vill')}}</h3>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{trans('table_man.vill_code')}}:</label>
            <input type="number" class="form-control code" value="" placeholder="Enter Village Code" name="village_code" required="" title="{{trans('table_man.village_msg_code')}}">
          </div>
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{trans('table_man.vill_name')}}(Lao):</label>
            <input type="text" class="form-control name" value="" placeholder="Enter Iso Title" name="name" required="" title="{{trans('table_man.village_msg_name')}}">
          </div>
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{trans('table_man.vill_namee')}}(Eng):</label>
            <input type="text" class="form-control name_en" value="" placeholder="Enter village Name" name="name_en" required="" title="{{trans('table_man.village_msg_name_en')}}">
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.pro_name')}}:</label>
              <select name="province_code" class="js-example-basic-single form-control province_code" id="edit-province" style="width:100%" required="" title="{{trans('table_man.district_msg_pro_code')}}">
                <option value="" selected disabled hidden>-- Select Province Name-- </option> 
                @foreach($province as $data) 
                  <option value="{{ $data->province_code }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option> 
                @endforeach
              </select>
            </div>
          </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">{{trans('table_man.dist_name')}}:</label>
            <select name="district_code" id="edit-district" class="js-example-basic-single form-control district_code" style="width: 100%; padding:1px 10px !important" title="{{trans('table_man.village_msg_dis_code')}}"> 
            <option value="" selected disabled hidden>-- Select District Name-- </option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">{{trans('common.status')}}:</label>
            <select name="status" class="form-control">
              <option value="1">Active</option>
              <option value="0">Deactive</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">{{trans('common.desc')}}:</label>
            <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Village Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
        <input type="submit" class="btn btn-success btn-sm btn-save" id="edit-form" value="{{trans('table.update')}}">
      </div>
    </form>
  </div>
</div>
</div>
<!-- end edit modal for village -->
