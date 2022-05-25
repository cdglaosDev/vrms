@extends('layouts.master')
@section('receive','active')
@section('title','Receipt Lists')
@section('content')

		<div class="table-responsive">
	<table id="bs4-table"  class="table-bordered ">
											<thead>
												<tr>
													<th>Serial Number</th>
													<th>Title</th>
													<th>Amount</th>
													<th>TextBox1</th>
													<th>TextBox2</th>
													<th>TextBox3</th>
													<th>TextBox4</th>
													
													<th>Action</th>

												</tr>
											</thead>
											<tbody>
												@foreach($receive as $data)
												<tr>
													<td>{{$data->srno}}</td>
													<td>{{$data->title}}</td>
													<td>{{$data->amt}}</td>
													<td>{{$data->txt1}}</td>
													<td>{{$data->txt2}}</td>
													<td>{{$data->txt3}}</td>
													
													<td>{{$data->txt4}}</td>
													
													<td>
												
												<a href="" class="delete-btn"
                        data-toggle="modal" data-target="#Delete"
                        data-act="Delete"
                        data-id="{{$data->id}}">Delete
                    </a>
												</td>
												</tr>
												@endforeach

											</tbody>

	</table>

</div>

@component('component.delete')
@endcomponent

@endsection
@push('page_scripts')

<script>
   $(document).ready(function() {
        var base_url = "{{url('receive')}}";
        
       $(document).on("click", '.delete-btn', function (e) {  
        document.getElementById("delform").action = base_url+"/"+$(this).data('id');
        });

   });

</script>

@endpush
