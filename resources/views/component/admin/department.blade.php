<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('department.store')}}" method="POST" id="addform"> 
        @method('post') 
        @csrf 
        <input type="hidden" id="new-id" value="">
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_dept')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.dept_name')}}(lao):</label>
              <input type="text" class="form-control name"  value="" placeholder="Enter department name (lao)" name="name" required="" title="{{trans('table_man.dept_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.dept_name')}}(Eng)</label>
              <input type="text" class="form-control name_en"  value="" placeholder="Enter department name (eng)"  name="name_en" required="" title="{{trans('table_man.dept_msg_name_en')}}">
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

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST"> 
      @method('PATCH') 
      @csrf 
      <input type="hidden" id="edit-id" value="">
      <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.update_dept')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.dept_name')}}(Lao):</label>
              <input type="text" class="form-control name"  value="" placeholder="Enter department name (lao)" name="name" required="" title="{{trans('table_man.dept_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table_man.dept_name')}}(Eng)</label>
              <input type="text" class="form-control name_en" value="" placeholder="Enter department name (Eng)" name="name_en" required="" title="{{trans('table_man.dept_msg_name_en')}}">
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
          <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('button.update')}}" id="edit-form">
        </div>
</form>
</div>
</div>
</div>
