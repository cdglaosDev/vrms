<!-- start add  modal -->
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form  action="{{route('permission.store')}}"  method="POST">
               @method('post')
               @csrf
               <h3 class="text-center">{{trans('title.per_create')}}</h3>
               <div class="modal-body">
                  <div class="form-row">
                     <div class="col-md-12 mb-3">
                        <label for="validationCustom01"> {{trans('common.name')}}:</label>
                        <input type="text" name="name" class="form-control" required="" placeholder="Enter permission name">
                     </div>
                     <div class="col-md-12 mb-3">
                        <label for="validationCustom01"> Type:</label>
                        <input type="text" name="type" class="form-control" placeholder="Enter Permission type">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                     <input type="submit" class="btn btn-success " value="{{trans('button.save')}}">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end add  modal -->
<!-- start edit modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form action="" method="POST"  id="editform" name="editform">
            @method('PATCH')
            @csrf
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('title.per_edit')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('common.name')}}:</label>
                     <input type="text" name="name" class="form-control">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> Type:</label>
                     <input type="text" name="type" class="form-control">  
                  </div>
               </div>
               <div class="col-md-12">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                  <input type="submit" class="btn btn-success " value="{{trans('button.update')}}">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- end edit modal -->