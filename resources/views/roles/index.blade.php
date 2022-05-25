@extends('vrms2.layouts.master')
@section('role', 'active')
@section('content')
@include('vrms2.mod1-submenu')
<!-- begin #content -->
<h3>{{trans('title.role_list')}}
  @can('Role-List-Create')
    <a class="btn btn-primary btn-sm btn-save" data-toggle="modal" data-target="#addModel" data-backdrop="static" data-keyboard="false"> {{trans('button.add_role')}}</a>
  @endcan
</h3>
@if($errors->any())
    <div class="alert alert-dismissable alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach          
      </strong>
    </div>
  @endif
@include('flash')
<div class="card-body">
  
      <div class="table-responsive">
         <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
               <tr>
                  <th class="text-nowrap">{{trans('user.name')}}</th>
                  <th class="text-nowrap">{{ trans('common.action')}}</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($roles as $key => $role)
               <tr>
                  <td>{{ $role->name }}</td>
                  <td>
                     <a class="show_btn" title="{{ trans('title.view') }}" data-url="{{ url('roles',['id'=>$role->id])}}" data-toggle="modal"  data-target="#showModal" 
                     data-backdrop="static" data-keyboard="false"><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25px"></a>
                     @can('Role-Entry-Edit')
                     <a class="btn_edit" title="{{ trans('title.edit') }}" data-backdrop="static" data-keyboard="false" data-url="{{ route('roles.edit',$role->id) }}" data-toggle="modal"  data-target="#editModal" ><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"></a>
                     @endcan
                     @can('Role-Entry-Delete')
                     <a  class="delete_btn" title="{{ trans('title.delete') }}"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete" data-backdrop="static" data-keyboard="false"
                        data-id="{{$role->id}}"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25px">
</a>
                     @endcan
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
  
</div>
<!-- show role modal popup -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->
@include('delete')
@include('showModal')
@include('roles.roleModal')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('roles')}}";
   var roles = {!! $roles !!};
   var roleData = [];
   roles.forEach(function(item){
      roleData.push(item.name);
   });
  
   $(document).on("click", '.delete_btn', function (e) { 
      document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
   });
</script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
@endpush