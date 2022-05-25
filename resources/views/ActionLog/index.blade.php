@extends('vrms2.layouts.master')
@section('action_log','active')
@section('content')
<h3>{{trans('sidebar.action_log')}}</h3>

@include('flash')
{{-- <div class="row">
        <div class="col-lg-12 add-new">
           
            <div class="pull-left">
                <form action="finance/create">
                    <button type="submit" class="btn btn-primary btn-save">{{trans('finance_button.add_price_item')}}</button>
</form>
</div>
</div>
</div> --}}


<div class="card-body">
  <table id="myTable" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>{{trans('title.tbl_name')}}</th>
        <th>{{trans('title.user_id')}}</th>
        {{-- <th>{{trans('title.record_id')}}</th> --}}
        <th>{{trans('title.active_action')}}</th>
        <th>{{trans('title.active_date')}}</th>
        <th>{{trans('title.ip_address')}}</th>

        <th>{{trans('title.active_action')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($action_log as $action_log)
      <tr>
        <td>{{$action_log -> table_name}}</td>
        <td>@if(isset($action_log -> users -> first_name)){{$action_log -> users -> first_name}} {{$action_log -> users -> last_name}} ({{$action_log -> users -> login_id}})@else{{"_"}}@endif</td>
        {{-- <td>{{$action_log -> record_id}}</td> --}}
        <td>{{$action_log -> action}}</td>
        <td>{{date('d-m-Y',strtotime($action_log -> date))}}</td>
        <td>{{$action_log -> ip_address}}</td>
        <td>
          <a href="" class="btn btn-info btn-sm detail_btn" data-toggle="modal" data-target="#detailModel" data-backdrop="static" data-keyboard="false" 
                        data-tbl_name="{{ $action_log -> table_name }}" 
                        data-user_id="@if(isset($action_log -> users -> first_name)){{$action_log -> users -> first_name}} {{$action_log -> users -> last_name}} ({{$action_log -> users -> login_id}})@else{{'_'}}@endif"
                        data-active_action="{{$action_log -> action}}" 
                        data-date="{{ date('d-m-Y',strtotime($action_log -> date)) }}" 
                        data-ip_address="{{ $action_log -> ip_address }}"                        
                        data-action_detail= "{{ str_replace(",","\n", str_replace(array('{','}','"'),'',$action_log -> action_detail)) }}">
                        {{ trans('button.detail') }}
          </a>

        </td>
        {{-- <td>
                        <form action="/finance/{{$priceitem -> id}}/edit">
        <button type="submit" class="btn btn-primary">{{trans('finance_button.edit')}}</button>
        </form>

        <form class="delete" action="/finance/{{$priceitem -> id}}" method="POST">
          @method('DELETE')
          @csrf

          <button type="submit" class="btn btn-danger">{{trans('finance_button.delete')}}</button>
        </form>

        </td> --}}
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@include('ActionLog.modal')
@endsection

@push('page_scripts')

<script type="text/javascript">

  var base_url = "{{url('action-log')}}";

  $(".delete").on("submit", function() {
    return confirm("Are you sure to delete?");
  });

  $(document).on("click", '.detail_btn', function(e) {
        $('[name="tbl_name"]').val($(this).data('tbl_name'));
        $('[name="user_id"]').val($(this).data('user_id'));
        $('[name="active_action"]').val($(this).data('active_action'));
        $('[name="date"]').val($(this).data('date'));
        $('[name="ip_address"]').val($(this).data('ip_address'));
        $('[name="action_detail"]').val($(this).data('action_detail'));

        document.getElementById("editform").action = base_url + "/" + $(this).data('id');
    });
</script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
@endpush