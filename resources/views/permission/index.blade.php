@extends('vrms2.layouts.master')
@section('content')
@section('permission','active')
@include('vrms2.mod1-submenu')
<!-- begin #content -->
<h3>{{trans('title.per_list')}}</h3>
@include('flash')
<div class="card-body">
  
      <div class="table-responsive">
         <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
               <tr>
               <th>{{trans('common.name')}}</th>
              
               </tr>
            </thead>
            <tbody>
            @foreach ($permission as $data)
               <tr>
                <td>{{ $data->name }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
  
</div>

@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/permission')}}";
   var getPtype = "{{url('/getPtype')}}";
   $(document).on("click", '.delete_btn', function (e) {  
      document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
   });
   
   $(document).on("click", '.edit_btn', function (e) { 
    $('[name="name"]').val($(this).data('name'));
    $('[name="type"]').val($(this).data('type'));
      document.getElementById("editform").action = base_url+"/"+$(this).data('id');
      });
    
   
   
</script>
@endpush