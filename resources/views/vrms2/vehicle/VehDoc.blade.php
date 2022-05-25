
<form id="myForm" class="form-inline" action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-12 col-md-12 md-offset-12"> 
      
        <table class="table table-bordered" id="app-document"> 
        <thead>
          <tr>
            <th width="400">{{ trans('app_form.doc_type')}}</th>
            <th>{{ trans('app_form.doc_filename')}}</th>
            <th>{{ trans('common.action')}}</th>
          </tr>
        </thead> 
        <tbody>
  <tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]" class="form-control" value="2" />
            <h5>{{ trans('doc_type.lic_import_car') }}</h5>
        </div>
    </td>
    <td>
        <div>
       
          <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
         
        </div>
    </td>
    <td>
   
</td>  
</tr>
<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]"  class="form-control" value="5" />
            <h5>{{ trans('doc_type.import_good') }}</h5>
        </div>
    </td>

    <td>
        <div>
       
        <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
     
        </div>
    </td>
    <td>
 
  
</td>  
</tr>
<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]"  class="form-control" value="4" />
            <h5>{{ trans('doc_type.veh_lic_tech') }}</h5>
        </div>
    </td>
    <td>
        <div>
      
          <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
        
        </div>
    </td>
    <td>  
 
   
</td>  
</tr>

<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]" class="form-control" value="3" />
            <h5>{{ trans('doc_type.lic_ministry') }}</h5>
        </div>
    </td>
    <td>
        <div>
     
        <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
     
        </div>
    </td>
    <td> 
 
    
</td>  
</tr>
<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]" class="form-control" value="6" />
            <h5>{{ trans('doc_type.tax_return') }}</h5>
        </div>
    </td>
    <td>
        <div>
    
        <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
       
        </div>
    </td>
    <td> 
  
   
</td>  
</tr>
<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]" class="form-control" value="7" />
            <h5>{{ trans('doc_type.tax_relief') }}</h5>
        </div>
    </td>
    <td>
        <div>
       
        <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
       
        </div>
    </td>
    <td> 
   
   
</td>  
</tr>
<tr class="attach_doc">
    <td>
        <div>
            <input type="hidden" name="doc_type_id[]" class="form-control" value="8" />
            <h5>{{ trans('doc_type.record') }}</h5>
        </div>
    </td>
    <td>
        <div>
      
        <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
       
        </div>
    </td>
    <td>
     
 
</td>  
</tr> </tbody>
                   
</table>
        </div>
        <div class="row mt-3 mx-0">
        <div class="col-md-9">
        <div class="form-row">
          <label  for="email">Location:</label>
          <input type="text" type="text" class="form-control col-md-1" name="location" placeholder="Location"  @if(!empty($app_doc))  value="{{ $veh_doc->location ?? ''}}" @else value="" @endif>&nbsp;
          <label for="email">Floor:</label>
          <input type="text" type="text" class="form-control col-md-1" name="floor" placeholder="floor" @if(!empty($app_doc)) value="{{ $veh_doc->floor ?? '' }}" @else value="" @endif>&nbsp;
          <label for="email">Channel:</label>
          <input type="text" type="text" class="form-control col-md-1" name="channel" placeholder="Channel" @if(!empty($app_doc)) value="{{ $veh_doc->channel ?? '' }}" @else value="" @endif>&nbsp;
          <label for="email">Row:</label>
          <input type="text" type="text" class="form-control col-md-1" name="row" placeholder="row" @if(!empty($app_doc)) value="{{ $veh_doc->row ?? '' }}" @else value="" @endif>&nbsp;
          <label for="email">Note:</label>
          <input type="text" type="text" class="form-control col-md-3" name="location_note" placeholder="note" @if(!empty($app_doc)) value="{{ $veh_doc->location_note ?? '' }}" @else value="" @endif>
           
        </div>
          
        </div>
        <div class="col-md-3 text-right">
        <a class="btn btn-info btn-sm">Scan Documents</a>
        
        <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
      
       
        </div>
        </div>
       
      </form>
  

