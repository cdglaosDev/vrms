@extends('vrms2.layouts.master')
@section('price_item', 'active')
@section('content')
@include('vrms2.mod2-submenu')
<h3>
{{trans('finance_title.manage_price_item')}}
@can('Price-Item-List-Create') 
   <a data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
@endcan
</h3>
@include('flash')
<div class="card-body">
   <table id="myTable" class="table table-striped" style="width:100%">
      <thead>
         <tr>
            <th>{{trans('finance_title.item_code')}}</th>
            <th>{{trans('finance_title.item_name')}}</th>
            <th>{{trans('finance_title.item_name_en')}}</th>
            <th>{{trans('finance_title.price')}}</th>
            <th width="50">{{trans('finance_title.vtypegroup')}}</th>
            <th>{{trans('finance_title.status')}}</th>
            <th width="250">{{trans('finance_title.action')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($price_item as $priceitem)
         <tr>
            <td>{{$priceitem -> code}}</td>
            <td>{{$priceitem -> name}}</td>
            <td>{{$priceitem -> name_en}}</td>
            <td>{{ \App\Library\TotalItemPrice::getTotal($priceitem->id)}}</td>
            <td>{{$priceitem -> VehTypeGroup->name}}</td>
            <td>{{$priceitem -> status}}</td>
            <td>
               <a data-toggle="modal" data-target="#showModal"  data-url="{{route('unitprice.create',['id'=>$priceitem->id])}}" class="btn btn-info btn-sm show_btn"><i class="fa fa-plus"><span> {{ trans('finance_title.add_price') }}</span></i></a>
               @can('Price-Item-Entry-Edit')
               <a data-url="{{route('price-item.edit',['id'=>$priceitem->id])}}" title="{{ trans('title.edit') }}" class="btn_edit" data-toggle="modal" data-target="#editPriceItem"><img src="{{ asset('images/edit.png') }}" alt="" width="25" height="25px"></a>
               @endcan
               @can('Price-Item-Entry-Delete')
               <form class="delete" style="display:inline" action="/price-item/{{$priceitem -> id}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" title="{{ trans('title.delete') }}" class="border-0" style="background:none !important"><img src="{{ asset('images/delete.png') }}" alt="" width="25" height="25px"></button>
               </form>
               @endcan
            </td>
         </tr>
         @endforeach 
      </tbody>
   </table>
</div>
<!-- show  modal popup -->
<div class="modal fade" id="showModal" role="dialog">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
        <div class="modal-content show-modal">
            
        </div>
    </div>
</div>
<!-- end show  modal popup -->

<!-- show  modal popup -->
<div class="modal fade" id="editPriceItem" role="dialog">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
        <div class="modal-content edit-modal">
            
        </div>
    </div>
</div>
<!-- end show role modal popup -->
@include('module2.ManagePriceItem.itemModal')
@endsection
@push('page_scripts')
<script type="text/javascript">
   var base_url = "{{url('/price-item')}}";
   $(".delete").on("submit", function(){
   return confirm("Are you sure to delete?");
   });

</script>
<script src="{{ asset('vrms2/js/showModal.js') }}"></script>
@endpush