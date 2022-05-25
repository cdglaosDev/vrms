<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('engine-type.store')}}" method="POST" id="addform">
        @method('post')
        @csrf
        <input type="hidden" id="new-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table.engine')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table.enginet')}}:</label>
              <input type="text" class="form-control name" value="" placeholder="Enter Engine Type Name(Laos)" name="name" required="" title="{{trans('table_man.eng_type_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table.engin')}}:</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter Engine Type Name(English)" name="name_en" required="" title="{{trans('table_man.eng_type_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table.description')}}:</label>
              <textarea name="description" rows="3" class="form-control desc" placeholder="Enter  Description" required="" title="{{trans('table_man.msg_desc')}}"></textarea>
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom01">{{trans('table.status')}}:</label>
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
    </div>
    </form>
  </div>
</div>
</div>
</div>
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform">
        @method('PATCH')
        @csrf
        <input type="hidden" id="edit-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table.engine1')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table.enginet')}}:</label>
              <input type="text" class="form-control name" name="name" required="" value="" title="{{trans('table_man.eng_type_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table.engin')}}:</label>
              <input type="text" class="form-control name_en" name="name_en" required="" title="{{trans('table_man.eng_type_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table.description')}}:</label>
              <input type="text" class="form-control desc" name="description" required="" title="{{trans('table_man.msg_desc')}}">
            </div>
            <div class="col-md-3 mb-3">
              <label for="validationCustom01">{{trans('table.status')}}:</label>
              <select name="status" class="form-control">
                <option value="1">{{trans('table.active')}}</option>
                <option value="0">{{trans('table.deactive')}}</option>
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