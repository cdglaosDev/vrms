 @php
 $veh_doc = \App\Model\VehicleDocument::whereVehicleId($id)->first();
 @endphp
<form id="myForm" class="form-inline" action="{{url('veh-document',$id )}}" method="post" enctype="multipart/form-data">
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
          @if(!empty($app_doc))
          @if($app_doc[2])
          <a href="">{{$app_doc[2]}}</a>
          @else
        
            <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
          @else
          <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
        </div>
    </td>
    <td>
    @if(!empty($app_doc))
    @if($app_doc[2])
    <a href="" data-filename ="{{ $app_doc[2] }}" data-doc_type_id ="2" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
 
    @endif
    @endif
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
        @if(!empty($app_doc))
        @if($app_doc[5])
          <a href="">{{$app_doc[5]}}</a>
         @else
            <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
        @else
        <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
        @endif
        </div>
    </td>
    <td>
    
      @if(!empty($app_doc))
    @if($app_doc[5])
    <a href="" data-filename ="{{ $app_doc[5] }}" data-doc_type_id ="5" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
   
    @endif
    @endif
  
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
        @if(!empty($app_doc))
        @if($app_doc[4])
          <a href="">{{$app_doc[4]}}</a>
          @else
            <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
          @else
          <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
          @endif
        </div>
    </td>
    <td>  
   
    @if(!empty($app_doc))
    @if($app_doc[4])
    <a href="" data-filename ="{{ $app_doc[4] }}" data-doc_type_id ="4" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
   
    @endif
    @endif
   
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
        @if(!empty($app_doc))
        @if($app_doc[3])
          <a href="">{{$app_doc[3]}}</a>
          @else
          
            <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
          @endif
        @else
        <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
        @endif
        </div>
    </td>
    <td> 
    
    @if(!empty($app_doc))
    @if($app_doc[3])
    <a href="" data-filename ="{{ $app_doc[3] }}" data-doc_type_id ="3" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
     @endif
     @endif
    
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
        @if(!empty($app_doc))
        @if($app_doc[6])
          <a href="">{{$app_doc[6]}}</a>
          @else
            <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
        @else
        <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
        @endif
        </div>
    </td>
    <td> 
    
    @if(!empty($app_doc))
    @if($app_doc[6])
    <a href="" data-filename ="{{ $app_doc[6] }}" data-doc_type_id ="6" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
     @endif
     @endif
   
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
        @if(!empty($app_doc))
        @if($app_doc[7])
          <a href="">{{$app_doc[7]}}</a>
          @else
            <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
          @endif
        @else
        <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
        @endif
        </div>
    </td>
    <td> 
   
    @if(!empty($app_doc)) 
    @if($app_doc[7])
    <a href="" data-filename ="{{ $app_doc[7] }}" data-doc_type_id ="7" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
      @endif
    @endif
   
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
        @if(!empty($app_doc))
        @if($app_doc[8])
          <a href="">{{$app_doc[8]}}</a>
          @else
            <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"  />
          @endif
        @else
        <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   />
        @endif
        </div>
    </td>
    <td>
     
    @if(!empty($app_doc))   
      @if($app_doc[8])
    <a href="" data-filename ="{{ $app_doc[8] }}" data-doc_type_id ="8" data-vehicle_detail_id ="{{ $id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit')}}</a>
   @endif
    @endif
   

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
        <a class="btn btn-info btn-sm  @if(empty($app_doc)) disabled @endif"   href="dscan:{{$license_no ??''}}|{{$id}}|{{$app_doc[2] ?? ''}}|{{$app_doc[5]?? ''}}|{{$app_doc[4]?? ''}}|{{$app_doc[3] ?? ''}}|{{$app_doc[6]}}|{{$app_doc[7]?? ''}}|{{$app_doc[8]?? ''}}">Scan Documents</a>
        @if(!empty($app_doc))
              @if($app_doc[2] == null || $app_doc[3] == null ||$app_doc[4] == null ||$app_doc[5] == null ||$app_doc[6] == null || $app_doc[7] == null || $app_doc[8] == null)
                <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
              @endif
        @else
        <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
        @endif
       
        </div>
        </div>
       
      </form>
  
@include('Module5.importvehicle.editDocFile')

@push('page_scripts')
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script> -->
<script src="{{ asset('js/filevalidate.js') }}"></script>
<script>
     var edit_doc = "{{url('edit-document')}}";
       $(document).on("click", '.editDocument', function (e) {  
         
         $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
         $('[name="vehicle_detail_id"]').val($(this).data('vehicle_detail_id'));
         $('#filearea').html($(this).data('filename'));
         document.getElementById("EditDoc").action = edit_doc;
     });
</script>
@endpush
