@extends('layouts.master')
@section('importer','active')
@section('content')	
		<h1 class="page-header">Pre Registration App</h1>
		<div class="panel panel-inverse">
		@include('flash')

	 <div class="row">
    <div class="col-lg-12 add-new">
       
        <div class="pull-left">
            <a class="btn btn-primary btn-save" href="{{ route('pre-reg-app.create') }}">Add New</a>
        </div>
      
    </div>
</div>
		

		<div class="panel-body">

         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
							<tr>
								
								<th> Staff Name</th>
								<th>User Name</th>
								<th>Application Number </th>
								<th>Reg Application Number </th>
								<th> Date Request</th>
								<th>Action</th>
							</tr>
				</thead>
				<tbody>
						  @foreach($appformdetails as $prereg)
                        <tr>
              
                             
                                <td>@if(isset($prereg-> staff -> name))<span>{{$prereg->staff['name']}}({{$prereg->staff['name_en']}})</span>@else{{"_"}}@endif</td>
                                <td>@if(isset($prereg-> user -> name))<span>{{$prereg->user['first_name']}}({{$prereg->user['last_name']}})</span>@else{{"_"}}@endif</td>

                         
                             <td>@if(isset($prereg->app_number))<span>{{$prereg->app_number}}</span>@else{{"_"}}@endif</td>

                              <td>@if(isset($prereg->regapp_number))<span>{{$prereg->regapp_number}}</span>@else{{"_"}}@endif</td>
                              
                               <td>{{$prereg->date_request}}</td>
                               
                                <td>

      <a href="{{route('pre-reg-app.show',['id'=>$prereg->id])}}" class="btn btn-sm btn-primary">{{trans('button.show')}}</a>
        <button type="button" class="btn btn-danger btn-sm  delete_btn"
                        data-toggle="modal" data-target="#deleteModel"
                        data-act="Delete"
                        data-id="{{$prereg->id}}">{{trans('button.delete')}}
          </button>
        
    </td>
    
                        </tr>  
                         @endforeach 
                         </tbody>
					</table>
				
				</div>
			</div>

@component('component.admin.pre-reg-app')
 @endcomponent

 @endsection 
@push('page_scripts')

 <script type="text/javascript">
  var myTable = $('#myTable').DataTable(); 
     var base_url = "{{url('/pre-reg-app')}}";
      
     $(document).on("click", '.delete_btn', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

      
    </script>
@endpush