@extends('customer.layouts.master')
@section('vehicle','active')
@section('content')
@include('flash')
<h1 class="page-header">{{ trans('app_form.app_doc') }}</h1>
<div class="card">
   <div class="card-body">
            <form id="myForm" action="{{url('/customer/attach-document',$vehicle->id )}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="col-sm-12 col-md-12 md-offset-12"> 
                 
                  <table class="table table-bordered" id="app-document"> 
                             <thead>
                               <tr>
                                 <th width="400">{{ trans('app_form.doc_type') }}</th>
                                 <th>{{ trans('app_form.doc_filename') }}</th>
                                 <th>{{ trans('customer.action') }}</th>
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
                 <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
               @endif
              @else
              <input type="file" name="2" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename"   id="filename" />
              @endif
             </div>
         </td>
         <td>
         @if(!empty($app_doc))
         @if($app_doc[2])
         <a href="" data-filename ="{{ $app_doc[2] }}" data-doc_type_id ="2" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
      
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
                 <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
            @else
            <input type="file" name="5" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
            @endif
             </div>
         </td>
         <td>
         @if(!empty($app_doc))
         @if($app_doc[5])
         <a href="" data-filename ="{{ $app_doc[5] }}" data-doc_type_id ="5" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
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
                 <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
            @else
            <input type="file" name="4" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
            @endif
             </div>
         </td>
         <td>  
         @if(!empty($app_doc))
         @if($app_doc[4])
         <a href="" data-filename ="{{ $app_doc[4] }}" data-doc_type_id ="4" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
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
               
                 <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
            @else
            <input type="file" name="3" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
            @endif
             </div>
         </td>
         <td> 
         @if(!empty($app_doc))
         @if($app_doc[3])
         <a href="" data-filename ="{{ $app_doc[3] }}" data-doc_type_id ="3" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
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
                 <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
            @else
            <input type="file" name="6" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
            @endif
             </div>
         </td>
         <td> 
         @if(!empty($app_doc)) 
         @if($app_doc[6])
         <a href="" data-filename ="{{ $app_doc[6] }}" data-doc_type_id ="6" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
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
                 <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
            @else
            <input type="file" name="7" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
            @endif
             </div>
         </td>
         <td> 
         @if(!empty($app_doc))
         @if($app_doc[7])
         <a href="" data-filename ="{{ $app_doc[7] }}" data-doc_type_id ="7" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
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
                 <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
               @endif
              @else
              <input type="file" name="8" accept=".pdf,.png,.jpg,.jpeg" class="form-control filename" id="filename"  />
              @endif
             </div>
         </td>
         <td>
         @if(!empty($app_doc)) 
           @if($app_doc[8])
         <a href="" data-filename ="{{ $app_doc[8] }}" data-doc_type_id ="8" data-vehicle_detail_id ="{{ $vehicle->id }}"  data-toggle="modal" data-target="#editDoc"  class="btn btn-info btn-sm editDocument">{{ trans('button.edit') }}</a>
        @endif
         @endif
         
     
     </td>  
     </tr> </tbody>
                        
     </table>
             </div>
             <div class="row  pt-4">
              <div class="col-md-6 text-left">
                <a href="{{route('vehicle-detail.index')}}" class="btn btn-secondary btn-sm" type="submit">{{ trans('button.back') }}</a>
                <a href="{{route('vehicle-detail.edit',['id'=>$vehicle['id']])}}" class="btn btn-secondary btn-sm">{{ trans('button.previous') }}</a>
              </div>
             <div class="col-md-6 text-right">
             
             @if($vehicle->regapps['app_status_id'] ==4)
              <a href="#" class="btn btn-secondary btn-sm  disabled">{{ trans('button.save') }}</a>
              @else
              @if(!empty($app_doc))
                  @if($app_doc[2] == null || $app_doc[3] == null ||$app_doc[4] == null ||$app_doc[5] == null ||$app_doc[6] == null || $app_doc[7] == null || $app_doc[8] == null)
                    <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
                  @endif
              @else
                <input type="submit" value="{{ trans('button.save')}}" class="btn btn-success btn-sm" onClick="return validate()">
              @endif
            @endif
            
             </div>
            
            </div>
            
           </form>
   </div>
</div>
@include('Module5.importvehicle.editDocFile')
@endsection
@push('page_scripts')
<script>
  var edit_doc = "{{url('/customer/edit-document')}}";
  $(document).on("click", '.editDocument', function (e) {  
          
          $('[name="doc_type_id"]').val($(this).data('doc_type_id'));
          $('[name="vehicle_detail_id"]').val($(this).data('vehicle_detail_id'));
          $('#filearea').html($(this).data('filename'));
          document.getElementById("EditDoc").action = edit_doc;
  });
</script>

  <script src="{{ asset('js/filevalidate.js') }}"></script>
@endpush
