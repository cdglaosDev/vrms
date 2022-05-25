<div class="modal fade" id="addModel1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('vehicle-model.store')}}" method="POST" id="addform">
        @method('post')
        @csrf
        <input type="hidden" id="new-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_vmodel')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vmodel_name')}}:</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Vehicle Model Name (Laos)" name="name" required="" title="{{trans('table_man.v_model_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vmodel_name_en')}}:</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Vehicle Model Name (English)" name="name_en" required="" title="{{trans('table_man.v_model_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('common.desc')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Vehicle Model Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vbrand_name')}}</label>
              <select class="js-example-basic-single form-control brand" style="width:100%" name="brand_id" required="" title="{{trans('table_man.v_model_msg_brand')}}">
                <option value="" selected disabled hidden>-- Select Brand -- </option>
                @foreach($brand as $data)
                <option value="{{ $data->id }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
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
          <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
          <button type="submit" class="btn btn-success" id="add-form">{{trans('button.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModel" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" id="edit-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.update_vmodel')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table_man.vmodel_name')}}:</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Vehicle Model Name (Laos)" name="name" required="" title="{{trans('table_man.v_model_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.vmodel_name_en')}}:</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Vehicle Model Name (English)" name="name_en" required="" title="{{trans('table_man.v_model_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('common.desc')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter Vehicle Model Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
            </div>
            <div class="col-md-12 mb-3">
              <label>{{trans('table_man.vbrand_name')}}</label>
              <select class="form-control brand" name="brand_id" required="" title="{{trans('table_man.v_model_msg_brand')}}">
                @foreach($brand as $data)
                <option value="{{ $data->id }}" class="js-example-basic-single form-control" style="width:100%">{{ $data->name }}({{$data->name_en}})</option>
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
          <button type="submit" class="btn btn-success btn-sm btn-save" id="edit-form">{{trans('button.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>