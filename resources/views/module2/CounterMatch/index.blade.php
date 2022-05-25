@extends('vrms2.layouts.master')
@section('counter_match', 'active')
@section('content')
@include('vrms2.mod2-submenu') 
<h3>{{ trans('finance_title.service_counter_title')}}
   @can('Service-Counter-Matching-Create')
   <a data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-save btn-sm text-white">{{trans('common.add_new')}}</a>
   @endcan
</h3>
@include('flash') 
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{ trans('finance_title.service_counter') }}</th>
            <th>{{ trans('common.province') }}</th>
            <th>{{ trans('app_form.staff') }}</th>
            <th>{{ trans('finance_title.start_bill_no') }}</th>
            <th>{{ trans('finance_title.bill_no_present') }}</th>
            <th>{{trans('common.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @if($counter->isNotEmpty())
         @foreach($counter as $my_counter)
         <tr>
            <td>{{$my_counter->service_counter->name ?? ''}} ({{$my_counter->service_counter->name_en ?? ''}})</td>
            <td>{{$my_counter->province->name ?? ''}} ({{$my_counter->province->name_en ?? ''}})</td>
            <td>{{$my_counter->user->name ?? ''}}</td>
            <td>{{ $my_counter->start_bill_no}}</td>
            <td>{{ $my_counter->bill_no_present }}</td>
            <td>
               @can('Service-Counter-Matching-Edit')
               <a href="" class="btn_edit" data-toggle="modal" title="{{ trans('title.edit') }}" data-target="#editModal" data-backdrop="static" data-keyboard="false" data-url="{{ route('counter-matching.edit',['id'=>$my_counter->id])}}"><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"></a>
               @endcan
               @can('Service-Counter-Matching-Delete')
               <a href="" title="{{ trans('title.delete') }}" class="delete_btn"
                  data-toggle="modal" data-target="#deleteModel"
                  data-id="{{$my_counter->id}}"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25px"></a>
               @endcan
            </td>
         </tr>
         @endforeach
         @endif
      </tbody>
   </table>
</div>
<!-- show role modal popup -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
@include('module2.CounterMatch.addModal',['counter_match' =>$counter])
@include('delete')
@endsection 
@push('page_scripts')
<script type="text/javascript">
 
   var base_url = "{{url('/counter-matching')}}";
      
   $(document).on("click", '.delete_btn', function (e) { 
      document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
   });

   //get counter and users depend on province
   $('#province').change(function() {
   var province_code = $(this).val(); 
   if (province_code) {
      $.ajax({
         type:"GET",
            url:'/get-service-counter'+ "/"+province_code,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
         success:function(data) {  
            if (data) {
               console.log(data);
               $("#service, #staff").empty();
               $("#service,  #staff").append('<option value="" selected disabled hidden> Select</option>');
               $.each(data.service_counters, function(key, value){
                  $("#service").append('<option value="'+key+'">'+value+'</option>');
               });
               $.each(data.users, function(key, value){
                  $("#staff").append('<option value="'+value.id+'">'+value.first_name+' '+value.last_name+'</option>');
               });
         
            } else {
               $("#service,  #staff").empty();
            }
         }
      });
   } else {
      $("#service,  #staff").empty();
      
   }      
   });
      //check space for license no booking input box
      $('.bill_no').keyup(function(e){
         code = $(this).val().replace(/[^0-9-_]/g,'');
         $(this).val(code);
      });
   
</script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>

@endpush