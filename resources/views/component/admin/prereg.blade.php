@php
$appstatus=\App\Model\ApplicationStatus::get();
$staff = \App\Model\Staff::whereStatus(1)->get();
@endphp
<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form  action=""  method="POST">
                  @method('post')
                  @csrf

            <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">{{trans('table_man.add_country')}}</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
          </div>  
        
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">{{trans('table_man.iso')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Iso Name" name="iso" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table_man.country_name')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Country name " name="name" required="">

               
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table_man.country_namee')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Country Name" name="name_en" required="">

              </div>
              

               <div class="col-md-3 mb-3">
                <label for="validationCustom01">{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                </select>
              </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                  <button type="submit" class="btn btn-success ">{{trans('button.save')}}</button>
                 
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
 <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      
            <form action="" id="deleteform" method="POST">
                  @method('Delete')
                  @csrf             
            <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
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

