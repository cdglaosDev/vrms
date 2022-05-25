<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form enctype="multipart/form-data" action="{{route('road-tax.store')}}"  method="POST">
                  @method('post')
                  @csrf
           
            <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">{{trans('book.roadtaxes')}}</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>         
          
          <div class="modal-body">
            <div class="form-row">
             
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.app_form')}}:</label>
                <select name="app_form_id" class="form-control" required="">
                     <option value="" selected disabled hidden>-- {{trans('book.app_form')}}-- </option>
                    @foreach($appform as $key=>$value)
                        <option value={{$value}}> {{$value}} </option>
                    @endforeach
                </select>
              </div>
              
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.amount')}}:</label>
                <input type="number" class="form-control" id="validationCustom01" value="" placeholder="{{trans('book.amount1')}} " name="amount" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.currency')}} :</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('book.currency1')}}" name="currency" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.file')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('book.file1')}} " name="file" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.remark')}}:</label>
                <textarea name="remark" rows="3" class="form-control" placeholder="{{trans('book.remark1')}} " required=""></textarea>
              </div>
               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> {{trans('book.date')}}:</label>
                                           <input type="text" name="date" class="date form-control" placeholder="{{trans('book.date1')}}">    
                                    </div>
                                </div>
                                
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">{{trans('table.status')}}:</label>
                <select name="status" class="form-control">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                </select>
              </div>
              
                  </div>
                </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                <button type="submit"  class="btn btn-success btn-sm btn-save">{{trans('button.save')}}</button>
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
          <form action="" id="deleteform"  method="post">
            @method('Delete')
            {{ csrf_field() }}
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
                  <input type="submit" class="btn btn-danger " value="{{trans('table.delete')}}">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                  @method('PATCH')
                  @csrf
                  
          <h3 class="text-center">{{trans('book.roadtax')}}</h3>
          <div class="modal-body">
            <div class="form-row">
             
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.app_form')}}:</label>
                <select name="app_form_id" class="form-control">
                    <option value="0" disabled="disabled">None</option>
                    @foreach($appform as $key=>$value)
                        <option value={{$value}}> {{$value}} </option>
                    @endforeach
                </select>
              </div>
              
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.amount')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Amount " name="amount" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.currency')}} :</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Currency " name="currency" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.file')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter New Car Number " name="file" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('book.remark')}}:</label>
                <textarea name="remark" rows="3" class="form-control" placeholder="Enter Remark "></textarea>
              </div>
               <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1"> {{trans('book.date')}}:</label>
                                           <input type="text" name="date" class="date form-control" placeholder="Choose  Date">    
                                    </div>
                                </div>
                                
             <div class="col-md-3 mb-3">
                <label for="validationCustom01">{{trans('table.status')}}:</label>
                <select name="status" class="form-control">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
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
      </div>
</div>