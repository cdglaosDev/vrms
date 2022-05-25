@extends('layouts.master')
@section('finance','active')
@section('content') 

    <h1 class="page-header">{{trans('book.price_item_gruop_detail')}}</h1>
    
  
    <div class="panel panel-inverse">

    @include('flash') 
   
        <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
               <th>{{trans('book.item_code')}}</th>
               <th>{{trans('book.group_code')}}</th>
               <th>{{trans('book.price_item_name')}}</th>
								<th>{{trans('book.price_item_group_name')}}</th>
							 <th>{{trans('book.group_note')}}</th>
								
                
              </tr>
            </thead>
            <tbody>
             @foreach($groupitems as $key=>$groupdetail)
                        <tr>
                            <td>{{$groupdetail->pricegroup['group_code']}}</td>
                             <td>{{$groupdetail->priceitem['code']}} </td>
                              <td>{{$groupdetail->pricegroup['group_name']}}({{$groupdetail->pricegroup['group_name_en']}})</td>
                             <td>{{$groupdetail->priceitem['name']}}({{$groupdetail->priceitem['name_en']}}) </td>
                              <td>{{$groupdetail->pricegroup['group_note']}}</td>
                              
                          
                        </tr>  
                         @endforeach 
              
            </tbody>
          </table>
         
        </div>
        
      </div>
  
    
@endsection

 
@push('page_scripts')
 <script type="text/javascript">
 
     var base_url = "{{url('admin/price_itemgroup_detail')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

        
    </script>

@endpush