@extends('vrms2.layouts.master')
@section('price_list', 'active')
@section('content')
@include('vrms2.mod2-submenu') 
    <h3>{{trans('finance_title.manage_price_list')}}
    @can('PriceList-Create')
    <a href="{{ url('/price-list/create')}}" class="btn btn-primary btn-save" style="color: #fff !important">{{trans('common.add_new')}}</a>
    @endcan
    </h3>
    @include('flash') 
      <div class="card-body pt-1 " id="price_list_page">
          <div class="row">
            <div class="table-responsive">
              <table id="myTable"  class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>{{ trans('finance_title.list_no') }}</th>
                    <th>{{ trans('finance_title.date') }}</th>
                    <th>{{ trans('finance_title.user_payee') }}</th>
                    <th>{{ trans('finance_title.user_payer') }}</th>
                    <th>{{ trans('finance_title.item_detail') }}</th>
                    <th>{{ trans('finance_title.total_price') }}</th>
                  
                    <th>{{ trans('finance_title.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pricelists as $pricelist)
                    <tr>
                      <td>{{$pricelist -> no}}</td>
                      <td>{{ isset( $pricelist -> date)? $pricelist -> date:'-' }}</td>
                      <td>{{$pricelist -> users_payee -> name ?? ''}}</td>
                      <td>{{$pricelist -> user_payer ?? ''}}</td>
                      <td> @foreach($pricelist->PriceListDetails as $key=>$value)
                            <p>{{$value->item_code}}/ {{ isset($value->price)?number_format($value->price):'' }}</p>
                          @endforeach</td>
                      <td>{{ isset( $pricelist -> total_amt)? number_format( $pricelist -> total_amt):''}}</td>
                      <td>
                       
                        <a data-url="{{route('price-list.show',['id'=>$pricelist->id])}}" title="{{ trans('title.view') }}" class="show_btn" data-toggle="modal" data-target="#showModal"><img src="{{ asset('images/view.png') }}" alt="" width="25" height="25px"></a>
                      
                        @can('PriceList-Entry-Delete')
                        <a href="#" data-id="{{$pricelist->id}}"  data-toggle="modal" title="Cancel" data-target="#CancelModal" class="billCancel {{$pricelist->reciept_status =='save'?'disabled':''}}"><img src="{{ asset('images/cancel.png') }}" alt="" width="25" height="25px"></a>
                        @endcan
                      </td>
                    </tr>  
                  @endforeach 
                </tbody>
              </table>
              {!! $pricelists->links() !!}
            </div>
      </div>
      </div>
   
    <!-- bill cancel -->
    <div class="modal fade" id="CancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="" id="cancelform"  method="post">
            @method('POST')
            {{ csrf_field() }}
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" >
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> 
               <div class="modal-body text-center">
                  <h4 class="border-0">Do you really want to cancel this bill number?</h4>
                 
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <input type="submit" class="btn btn-success btn-sm" value="{{trans('button.save')}}">
               </div>
           
         </form>
      </div>
   </div>
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
@endsection
@push('page_scripts')
 <script type="text/javascript">

    var base_url = "{{url('/price-list/cancel-bill')}}";
    $(document).on("click", '.billCancel', function (e) {  
            document.getElementById("cancelform").action = base_url+"/"+$(this).data('id');
    });

</script>
<script src="{{ asset('vrms2/js/showModal.js') }}"></script>
@endpush