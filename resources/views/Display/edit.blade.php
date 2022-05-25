@extends('layouts.master')
@section('display','active')
@section('content') 
    <h1 class="page-header">{{trans('title.mang_display')}}</h1>
    <div class="panel panel-inverse">
        @include('flash') 
        <div class="panel-body">
        <form action="{{route('display.update',['display'=> $display])}}" method="POST">
            @method('PATCH')
            @csrf
                <table id="myTable" style="width:50%">
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="app_number" value="{{$display->app_number}}" readonly=""></td>
                            <td><input type="hidden" class="form-control" name="status" value="{{$display->status}}"></td>
                            <td>
                                <button type="submit" class="btn btn-primary">{{$display->status}}</button>
                                <a href="{{ route('display.delete', $display->id) }}" data-method="delete" data-token="{{csrf_token()}}" class="btn btn-danger">{{"Cancel"}}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
              
            </div>
            </div>
@endsection
@push('page_scripts')
      
<script type="text/javascript">

var base_url = "{{url('display')}}";
    
    $(".delete").on("submit", function(){
        return confirm("Are you sure to delete?");
    });
      
</script>
@endpush
   