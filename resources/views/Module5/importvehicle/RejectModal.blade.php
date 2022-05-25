<!-- reject modal for module5 -->
<div class="modal fade" id="RejectModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST"  id="reject_form" name="reject">
                @method('POST')
               @csrf
                <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">Reject Application Form</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{ trans('app_form.remark')}}:</label>
                            <textarea name="remark"  cols="4" rows="5" class="form-control" required></textarea>
                        </div>      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                    <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- submit modal -->
<div class="modal fade" id="submit-box" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" id="submitForm" >
                @method('POST') @csrf
				<div class="modal-header">
					<div class="col-md-11 text-center">
                    <input type="hidden" name="pre_app_id" id="pre_app_id" value="">
						<h5 class="text-center py-2">{{ trans('app_form.submit_app')}}</h5> </div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ trans('button.cancel') }}</button>
                    <a  class="btn btn-success btn-sm submitButton">{{ trans('button.submit') }}</a>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- delete modal for module5 staff side -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="deleteform"  method="post">
            @method('POST')
            {{ csrf_field() }}
            <div class="modal-header" style="border-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
               <div class="modal-body text-center" style="padding:0px !important">
               <input type="hidden" name="pre_app_id" id="pre_app_id" value="">
                  <p>{{ trans('common.are_you_sure_to_delete') }}</p>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <a  class="btn btn-danger btn-sm deleteButton" >{{trans('button.ok')}}</a>
               </div>
           
         </form>
      </div>
   </div>
</div>
