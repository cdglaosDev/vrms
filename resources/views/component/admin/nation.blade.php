<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="{{route('nation.store')}}" method="POST" id="addform"> 
      @method('post') 
      @csrf 
      <input type="hidden" id="new-id" value="">
      <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('table_man.add_nation')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.nation_name')}}(Lao):</label>
              <input type="text" class="form-control name"  value="" placeholder="Enter Nationality Name(Laos)" name="name" required="" title="{{trans('table_man.nationality_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.nation_name')}}(Eng):</label>
              <input type="text" class="form-control name_en"  value="" placeholder="Enter Nation Name(English)" name="name_en" required="" title="{{trans('table_man.nationality_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.remark')}}:</label>
              <textarea name="remark" rows="3" class="form-control remark" placeholder="Enter Remark For Nationality" required="" title="{{trans('table_man.nationality_msg_remark')}}"></textarea>
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
            <h3 class="text-center">{{trans('table_man.update_nation')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table_man.nation_name')}}(Laos):</label>
              <input type="text" class="form-control name"  value="" placeholder="Enter Iso Title" name="name" required="" title="{{trans('table_man.nationality_msg_name')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('table_man.nation_name')}} (Eng):</label>
              <input type="text" class="form-control name_en"  value="" placeholder="Enter Nationality Name(Laos)" name="name_en" required="" title="{{trans('table_man.nationality_msg_name_en')}}">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01"> {{trans('table_man.remark')}}:</label>
              <input type="text" class="form-control remark"  value="" placeholder="Enter Nationality Name(English) " name="remark" required="" title="{{trans('table_man.nationality_msg_remark')}}">
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
          <input type="submit" class="btn btn-success btn-sm btn-save" id="edit-form" value="{{trans('button.update')}}">
        </div>
   
    </form>
  </div>
</div>
</div>
