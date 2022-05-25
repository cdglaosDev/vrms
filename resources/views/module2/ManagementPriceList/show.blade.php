<div class="modal-header">
    <h3 class="text-center">{{trans('Price List Detail for '.$pricelist -> no)}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
    <div class="card-body">
        <div class="col-md-12 col-sm-12">
            <div class="row">
            <div class="col-md-2">
              <p>{{trans('finance_title.ref_no')}}.</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->no ?? ''}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <p>{{trans('finance_title.date')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{ isset($pricelist->date)?$pricelist->date:'-' }}</p>
            </div>
          </div>
           <div class="row">
            <div class="col-md-2">
              <p>{{trans('finance_title.counter_name')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->ServiceCounter->name ?? ''}}</p>
            </div>
          </div>
           <div class="row">
            <div class="col-md-2">
              <p>{{trans('finance_title.user_payer')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->user_payer}}</p>
            </div>
          </div>
           <div class="row">
            <div class="col-md-2">
              <p>{{trans('finance_title.receipt_status')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->reciept_status}}</p>
            </div>
          </div>
           <div class="row">
            <div class="col-md-2">
              <p>{{trans('title.province_code')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->province_code }}</p>
            </div>
          </div>
           <div class="row">
            <div class="col-md-2">
              <p>{{trans('book.currency')}}</p>
            </div>
            <div class="col-md-3">
              <p>{{$pricelist->MoneyUnit->name ?? ''}}</p>
            </div>
          </div>
           
        </div>
        <hr/>
        <div class="col-md-12 col-sm-12">
          <form action="{{route('receiveMoney')}}" method="POST" id="receiveForm">
          
              @method('POST')
                    @csrf
            <input type="hidden" name="id" value="{{$pricelist->id}}"> 
            <h4>{{trans('finance_title.price_item_list')}}</h4> 
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>{{trans('finance_title.item_name')}}</th>
                  <th>{{trans('finance_title.qty')}}</th>
                  <th width="20%">{{trans('finance_title.price')}}</th>
                  <th width="20%">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
               @foreach($pricelist->PriceListDetails as $key=>$value)
                <tr>
                  <td>{{$value->item_name_en}}</td>
                  <td>{{$value->quantity}}</td>
                  <td>{{number_format($value->price,'2','.',',')}}</td>
                  <td>{{number_format($value->sub_total,'2','.',',')}}</td>
                </tr>
                @endforeach
                  <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td width="20%">{{trans('finance_title.total_price')}}</td>
                  <td><input type="text" name="total_amt"  value="{{number_format($pricelist->total_amt,'2','.',',')}}" readonly="" class="form-control total_amt"></td>
                </tr>
               
              </tbody>
            </table>
          </form>
        </div>
      <hr>

      <div class="modal-footer">
        <a href="/price-list" class="btn btn-secondary btn-sm">{{ trans('Back') }}</a>
      </div>

      </div>
</div>
<script type="text/javascript">
    $('#receiveForm').on('keyup','.receive',function(){
  
              var total_amt = $('.total_amt').val();
              
              var receive_amt = $('.receive').val();
              
              var refund_amt = receive_amt - total_amt;
              $('#refund').val(refund_amt);
            });
    var base_url = "{{url('price-list')}}";
      $(document).on("click", '.remove', function (e) {  
              document.getElementById("deleteform").action = base_url+"/"+$(this).data('id');
          });
  </script>