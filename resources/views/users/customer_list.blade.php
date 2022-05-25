@extends('vrms2.layouts.master')
@section('customer', 'active')
@section('content')
@include('vrms2.mod1-submenu')
<!-- begin #content -->
<h3>{{trans('title.cust_list')}}</h3>
@include('flash')
<style>
	#customer tr>td{
		vertical-align: middle;
	}
</style>
	<div class="card-body pt-1"> 
		<div class="table-responsive">
			<table id="customer" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>{{trans('user.name')}}</th>
						<th>{{trans('user.email')}}</th>
						<th >LoginId</th>
						<th>{{trans('common.status')}}</th>
						<th>{{trans('common.action')}}</th>
						</th>
					</tr>
				</thead>
				<tbody> @foreach ($data as $key => $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->login_id }}</td>
						<td>
							<form method="post" action=""> @csrf
								<select name="customer_status" class="customer_status" job="{{$user->id}}"> @foreach(\App\User::getEnumList("customer_status") as $key => $value)
									<option value="{{$key}}" {{$key==$user->customer_status?"selected":""}}>{{$value}}</option> @endforeach </select>
							</form>
						</td>
						<td> <a class="show_btn" data-toggle="modal" title="{{ trans('title.view') }}" data-target="#showModal"
               				data-url="{{ url('users',['id'=>$user->id])}}" data-backdrop="static" data-keyboard="false"><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25px"></a>
							<form style="display:inline" action="{{route('users.reset',$user->id) }}" method="POST">
								<input type="hidden" name="_method" value="Post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
								<button class="border-0" style="background:none" title="Reset Password"><img src="{{ asset('images/reset_password.png') }}" alt="" width="25" height="25px"></button>
							</form> @can('Customer-Delete')
							<button type="button" class="delete_btn border-0 p-0" title="{{ trans('title.delete') }}" data-toggle="modal" data-target="#deleteModel" data-act="Delete" data-id="{{$user->id}}"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25px"> </button> @endcan </td>
					</tr> 
          		@endforeach 
        
        </tbody>
			</table>
		</div>
	</div>

<!-- end panel-body -->
@include('showModal')
@include('delete') 
@endsection 
@push('page_scripts')
<script type="text/javascript">
$('#customer').dataTable( {
  "ordering": false
} );
var base_url = "{{url('users')}}";
var s_url = "{{url('change-status')}}";
var image_url= "{{url('/images/customer')}}";
$(".customer_status").change(function() {
	var url = s_url + "/" + $(this).attr("job") + "/status/" + $(this).val();
	$(this).parent().attr("action", url);
	$(this).parent().submit();
});
$(document).on("click", '.delete_btn', function(e) {
	document.getElementById("deleteform").action = base_url + "/" + $(this).data('id');
});

</script> 
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
@endpush