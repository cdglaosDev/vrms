@extends('vrms2.layouts.master')
@section('match_payment', 'active')
@section('content')
@include('vrms2.mod2-submenu')
<h3>Payment Match</h3>
@include('flash') 
<div class="card-body">
   <table id="myTable"  class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('table.namel')}}</th>
            <th>{{trans('table.namee')}}</th>
            <th>{{ trans('common.action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($app_purpose as $data)
            <tr>
               <td>{{$data->name}}</td>
               <td>{{$data->name_en}}</td>
               <td class="sorting">
                  @can('Match-Payment-Edit')
                  <a class="btn_edit" title="{{ trans('title.edit') }}" data-url="{{ route('match-payments.edit',['id'=>$data->id])}}" data-toggle="modal"  data-target="#editModel" data-backdrop="static" data-keyboard="false"><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"></a>
                  @endcan
               </td>
            </tr>
         @endforeach

      </tbody>
   </table>
</div>
<!-- show role modal popup -->
<div class="modal fade" id="editModel" role="dialog">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->
@endsection
@push('page_scripts')
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
@endpush
