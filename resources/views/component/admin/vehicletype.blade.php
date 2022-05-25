@php
$type_group = \App\Model\VehicleTypeGroup::whereStatus(1)->get();
@endphp
<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('vehicle-type.store')}}" method="POST" id="addform">
        @method('post')
        @csrf
        <input type="hidden" id="new-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_vtype')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}}(Lao):</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Vehicle Type Name" name="name" required="" title="{{trans('table_man.v_type_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}}(Eng):</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Vehicle Type Name" name="name_en" required="" title="{{trans('table_man.v_type_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('title.veh_type_group')}}</label>
              <select class="form-control type_group" style="width:100%" name="vehicle_type_group_id" required="" title="{{trans('table_man.v_type_msg_type_group')}}">
                <option value="" selected disabled hidden>-- Select Vehicle Type Group-- </option> 
                @foreach($type_group as $data) <option value="{{ $data->id }}" class="style1">{{ $data->name }}</option> 
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-3">
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform">
        @method('PATCH')
        @csrf
        <input type="hidden" id="edit-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.update_vtype')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}}(Lao):</label>
              <input type="text" class="form-control name" name="name" required="" value="" title="{{trans('table_man.v_type_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}}(Eng):</label>
              <input type="text" class="form-control name_en" name="name_en" required="" title="{{trans('table_man.v_type_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('title.veh_type_group')}}</label>
              <select class="form-control type_group" style="width:100%" name="vehicle_type_group_id" required="" title="{{trans('table_man.v_type_msg_type_group')}}">
                <option value="" selected disabled hidden>-- Select Vehicle Type Group-- </option> 
                @foreach($type_group as $data) <option value="{{ $data->id }}" class="style1">{{ $data->name }}</option> 
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-3">
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