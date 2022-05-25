//if data include price list talbe, select each data list
$('.pricelist-select').click(function(e){
    e.preventDefault();
    $('#priceList').modal('hide');
    var price_id = $(this).data("id");
    $.ajax({
           type:"GET",
            url: getItem+ "/"+price_id,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
           success:function(data){  
          console.log(data);
              $.each(data.price_detail,function(index,value) {
              $("#pList > tbody").append('<tr><td width="50"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" ></td><td width="100"><input type="text" class="border-0 item_name" value="'+value['item_name']+'" name="item_name[]" readonly><input type="hidden" class="border-0 item_name_en" value="'+value['item_name_en']+'" name="item_name_en[]"><input type="hidden" class="border-0 price_item_id" value="'+value['price_item_id']+'" name="price_item_id[]"></td><td width="20"><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]"><input type="hidden" class="fine_percent"  value="'+value['fine_percent']+'" name="fine_percent[]" ></td><td width="50"><input type="text" class="border-0 price"  value="'+value['price']+'" name="unit_price[]" required></td><td width="50"><input type="text" class="border-0 sub_total"  value="'+value['sub_total']+'" name="sub_total[]" ></td><td><input type="hidden"  value="'+value['id']+'" name="detail_id[]"><a href="#" class="btn btn-danger btn-sm remove-detail"><i class="fa fa-minus"></i></a></td></tr>');
            
              });
              $('[name="app_no"]').val(data.price_list.app_form['app_no']);
              $('[name="user_payer"]').val(data.price_list.app_form['customer_name']);
              $('[name="user_payer"]').val(data.price_list.user_payer);
              $('[name="date"]').val(data.price_list['date']);
              $('[name="service_counter"]').val(data.price_list.service_counter['name']);
              $('[name="service_counter_id"]').val(data.price_list.service_counter_id);
              $('[name="total_amt"]').val(data.price_list.total_amt);
              $('[name="app_form_id"]').val(data.price_list.app_form_id);
              $('[name="price_list_id"]').val(data.price_list.id);
              $('#saveBill').val(data.price_list.price_receipt_no);
              $('[name="reciept_status"]').val(data.price_list.reciept_status);
              $('[name="price_receipt_no"]').val(data.price_list.price_receipt_no);
              $('[name="license"]').val(data.price_list.lic_book_no);
              $('[name="cc"]').val(data.price_list.cc);
              $('[name="road_tax"]').val(data.price_list.road_tax);
              $('[name="note"]').val(data.price_list.note);
              $('[name="code"]').val(data.price_list.code);
             
                  if (data.price_list.reciept_status == "printed" || data.price_list.reciept_status == 'cancel bill') {
                    $("#pList").find("input").attr("disabled", "disabled");
                      $(".remove-detail, #add").addClass('disabled');
                  }
                  if (data.price_list.reciept_status == "printed") {
                    $("#pList").find("input").attr("disabled", "disabled");
                    $(".remove-detail, #add").addClass('disabled');
                    $("#saveRecord").addClass('disabled');
                    $("#after-save").val(1);
                    $("#price-cancel-bill").removeClass('disabled');
                  } else if(data.price_list.reciept_status == 'cancel bill') {
                    $("#pList").find("input").attr("disabled", "disabled");
                    $(".remove-detail, #add").addClass('disabled');
                    $("#saveRecord").addClass('disabled');
                  } else if(data.price_list.reciept_status == 'save') {
                   
                    if($('#pList >tbody tr').length > 0){
                      $("#after-save").val(1);
                    } else {
                      $("#after-save").val(0);
                    }
                  }
                  if (data.second_bill_status[1].reciept_status == "printed") {
                    $(".lic_booking").addClass('disabled');
                  }
                 
                  // if ( data.price_list.lic_book_no != null) {
                  //   $(".lic_booking").addClass('disabled');
                  // }
                 
              $('#vehicle_kind').val(data.price_list.app_form.vehicle['vehicle_kind_code']);
                  
            }
          });
  });
  
  $("#pList > tbody").on('click', '.remove-detail', function(){
    $(this).parent('td').parent('tr').remove();
    updateQty();
  });
  
  //update sub total if change qty
  $('#price-list').on('keyup','.qty',function(){
    updateQty();
  });
  //update sub total if change qty
  $('#price-list').on('autocomplete change',function(){
  
    updateQty();
   
  });
  //js for total amount calculate
  function updateQty(){
    var total_amt = 0.0;
    $('#pList > tbody  > tr').each(function() {
      var qty = $(this).find('.qty').val();
      var price = $(this).find('.price').val();
      var sub_total = (qty * price);
      total_amt += +sub_total;
      $(this).find('.sub_total').val(sub_total);
    });
   $('#total_amt').val(thousands_separator(total_amt));
  }
  //js for add more row
  var InputsWrapper   = $("#pList > tbody"); //Input boxes wrapper ID
                var AddButton= $("#add"); //Add button ID
  
                var x = $("#pList > tbody > tr").length; //initlal text box count
                
                var FieldCount= x +1; //to keep track of text box added
  
                //on add input button click
                  $(AddButton).click(function (e) {
                        
                    $(InputsWrapper).append('<tr><td><input type="text" id="item-code-'+FieldCount+'" class="item" name="item_code[]" placeholder="Code" class="form-control item"  title="Type to search Item" data-type="item" style="width: 60px;"></td><td><input type="text" class="border-0" name="item_name[]"  required id="item-'+FieldCount+'" value="" readonly><input type="hidden" id="itemId-'+FieldCount+'" class="itemid" name="price_item_id[]"><input type="hidden" id="item-name-en-'+FieldCount+'" class="item-name-en" name="item_name_en[]"></td><td><input type="number" name="quantity[]" id="qty-'+FieldCount+'" value="" class="form-control qty" required><input type="hidden" name="fine_percent[]" id="fine_percent-'+FieldCount+'" value="" class="form-control fine_percent"></td><td><input type="text" name="unit_price[]" id="price-'+FieldCount+'" value="" class="form-control price border-0" required="required" readonly></td><td><input type="text" class="form-control sub_total border-0" readonly="readonly" name="sub_total[]" id="sub_total-'+FieldCount+'" placeholder="0.00"></td><td><a title="delete" href="javascript:void(0);" class="btn btn-danger bold btn-sm remove"><i class="fa fa-minus"></i></a></td></tr>');
                    $('.item').focus();
                    x++; //text box increment
                    FieldCount++;
                    $("#AddMoreFileId").show();
                    
                    $('AddMoreFileBox').html("Add field");
                    
                    // Delete the "add"-link if there is 3 fields.
                    if (x == 3) {
                        $("#AddMoreFileId").hide();
                      $("#lineBreak").html("<br>");
                    }
                  });
                $(InputsWrapper).on('click', '.remove', function(){
                  $(this).parent('td').parent('tr').remove();
                  updateQty();
                });
       
  //search unit price by typing item-code
  $('#price-list').on('keypress','.item',function(e){
  if(e.which == 13) 
  var id_arr = $(this).attr('id');
  var app_form_id =  $('[name="app_form_id"]').val();
  var code = this.value;
  updateQty();
    $.ajax({
        url: itemRoute,
        dataType: "json",
        data: {
            code : code,
            app_form_id: app_form_id,
        },
        success: function(data) {
          id = id_arr.split("-");
          elementId = id[id.length-1];
          $('#item-'+elementId).val(data.name);
          $('#qty-'+elementId).val(1);
          $('#price-'+elementId).val(data.price);
          $('#sub_total-'+elementId).val(data.price);
          $('#itemId-'+elementId).val(data.price_item_id);
          $('#item-name-en-'+elementId).val(data.name_en);
          $('#item-code-'+elementId).val(data.item);
          $('#fine_percent-'+elementId).val(data.fine_percent);
        }
    });
  });
     
  //js for cancel button
  $('#price-cancel-bill').on('click', function(e) {
  e.preventDefault();
  $("#CancelBill span.oldBillNo").text($("#saveBill").val());
  $("#CancelBill").modal('show');
  $(document).on('click','.btn-cancel',function(e){
    $("#price-cancel-bill").addClass('disabled');
    $('.reciept_status').val('cancel bill');
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var price_id = $("#price_list_id").val();
  var reciept_status = "cancel bill";
  $.ajax({
    type:"POST",
    url: '/price-list/cancel-bill',
    data: {'price_id':price_id,'reciept_status':reciept_status},
    
  });
  });
  
  $(document).on('click','.btn-edit-bill',function(e){
    $("#price-cancel-bill").addClass('disabled');
    $('#saveRecord').removeClass('disabled');
    $('.reciept_status').val('pending');
  
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var price_id = $("#price_list_id").val();
  var reciept_status = "pending";
  $.ajax({
    type:"POST",
    url: '/price-list/cancel-bill',
    data: {'price_id':price_id,'reciept_status':reciept_status},
    success:function(data) {
      if (data.price ==1) {
        bill_increment =$('#autoBill').val();
        //bill_no = parseInt(bill_increment) +parseInt(1);
        $('.price_receipt_no').val(bill_increment);
        $('.reciept_status').val('pending');
        $("#price_list_id").val(null);
        $("#remove, #add").removeClass('disabled');
        $("#pList").find("input").removeAttr('disabled');
        document.getElementById("license").focus();
      }
    }
  });
  });
  
  $(document).on('click','.btn-status-change-bill',function(e){
    $("#price-cancel-bill").addClass('disabled');
    $('#saveRecord').removeClass('disabled');
    $('.reciept_status').val('pending');
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var price_id = $("#price_list_id").val();
  var reciept_status = "cancel bill";
  $.ajax({
    type:"POST",
    url: '/price-list/cancel-bill',
    data: {'price_id':price_id,'reciept_status':reciept_status},
    success:function(data) {
      if (data.price ==1) {
        bill_increment =$('#autoBill').val();
        //bill_no = parseInt(bill_increment) +parseInt(1);
        $('.price_receipt_no').val(bill_increment);
        $('.reciept_status').val('pending');
        $("#price_list_id").val(null);
        $("#remove, #add, .remove-detail").removeClass('disabled');
        $("#pList").find("input").removeAttr('disabled');
      }
    }
  });
  });
  
  });
  
  function thousands_separator(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  
  //check space for license no booking input box
  $('#license').keyup(function() {
    var vehicle_kind = $("#vehicle_kind").val();
    if (vehicle_kind == 1 || vehicle_kind == 2 || vehicle_kind == 3 || vehicle_kind == 4 || vehicle_kind == 6) {
      $(this).attr('maxlength', 7);
      var code = $(this).val().split(" ").join(""); 
      if (code.length > 0) {
        code = code.split(/(?=.{4}$)/).join(' ');
      }
      $(this).val(code);
      
    } else {
        $(this).attr('maxlength', 8);
        var code = $(this).val();
        $(this).val(code);
    }
   
  });
  
   //click license booking button
  $('.lic_booking').on('click', function(e) {
    e.preventDefault();
    var license = $("#license").val();
    var app_form_id = $('input[name="app_form_id"]').val();
    if (!license || $('.reciept_status').val() == 'pending') {
      alert('Please enter license no.');
      return false;
    }
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type:"GET",
    url: '/price-list/license-booking' +'/'+license,
    data: {'app_form_id':app_form_id},
    success:function(data) {
      console.log(data);
      if (data == "this license can't be used.") {
        $(".booking-license").text(license);
        confirm('License'+ license +"This Number can't be used.");
        document.getElementById("license").value = "";
      } else if(data == "include-alphabet"){
        alert("Your license no format should be likes AA 22-22, AA 2222, AA 2-222 etc.");
        return false;
      } else {
        $('[name="lic_no"]').val(license);
        $('[name="customer_name"]').val($('[name="user_payer"]').val());
        $(".booking-license").text(license);
        $("#Used").modal('show');
          var formData = {
            'customer_name': $('input[name=customer_name]').val(),
            'lic_no': $('input[name=lic_no]').val(),
            'price_list_id':$('input[name=price_list_id]').val(),
            'app_form_id':$('input[name="app_form_id"]').val(),
            'province_code':$("#province_code").val(),
            'vehicle_kind_id': $("#vehicle_kind_id").val(),
            'price_receipt_no':$("#autoBill").val(),
          };
       
        $(document).on('click','.btn-booking', function(e){
          e.preventDefault();
          $.ajax({
            type:"POST",
            url: '/price-list/license-booking',
            data        : formData, 
            dataType    : 'json' ,
            success:function(data) {
              
              if (data == "not-success") {
                alert("Alphabet doesn't exit in alphabet table.Please check.");
                $("#Used").modal('hide');
                $( "#license" ).load(window.location.href + " #license" );
                
                
              } else {
                $("#license").val(license);
                $("#Used").modal('hide');
                alert('Successful license number booking.');
                window.location.replace("/price-list/create");
              }
              
            }
          });
        });
      }
      
    }
  });
  });
  
  
  //for print button
  $(document).on('click','.printBtn', function(e){
    var rowCount = $('#pList >tbody tr').length;
  
    if ($('.reciept_status').val() == 'pending' || rowCount <=0 || $("#total_amt").val() == "0" ||  $("#total_amt").val() == "0.00" ||  $("#pList .item").val() == "" || $("#after-save").val() == 0){
      alert('You need to save first.');
      return false;
    } else if ($('.reciept_status').val() == 'cancel bill') {
      $('.reciept_status').val('cancel bill');
    }  else {
      $('.reciept_status').val('printed');
    }
   
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var price_list_id = $("#price_list_id").val();
  var reciept_status = $('.reciept_status').val();
  var form_data = $('#price-list').serialize();
  $.ajax({
    type:"POST",
    url: '/price-list/print/'+ price_list_id,
    data:{reciept_status:reciept_status},
    success:function(data) {
      
      var print_length =  $("#printList > .row ").length;
      if (print_length == 0) {
            $.each(data.price_detail,function(index,value){
              $("#printList").append('<div class="row" style="height: 25px"><div style="width: 40px;"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" ></div><div style="width:450px;padding-left:15px;"><input type="text" class="border-0 item_name" value="'+value['item_name']+'" name="item_name[]" readonly style="width:430px;"></div><div style="width:77px; padding-left:25px;" ><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]" style="width:77px"></div><div  style="width:140px; padding-left: 25px;"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" style="width:110px" required></div><div  style="width:260px; padding-left:20px;"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" ></div></div>');
              
            });
      }
      if ($('.reciept_status').val() == "printed") { 
        $('[name="reciept_status"]').val("printed");
        $("#pList").find("input").attr("disabled", "disabled");
        $("#remove, #add").addClass('disabled');
        $("#price-cancel-bill").removeClass('disabled');
        $('#saveRecord').addClass('disabled');
      } 
      $('[name="app_no"]').val(data.price_list.app_form['app_no']);
      if (data.price_list.app_form['app_no'] == null) {
        $('[name="print_user_payer"]').val(data.price_list.user_payer);
      } else {
        chassis_no = data.price_list.app_form.vehicle['chassis_no'];
        if ($('[name="license"]').val() == "") {
          $('[name="print_user_payer"]').val(data.price_list.user_payer+' + '+chassis_no.slice(chassis_no.length - 4));
        
        } else {
          $('[name="print_user_payer"]').val(data.price_list.user_payer+' + '+$('[name="license"]').val());
        }
      }
      var dateAr =  data.price_list['date'].split('-');
      var newDate = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
      var date_req = data.price_list.app_form;
                 
      if (date_req == "") {
        var newDate_req = null;
      } else if (date_req != "undefined") {
        var req_date_Ar = data.price_list.app_form['date_request'].split('-');
        var newDate_req = req_date_Ar[2] + '/' + req_date_Ar[1] + '/' + req_date_Ar[0];
      }
      var t_amt = data.price_list.total_amt;
      var total_price_amt = thousands_separator(t_amt);
      $('[name="date"]').val(newDate);
      $('[name="service_counter"]').val(data.price_list.service_counter['name']);
      $('[name="service_counter_id"]').val(data.price_list.service_counter_id);
      $('[name="total_amt"]').val(total_price_amt);
      $('[name="app_form_id"]').val(data.price_list.app_form_id);
      $('[name="price_list_id"]').val(data.price_list.id);
      $('[name="reciept_status"]').val(data.price_list.reciept_status);
      $('[name="print_price_receipt_no"]').val(data.price_list.service_counter.name+ '.'+data.price_list.price_receipt_no);
      $('[name="ref_date"]').val(newDate_req);
      jQuery('#print-paper').print();
    }
  });
   });
  
  
  ///For buttons disabled and enabled conditions
  $('#AppNo').focus(function(){
    $("#price-list-search").removeClass("disabled");
  });
  
  $(document).on("focus",".item",function(){       
    $("#price-list-search").removeClass('disabled');
    $("#price-list-print").removeClass('disabled');
    $('#saveRecord').removeClass('disabled');
  });
  
  $("#select-price-list").click(function () {
        $("#price-list-search").removeClass('disabled');
        $("#price-list-print").removeClass('disabled');
        $("#saveRecord").removeClass('disabled');
        
        $('#license').focus(function(){
          if ($("#license").val() == '') {
            $('#check-lic-booking').removeClass('disabled');
          }
        });
  });
  
  
  
  
  