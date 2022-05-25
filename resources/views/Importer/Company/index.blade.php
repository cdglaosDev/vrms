@extends('layouts.master')
@section('importer','active')
@section('content') 
    <h1 class="page-header">{{trans('importer.manage_imp_com')}}</h1>
    <div class="panel panel-inverse">
    @include('flash') 
  <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <form action="import-company/create">
                    <button type="submit" class="btn btn-primary btn-save">{{trans('importer.add_new_imp_com')}}</button>
                </form>
            </div>
        </div>
    </div>
    

    <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>{{trans('importer.contact_name')}}</th>
                <th>{{trans('importer.contact_ph')}}</th>
                <th>{{trans('importer.com_name')}}</th>
                <th>{{trans('importer.com_tax_no')}}</th>
                <th>{{trans('finance_title.action')}}</th>
              </tr>
        </thead>
        <tbody>
              @foreach ($importercompany as $importercompany)
                        <tr>
                              <td>{{$importercompany -> contact_name}}</td>
                              <td>{{$importercompany -> contact_phone}}</td>
                              <td>{{$importercompany -> name}}</td>
                              <td>{{$importercompany -> tax_number}}</td>
                        <td>
                        
                        <form class="delete" action="/import-company/{{$importercompany -> id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('import-company.edit',['id'=>$importercompany->id])}}" class="btn btn-primary btn-sm">{{ trans('finance_button.edit') }}</a>
                            <a href="{{route('import-company.show',['id'=>$importercompany->id])}}" class="btn btn-info btn-sm">{{trans('button.show')}}</a>
                            <button type="submit" class="btn btn-danger btn-sm">{{trans('button.delete')}}</button>
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
    var base_url = "{{url('finance')}}";
 
          $(".delete").on("submit", function(){
          return confirm("Are you sure to delete?");
    });

    </script>
@endpush