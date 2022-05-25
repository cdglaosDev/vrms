
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">         
        <h3 class="text-center">Edit Application Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
                  @method('PATCH')
                  @csrf
          <div class="modal-body">
             <div class="form-row">
              <div class="col-md-12 col-sm-12 mb-2">
                <label for="">Date Request</label>
              <input type="text" class="form-control" id="date_request" value=""  name="date_request" readonly="">
              </div>
              <div class="col-md-12 col-sm-12 mb-2">
                <label for="remark">Remark:</label>
                <textarea name="remark" class="form-control" cols="30" rows="5" placeholder="Enter Remark"></textarea>
              
              </div>
              <div class="col-md-12 col-sm-12 mb-2">
                <label for="comment">Comment:</label>
                <textarea name="comment" class="form-control" cols="30" rows="5" placeholder="Enter Comment"></textarea>
                
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
            <button type="submit"  class="btn btn-success btn-sm">{{trans('button.update')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>