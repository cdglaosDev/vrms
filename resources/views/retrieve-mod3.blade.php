@extends('vrms2.layouts.master')
@section('user_report','active') 
@section('content') 

<h3>Retrieve Data Information for module3</h3>
<div class="card-body">
<a class="btn btn-success btn-sm text-white" id="btnExport" onclick="fnExcelReport('LatestData');">Export Excel</a>
   <table id="table" class="table table-bordered">
      <thead>
         <tr>
            <th>Vehicle Kind</th>
            <th>Vehicle Type</th>
            <th>Province</th>
            <th>District</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Color</th>
            <th>Steering</th>
            <th>Engine Brand</th>
            <th>Engine Type</th>
         </tr>
      </thead>
      <tbody>
        <tr>
             <td>
                <table>@foreach($vehKinds as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($vehType as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($provinces as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($districts as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($brands as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($models as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($colors as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($steerings as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($engine_brands as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
            <td>
                <table>@foreach($engine_types as $key=>$value)<tr><td>{{ $value }}</td></tr>@endforeach</table>
            </td>
        </tr>
      </tbody>
   </table>
</div>
@include('includes.exportExcel') 
@endsection 
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('user-report')}}";
   $(".delete").on("submit", function() {
   	return confirm("Are you sure to delete?");
   });
</script> 
@endpush