<div class="modal fade" id="addModel1"  role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('service-counter.store')}}" method="POST" id="addform">
        @method('post')
        @csrf
        <input type="hidden" id="new-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_service')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.province_code')}}:</label>
              <select name="province_code" class="js-example-basic-single form-control province_code" required="" title="{{trans('table_man.ser_counter_msg_pro_code')}}" style="width:100%">
                <option value="" selected disabled hidden>-- Select Province --</option>
                @foreach($provinces as $province)
                <option value="{{ $province->province_code }}">{{ $province->name }}({{ $province->name_en }})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.ser_counter_name')}}(Laos):</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Service Counter Name " name="name" required="" title="{{trans('table_man.ser_counter_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.ser_counter_name')}}(Eng):</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Service Counter Nmae" name="name_en" required="" title="{{trans('table_man.ser_counter_msg_name_en')}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.desc')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Service Counter Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">{{trans('table.active')}}</option>
                <option value="0">{{trans('table.deactive')}}</option>
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

<div class="modal fade" id="editModel"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" id="edit-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.update_service')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.province_code')}}:</label>
              <select name="province_code" class="js-example-basic-single form-control province_code" required="" title="{{trans('table_man.ser_counter_msg_pro_code')}}" style="width:100%">
                <option value="" selected disabled hidden>-- Select Province --</option>
                @foreach($provinces as $province)
                <option value="{{ $province->province_code }}">{{ $province->name }}({{ $province->name_en }})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.ser_counter_name')}}(Laos):</label>
              <input type="text" class="form-control name" value="" placeholder="Enter service counter name" name="name" required="" title="{{trans('table_man.ser_counter_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.ser_counter_name')}} (Eng):</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Service_Counter Name " name="name_en" required="" title="{{trans('table_man.ser_counter_msg_name_en')}}">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.desc')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Service Counter Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">{{trans('table.active')}}</option>
                <option value="0">{{trans('table.deactive')}}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
          <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('button.update')}}" id="edit-form">
        </div>
      </form>
    </div>
  </div>
</div>