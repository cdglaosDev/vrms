<div class="modal fade" id="notUsed" role="dialog">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>License <span class="booking-license"></span><br/>
          This Number can't be used.</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Back</button>
       <a  class="btn btn-success btn-sm btn-ok"  >Ok</a>
      </div>
     </div>
    </div>
   </div>

   <div class="modal fade" id="Used" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="bookingForm">
      @csrf
      <div class="modal-body text-center">
        <p>ເລກທະບຽນ <span class="license_no"></span><br/>ເລກທະບຽນນີ້ສາມາດຈອງໄດ້  ເຈົ້າຕ້ອງການຈະຈອງບໍ່?</p>
      </div>
      <input type="hidden" name="customer_name">
      <input type="hidden" name="lic_no">
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ trans('button.not_booking') }}</button>
       <button type="submit" class="btn btn-success btn-sm btn-booking" >{{ trans('button.booking') }}</button>
      </div>
      </form>
     </div>
    </div>
   </div>

   <div class="modal fade" id="CancelBill" role="dialog">
    <div class="modal-dialog">]
     <!-- Modal content-->
     <div class="modal-content">
      <form action="" method="POST" id="bookingForm">
      @csrf
      <div class="modal-body text-center">
        <p>{{ trans('finance_title.cancel_bill_no') }} <span class="oldBillNo"></span>  ແທ້ບໍ່? </p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ trans('finance_title.no') }}</button>
       <button type="button" data-dismiss="modal" data-toggle="modal" href="#Cancel-Yes-Bill" class="btn btn-success btn-sm " >{{ trans('finance_title.yes') }}</button>
      </div>
      </form>
     </div>
    </div>
   </div>

   <div class="modal fade" id="Cancel-Yes-Bill" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <form action="" method="POST" id="bookingForm">
      @csrf
      <div class="modal-body text-center">
        <p>{{ trans('finance_title.edit_bill_no') }}?</p>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-default btn-sm btn-cancel" data-dismiss="modal">{{ trans('finance_title.no') }}</button>
       <button type="submit" class="btn btn-success btn-sm btn-status-change-bill" data-dismiss="modal">{{ trans('finance_title.yes') }}</button>
      </div>
      </form>
     </div>
    </div>
   </div>


   <!-- print modal -->
   <!-- <div class="modal fade" id="printModal" role="dialog">
    <div class="modal-dialog"> -->
     <!-- Modal content-->
     <!-- <div class="modal-content">
      <form action="" method="POST" id="printForm">
      @csrf
      <div class="modal-body text-center">
        <p>ຕ້ອງການບັນທຶກກ່ອນບໍ່?</p>
      </div>
      <div class="modal-footer">
       <a  class="btn btn-default btn-sm print_no" >{{ trans('finance_title.print_no') }}</a>
       <button type="button" class="btn btn-success btn-sm print_save" >{{ trans('finance_title.print_yes') }}</button>
      </div>
      </form>
     </div>
    </div>
   </div> -->



  
   