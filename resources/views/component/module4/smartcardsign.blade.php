<div class="modal fade" id="addModel1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form  action="{{route('smart-card-sign.store')}}"  method="POST">
                  @method('post')
                  @csrf
            <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">Create New Smart Card Sign</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>           
         
         
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">Province:</label>
                <select name="province_code" class="js-example-basic-single form-control"  style="width:100%" required="">

                 <option value="" selected disabled hidden>-- Select Province Name-- </option>
                    @foreach($province as $data)
                   
                         <option value="{{ $data->province_code}}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Sign Image:</label>
                <input type="file" name="sign_img" class=" form-control file-upload-default" >
                 
              </div>
               <div class="col-md-3 mb-3">
                <label for="validationCustom01">Status:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                </select>
              </div>
                  </div>
                </div>
              <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">Cancel</button>
                 <button type="submit"  class="btn btn-success btn-sm btn-save">Save</button>
              </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

 <div class="modal fade" id="deleteModel"  role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
        <div class="modal-content">
      
            <form action="" id="deleteform" method="POST">
                  @method('Delete')
                  @csrf
                 

                   <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>                 
            <div class="modal-body">
              
               <h1 class="text-center">
                  <i class="zmdi zmdi-alert-circle-o zmdi-hc-fw"></i>
               </h1>
               <div class="modal-body text-center">
                  <h4>{{trans('table.do')}}</h4>
                  <p>{{trans('table.do1')}}</p>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary ">{{trans('table.cancel')}}</button>
                  <input type="submit" class="btn btn-danger "  value="{{trans('table.delete')}}">

               </div>
            </div>
        
        </form>
      </div>
   </div>
</div>
<div class="modal fade" id="editModel"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
             <form  action="" method="POST"  id="editform" name="editform">
                @method('PATCH')
               @csrf
         <div class="modal-header">
            <div class="col-md-11 text-center">
                 <h3 class="text-center">Update Smart Card Sign</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>          
          
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">Province:</label>
                <select name="province_code" class="js-example-basic form-control"  style="width:100%" required="">

              
                    @foreach($province as $data)
                         <option value="{{ $data->province_code}}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Sign Image:</label>
                <input type="file" name="sign_img" class=" form-control file-upload-default" >
               

               
              </div>
               <div class="col-md-3 mb-3">
                <label for="validationCustom01">Status:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                </select>
              </div>
                  </div>
                </div>
               <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
                    <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('table.update')}}">
                </div>
                </div>
              </form>
        </div>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>

