@extends('layouts.master')
@section('importer','active')
@section('content')

<!-- begin #content -->
<h1 class="page-header">{{trans('title.user_list')}}</h1>
<div class="panel panel-inverse">
    @include('flash')
  <div class="row">
    <div class="col-lg-12 add-new">
       @can('user-create')
        <div class="pull-left">
            <a class="btn btn-primary btn-save" href="{{ route('importer.create') }}"> {{trans('button.add_user')}}</a>
        </div>
        @endcan
    </div>
</div>
        <div class="panel-body">
           <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                
                
                <th class="text-nowrap">Name</th>
                <th class="text-nowrap">Email</th>
                <th class="text-nowrap">LoginId</th>
                <th class="text-nowrap">Roles</th>
               
                <th class="text-nowrap">Action</th>
              </tr>
            </thead>
          <tbody>
                @foreach ($data as $key => $user)
                  <tr>
                    
                    
                     <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->login_id }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-info ">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    
    <td>

       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">{{trans('button.show')}}</a>
       @can('user-edit') <a class="btn btn-success" href="{{ route('users.edit',$user->id) }}">{{trans('button.edit')}}</a>@endcan
       @can('reset-pass')   {!! Form::open(['method' => 'POST','route' => ['users.reset', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Reset Password', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
        @endcan
         @can('user-delete')
        <button type="button" class="btn btn-danger  delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete"
                        data-id="{{$user->id}}">{{trans('button.delete')}}
          </button>
          @endcan
    </td>
                  </tr>
                   @endforeach
                
                  </tbody>
          </table>
          {!! $data->render() !!}
        </div>
      </div>
        <!-- end panel-body -->
     
@include('delete')
@endsection

@push('page_scripts')

<script type="text/javascript">
    
     var myTable = $('#myTable').DataTable(); 
    var base_url = "{{url('users')}}";
   
    $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });
   </script>
@endpush