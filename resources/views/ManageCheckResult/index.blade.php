@extends('layouts.master')
@section('vims','active')
@section('content') 
    <h1 class="page-header">{{trans('gas_standard_check.mange_ch_result')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <form action="check-result/create">
                    <button type="submit" class="btn btn-primary btn-save">{{trans('gas_standard_check.add_ch_result')}}</button>
                </form>
            </div>
        </div>
    </div>
    

    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>{{trans('gas_standard_check.app_form_id')}}</th>
                <th>{{trans('gas_standard_check.check_name')}}</th>
                <th>{{trans('gas_standard_check.check_name_en')}}</th>
                <th>{{trans('gas_standard_check.check_result')}}</th>
                <th>{{trans('gas_standard_check.check_remark')}}</th>
                <th>{{trans('gas_standard_check.action')}}</th>
              </tr>
        </thead>
        <tbody>
              @foreach ($checkresult as $checkresult)
                        <tr>
                              <td>@if (isset($checkresult -> AppForm -> app_number)){{$checkresult -> AppForm -> app_number}}@else{{" _ "}}@endif</td>
                              <td>{{$checkresult -> name}}</td>
                              <td>{{$checkresult -> name_en}}</td>
                              <td>{{$checkresult -> result}}</td>
                              <td>{{$checkresult -> remark}}</td>
                        <td>

                        <form class="delete" action="/check-result/{{$checkresult -> id}}" method="POST">
                          @method('DELETE')
                          @csrf
                          <a href="{{route('check-result.edit',['id'=>$checkresult -> id])}}" class="btn btn-primary btn-sm">{{ trans('button.edit') }}</a>
                          <button type="submit" class="btn btn-sm btn-danger">{{trans('button.delete')}}</button>
                      </form>
                          
                        </td>
                    </tr>  
                         @endforeach 
                         </tbody>
          </table>
        
        </div>
      </div>
@endsection

  
@push('page_scripts')

 <script type="text/javascript">
 var myTable = $('#myTable').DataTable(); 
    var base_url = "{{url('gas')}}";

          $(".delete").on("submit", function(){
          return confirm("Are you sure to delete?");
    });

    </script>
@endpush