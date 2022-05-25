<div class="modal fade" id="editDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form action="" method="POST"  id="EditDoc" name="editdoc" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">Edit Document File</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <input  type="file" name="filename" accept=".pdf,.png,.jpg,.jpeg"  class="form-control" required>
                  <br/>
                  <div id="filearea" class="text-info"></div>
                  <input type="hidden" name="doc_type_id" value="">
                  <input type="hidden" name="vehicle_detail_id" value="">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-light btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>