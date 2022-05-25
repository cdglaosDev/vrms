<div class="modal-header">
<h3>Add Match Payment</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
<div class="card-body">
   <form action="{{ route('storeMatchPayment') }}" method="POST">
      @csrf
      @method('POST')
      <div class="form-group">
         <div class="row">
            <div class="col-md-4">
               <label for="name">Name</label>
               <input type="text" class="form-control" value="{{ $app_purpose->name_en}}" readonly>
            </div>
            <div class="col-md-4">
               <label for="name">Name Laos</label>
               <input type="text" class="form-control" value="{{ $app_purpose->name}}" readonly>
               <input type="hidden" name="app_purpose_id" value="{{ $app_purpose->id }}"> 
            </div>
         </div>
         <h5>Price Item</h5>
         <div class="row mt-3 ml-3">
            @foreach($price_item as $pitem)
            <div class="col-md-4">
               <div class="form-check">
                  <input type="checkbox" {{in_array($pitem->id, $item_mapping)?'checked':''}} class="form-check-input" name="price_item_id[]" value="{{ $pitem->id }}">
                  <label class="form-check-label" style="margin-left: 12px">{{ $pitem->name_en }}</label>
               </div>
            </div>
            @endforeach
         </div>
         <div class="row">
            <div class="col-md-12 text-right">
               <a href="{{route('match-payments.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
               <button class="btn btn-success btn-sm">Update</button>
            </div>
         </div>
      </div>
   </form>
</div>
</div>