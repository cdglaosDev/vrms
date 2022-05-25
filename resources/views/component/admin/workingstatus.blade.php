<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form  action="{{route('working-status.store')}}"  method="POST">
                  @method('post')
                  @csrf

            <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">{{trans('table.working')}}</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
          </div>  
        
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table.namel')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('table.placeholder_working_status')}}" name="name" required="">
              </div>
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table.namee')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="{{trans('table.placeholder_working_status_eng')}}" name="name_en" required="">
              </div>
               <div class="col-md-12 mb-3">
                <label for="validationCustom01"> {{trans('table.description')}}:</label>
                <textarea name="description" rows="3" class="form-control" id="validationCustom01" placeholder="Enter Working Status Description" required=""></textarea>
              </div>
               <div class="col-md-12 mb-3">
                <label  for="validationCustom01">{{trans('table.workingstatusgroup')}}:</label>
                <select class="form-control selectpicker" data-live-search="true" name="working_status_group_id" required="">
                   <option value="" selected disabled hidden>-- Select Working Status Group Name-- </option>
                  @foreach($working as $data)
                 
                   <option value="{{ $data->id }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                 @endforeach
                </select>
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

 <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
                @method('PATCH')
               @csrf
         

            <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">{{trans('table.working1')}}</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
          </div>            
         
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table.namel')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Working Status Name" name="name" required="">
              </div>
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('table.namee')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Working Status Name" name="name_en" required="">
              </div>
             
               <div class="col-md-12 mb-3">
                <label for="validationCustom01"> {{trans('table.description')}}:</label>
                <textarea name="description" rows="3" class="form-control" id="validationCustom01" placeholder="Enter Working Status Group Description" required=""></textarea>
              </div>
             <div class="col-md-12 mb-3">
                <label>{{trans('table.workingstatusgroup')}}:</label>
                <select class="form-control"  name="working_status_group_id">
                  @foreach($working as $data)
                  <option value="{{ $data->id }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                 @endforeach
                </select>
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

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="deleteform"  method="post">
            @method('Delete')
            {{ csrf_field() }}

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
                  <input type="submit" class="btn btn-danger " value="{{trans('table.delete')}}">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
