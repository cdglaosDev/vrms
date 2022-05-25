<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{route('app-status.store')}}" method="POST"> 
          @method('post') 
          @csrf 
          <h3 class="text-center">{{trans('title.add_status')}}</h3>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('common.name')}} (Lao):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Name" name="name" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('common.name')}} (Eng):</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Name" name="name_en" required="">
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
            <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform"> 
        @method('PATCH') 
        @csrf 
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('title.update_status')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}}(Lao):</label>
              <input type="text" class="form-control" id="validationCustom01" name="name" required="" value=>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.name')}} (Eng):</label>
              <input type="text" class="form-control" id="validationCustom01" name="name_en" required="">
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
          <button type="submit" class="btn btn-success">{{trans('button.update')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>