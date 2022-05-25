<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="deleteform"  method="post">
            @method('Delete')
            {{ csrf_field() }}
            <div class="modal-header" style="border-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
               <div class="modal-body text-center" style="padding:0px !important">
                  <p>{{ trans('common.are_you_sure_to_delete') }}</p>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <input type="submit" class="btn btn-danger btn-sm" value="{{trans('button.ok')}}">
               </div>
           
         </form>
      </div>
   </div>
</div>