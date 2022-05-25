<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
           <form action="" id="deleteform"  method="post">
             @method('Delete')
             {{ csrf_field() }}
             <div class="modal-header">
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
             <div class="modal-body text-center">
                    <h4>{{ trans('common.are_you_sure')}}</h4>
                    <p>{{ trans('common.do_you_want_delete')}}</p>
             </div>
             <div class="modal-footer">
                <input type="submit" class="btn btn-danger btn-sm" value="{{trans('button.delete')}}">
                <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
              </div>
          </form>
       </div>
    </div>
 </div>