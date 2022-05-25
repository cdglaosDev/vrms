<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form enctype="multipart/form-data" action="{{route('document-management.store')}}"  method="POST">
                  @method('post')
                  @csrf
            
         <div class="modal-header">
                <div class="col-md-11 text-center">
                        <h3 class="text-center"> Document Management</h3>
               </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
         </div>        
        
          <div class="modal-body">
            <div class="form-row">
               <div class="col-md-6 mb-1">

                <label for="validationCustom01">Vehicle:</label>
               <input type="text" name="license_no" min="10" value="" class="form-control" placeholder="Enter License Number">
              </div>
              
               <div class="col-md-6 mb-1">

                <label for="validationCustom01">Application Doc Type:</label>
                <select name="doc_type_id" class="form-control selectpicker" data-live-search="true" required="">

                     <option value="" selected disabled hidden>-- Select Application Doc Type-- </option>
                    @foreach($vehdocument as $data)
                   
                         <option value="{{ $data->id}}" class="style1">{{ $data->name }}({{ $data->name_en}})</option>
                    @endforeach
                </select>
              </div>
              
              </div>     
                <div class="form-row">  
                <div class="col-md-6 mb-1">
                <label for="validationCustom01">File Name:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter File Name" name="filename" required="">
              </div>       
              <div class="col-md-6 mb-1">
                <label for="exampleInputPassword1">Date:</label>
               <input type="text" name="date" class="form-control" id="date" placeholder="Enter Validate Date" required="">  
              </div>
          
              </div>
               <div class="form-row">  
               <div class="col-md-6 mb-1">

                  <label for="validationCustom01">Province:</label>
                  <select name="province_code" class="form-control selectpicker" data-live-search="true" required="">

                    <option value="" selected disabled hidden>-- Select Province Name-- </option>
                  @foreach($province as $data)

                        <option value="{{ $data->province_code}}" class="style1">{{ $data->name}}({{ $data->name_en}})</option>
                  @endforeach
                  </select>
                  </div>

                  <div class="col-md-6 mb-1">
                  <label for="validationCustom01">Location:</label>
                  <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Location" name="location" required="">
                  </div>       
              <div class="col-md-6 mb-1">
                <label for="validationCustom01">Floor:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Floor" name="floor" required="">
              </div>
               <div class="col-md-6 mb-1">
                <label for="">Channel:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Channel" name="channel" >
              </div>
               <div class="col-md-6 mb-1">
                <label for="">Link:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Link" name="link" >
              </div>
              <div class="col-md-6 mb-1">
                <label for="validationCustom01">Note:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Note" name="note" required="">
              </div>
              </div>
          <div class="form-row">         
              
              <div class="col-md-4 mb-1">
                <label for="validationCustom01" >{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
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

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="editform" name="editform" method="POST">
                 
                  @method('PATCH')
                  @csrf
                  
          <h3 class="text-center">Update Document Management</h3>
           
            <div class="form-row">
               <div class="col-md-6 mb-3">

                <label for="validationCustom01">Vehicle:</label>
                <input type="text" name="license_no" value="" min="10" class="form-control" placeholder="Enter License Number">
               
              </div>
              
               <div class="col-md-6 mb-3">

                <label for="validationCustom01">Application Doc Type:</label>
                <select name="doc_type_id" class="form-control"  required="">

                     <option value="" selected disabled hidden>-- Select Application Doc Type-- </option>
                    @foreach($vehdocument as $data)
                   
                         <option value="{{ $data->id}}" class="style1">{{ $data->name }}({{ $data->name_en}})</option>
                    @endforeach
                </select>
              </div>
                <div class="col-md-6 mb-3">
                <label for="validationCustom01">File Name:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter File Name" name="filename" required="">
              </div>
                    
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Date:</label>
               <input type="text" name="date" class="date form-control" id="issue_date" placeholder="Enter Validate Date" required=""> 
              </div>
             <div class="col-md-6 mb-3">

                <label for="validationCustom01">Province:</label>
                <select name="province_code" class="form-control"  required="">

                     <option value="" selected disabled hidden>-- Select Province Name-- </option>
                    @foreach($province as $data)
                   
                         <option value="{{ $data->province_code}}" class="style1">{{ $data->name}}({{ $data->name_en}})</option>
                    @endforeach
                </select>
              </div>
              
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Location:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="" name="location" required="">
              </div>
                     
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Floor:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Abbreviation Name(Laos)" name="floor" required="">
              </div>
               <div class="col-md-6 mb-3">
                <label for="">Channel:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Abbreviation Name(English)" name="channel" >
              </div>
               <div class="col-md-6 mb-3">
                <label for="">Link:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Abbreviation Name(English)" name="link" >
              </div>
                   
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Note:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Abbreviation Name(Laos)" name="note" required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom01" >{{trans('common.status')}}:</label>
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
      


 