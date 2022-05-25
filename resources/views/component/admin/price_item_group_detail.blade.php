<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form  action="{{route('price_itemgroup_detail.store')}}"  method="POST">
                  @method('post')
                      @csrf

          <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">{{trans('table.group_detail')}}</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
          </div>  
        
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">{{trans('table.price_item_name')}}:</label>
               <select name="price_item_id" class="form-control" required="">

                       <option value="" selected disabled hidden>-- Select New Price Item Name-- </option>
                    @foreach($priceitem as $key=>$value)
                    
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
             
              </div>
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">{{trans('table.group_item_name')}}:</label>
               <select name="item_group_id" class="form-control" required="">

                       <option value="" selected disabled hidden>-- Select New Price Item Group Name-- </option>
                    @foreach($priceitemgroup as $key=>$value)
                    
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
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
                  
          <h3 class="text-center">{{trans('table.group_detail_update')}}</h3>
          <div class="modal-body">
            <div class="form-row">
              
              
                  <div class="col-md-12 mb-3">

                <label for="validationCustom01">{{trans('table.price_item_name')}}:</label>
               <select name="price_item_id" class="form-control" required="">

                      
                    @foreach($priceitem as $key=>$value)
                    
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
             
              </div>
              <div class="col-md-12 mb-3">

                <label for="validationCustom01">{{trans('table.group_item_name')}}:</label>
               <select name="item_group_id" class="form-control" required="">

                     
                    @foreach($priceitemgroup as $key=>$value)
                    
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
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


      