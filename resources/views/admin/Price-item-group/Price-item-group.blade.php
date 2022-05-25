@extends('layouts.master')
@section('finance','active')
@section('content') 
   
     <h1 class="page-header">{{trans('title.price_item_group')}}</h1>
    <div class="panel panel-inverse">
    @include('flash')
    <div class="row">
    <div class="col-lg-12 add-new">
       @can('user-create')
        <div class="pull-left">
            <a class="btn btn-primary btn-save" href="{{ route('Price-item-group.create') }}"> {{trans('button.price_item_group')}}</a>
        </div>
        @endcan
    </div>
</div> 
          

       <div class="panel-body">
         <table id="myTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
           
                <th>{{trans('book.group_code')}}</th>
                 <th>{{trans('book.group_name')}}</th>
                  <th>{{trans('book.group_name_en')}}</th>
                  <th>{{trans('book.group_note')}}</th>
                 <th>{{trans('table.status')}}</th>
                 <th>{{trans('table.action')}}</th>
              
              </tr>
            </thead>
            <tbody>
              @foreach($appbooks as $key=>$datas)
                        <tr>
                            <td>{{$datas->group_code}}</td>
                            <td>{{$datas->group_name}}</td>
                              
                               <td>{{$datas->group_name_en}}</td>
                         <td>{{$datas->group_note}}</td>
                                <td>

                        <a href="{{route('Price-item-group.edit',['id'=>$datas->id])}}" class="btn btn-info btn-sm">{{ trans('finance_button.edit') }}</a>
                      
                            
                  <a href="#" data-id="{{$datas->id}}"  data-toggle="modal" data-target="#deleteModel" data-act="Delete" class="btn btn-danger btn-sm remove ">{{ trans('table.delete') }}</a></td>
                          <td>@if($datas->status ==1){{trans('table.active')}} @else {{trans('table.deactive')}} @endif</td>
                        </tr>  
                         @endforeach 
              
            </tbody>
          </table>
         
        </div>
        
      </div>
  
      @include('delete')
@endsection

@push('page_scripts')

 <script type="text/javascript">
    
     var base_url = "{{url('admin/Price-item-group')}}";
      
     $(document).on("click", '.remove', function (e) {  
            
            document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
        });

       

    </script>
@endpush