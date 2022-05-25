//if data include price list talbe, select each data list
$('.pricelist-select').click(function(e){
  e.preventDefault();
  $('#priceList').modal('hide');
  var price_id = $(this).data("id");
  $.ajax({
         type:"GET",
          url: '/get-price-item'+ "/"+price_id,
          dataType: 'json',
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
         success:function(data){
          // console.log(data);
          showItem(data);
          }
        });
});

//get bill no when click previous  button
$(document).on('click','#previous_btn',function(e){
  $("#pList >tbody > tr").remove();
  e.preventDefault();
  $.get("/get-previous-bill?service_counter_id=" + $("#service_counter_id").val()+ "&bill_no=" + $("#autoBill").val(), function(data) {
    showItem(data);
  })
});

//get bill no when click next button
$('#next_btn').click(function(e){
  $("#pList >tbody > tr").remove();
  e.preventDefault();
  $.get("/get-next-bill?service_counter_id=" + $("#service_counter_id").val()+ "&bill_no=" + $("#autoBill").val(), function(data) {
   
    showItem(data);
  })
});
// show data from pricelist and price list detail when select button on modal pop
function showItem(data)
{
   
    $.each(data.price_detail,function(index,value) {
      $("#pList > tbody").append('<tr><td width="50"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" ></td><td width="100"><input type="text" class="border-0 item_name" value="'+value['item_name']+'" name="item_name[]" readonly><input type="hidden" class="border-0 item_name_en" value="'+value['item_name_en']+'" name="item_name_en[]"><input type="hidden" class="border-0 price_item_id" value="'+value['price_item_id']+'" name="price_item_id[]"></td><td width="20"><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]"><input type="hidden" class="fine_percent"  value="'+value['fine_percent']+'" name="fine_percent[]" ></td><td width="50"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" required></td><td width="50"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" ></td><td><input type="hidden"  value="'+value['id']+'" name="detail_id[]"><a href="#" class="remove-detail">ລບລ້າງ</a></td></tr>');
    });
    
    $(".user_counter button:not(#btn_counter"+data.price_list.service_counter_id+ ")").attr('disabled', false).removeClass('active-counter');
    $(".user_counter #btn_counter"+data.price_list.service_counter_id).attr('disabled', true).addClass('active-counter');
    if(data.price_list.app_form_id == null){
      $('[name="app_no"], [name="app_form_id"], #vehicle_kind').val('');
    }
    
    $('[name="app_no"]').val(data.price_list.app_form['app_no']);
    //$('[name="user_payer"]').val(data.price_list.app_form['customer_name']);
    $('[name="user_payer"]').val(data.price_list.user_payer);
    $('[name="date"]').val(data.price_list['date']);
    $('.current_counter_name').text(data.price_list.service_counter['name']);
    $('#current_bill').text(data.price_list.price_receipt_no);
    $('.updated_by').text(data.price_list.staff['first_name']+' '+ data.price_list.staff['last_name']);
    $('[name="service_counter_id"], [name="active_counter"]').val(data.price_list.service_counter_id);
    if(data.price_list.total_amt != null){
      $('[name="total_amt"]').val(thousands_separator(data.price_list.total_amt));
    }
   
    $('[name="app_form_id"]').val(data.price_list.app_form_id);
    $('[name="price_list_id"]').val(data.price_list.id);
    $('[name="reciept_status"]').val(data.price_list.reciept_status);
    $('[name="price_receipt_no"], .price_receipt_no, #saveBill,[name="active_bill"]').val(data.price_list.price_receipt_no);
    $('[name="license"]').val(data.price_list.lic_book_no);
    $('[name="cc"]').val(data.price_list.cc);
    $('[name="road_tax"]').val(data.price_list.road_tax);
    $('[name="note"]').val(data.price_list.note);
    $('[name="code"]').val(data.price_list.code);
        if (data.price_list.reciept_status == "printed") {
          $("#pList").find("input").attr("disabled", true);
          $(".remove-detail, #saveRecord, #icode").addClass('disabled');
          $("#after-save").val(1);
          $("#price-cancel-bill").removeClass('disabled');
          if(data.buy_lic){
            $(".lic_booking").addClass('disabled');
          }
        } else if(data.price_list.reciept_status == 'cancel bill') {
          $("#pList").find("input").attr("disabled", true);
          $(".remove-detail, #saveRecord, .cancel-bill, #price-list-print").addClass('disabled');
          if(data.buy_lic){
            $(".lic_booking").addClass('disabled');
          }
        } else if(data.price_list.reciept_status == 'save') {
            if(data.buy_lic){
              $(".lic_booking").addClass('disabled');
            }
            $("#icode, #saveRecord").removeClass('disabled');
            if($('#pList >tbody tr').length > 0){
              $("#after-save").val(1);
            } else {
              $("#after-save").val(0);
            }
        }

        if (data.second_bill_status == "printed") {
          //$(".lic_booking").addClass('disabled');
        }
       
        if ( data.price_list.lic_book_no != null) {
          $(".lic_booking").addClass('disabled');
        }
      if(data.price_list.app_form['app_form_status_id'] == 4 || data.price_list.app_form['app_form_status_id'] == 5 || data.price_list.app_form['app_form_status_id'] == 6 ||data.price_list.app_form['app_form_status_id'] == 7){
        $(".lic_booking").addClass('disabled');
      }
       
      if(data.price_list.app_form_id != null) {
        $('#vehicle_kind').val(data.price_list.app_form.vehicle['vehicle_kind_code']);
      } else{ 
        $('#vehicle_kind').val("");
      }       
      if(data.price_list.user_payer){ 
        $('[name="user_payer"]').attr('readonly','readonly');
      }
        
}


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
  //alert($('#pList > tbody  > tr').length);
  $('#pList > tbody  > tr').each(function() {
    var qty = $(this).find('.qty').val();
    var price = $(this).find('.price').val().replace(/,/g, "");
    var sub_total = (qty * price);
    total_amt += +sub_total;
    $(this).find('.sub_total').val(thousands_separator(sub_total));
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
                      
                  $(InputsWrapper).append('<tr><td><input type="text" id="item-code-'+FieldCount+'" class="item" name="item_code[]" placeholder="Code" class="form-control item"  title="Type to search Item" data-type="item" style="width: 60px;"></td><td><input type="text" class="border-0" name="item_name[]"  required id="item-'+FieldCount+'" value="" readonly><input type="hidden" id="itemId-'+FieldCount+'" class="itemid" name="price_item_id[]"><input type="hidden" id="item-name-en-'+FieldCount+'" class="item-name-en" name="item_name_en[]"></td><td><input type="number" name="quantity[]" id="qty-'+FieldCount+'" value="" class="form-control qty" required><input type="hidden" name="fine_percent[]" id="fine_percent-'+FieldCount+'" value="" class="form-control fine_percent"></td><td><input type="text" name="unit_price[]" id="price-'+FieldCount+'" value="" class="form-control price border-0" required="required" readonly></td><td><input type="text" class="form-control sub_total border-0" readonly="readonly" name="sub_total[]" id="sub_total-'+FieldCount+'" placeholder="0.00"></td><td><a title="delete" href="javascript:void(0);" class="remove">ລບລ້າງ</a></td></tr>');
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
     
/*================ search unit price by typing item-code =====*/
$('#price-list').on('keypress','.item',function(e){
if(e.which == 13) 
var id_arr = $(this).attr('id');
var app_form_id =  $('[name="app_form_id"]').val();
var code = this.value;
updateQty();
  $.ajax({
      url: '/get-price-item',
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
   
/*============= cancel button =========== */
$('#price-cancel-bill').on('click', function(e) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
e.preventDefault();
if($('.reciept_status').val() != "pending") {
$("#CancelBill span.oldBillNo").text($("#saveBill").val());
$("#CancelBill").modal('show');
$(document).on('click','.btn-cancel',function(e){
  $(this).addClass('disabled');
  $('.reciept_status').val('cancel bill');
  var price_id = $("#price_list_id").val();
  var reciept_status = "cancel bill";
  $.ajax({
    type:"POST",
    url: '/price-list/cancel-bill',
    data: {'price_id':price_id,'reciept_status':reciept_status},
  });
  });
  /* click change cancel bill */
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
      //console.log(data);
      if (data.price ==1) {
        generateNewBill();
      }
    }
  });
  });
} else {
  alert($('#save_first').attr('title'));
  return false;
}
});

/* ====================== click new bill button  ===========*/
$(document).on('click','.new-bill', function(e){
  generateNewBill();
});

function generateNewBill()
{
  var counter_id = $("#service_counter_id").val();
 if(assignCounter.includes(counter_id)){
    var service_counter_id = counter_id;
 }else {
    var service_counter_id = assignCounter[0];
 }
  
  $.get("/get-bill-no?id=" + service_counter_id, function(response) {
  $('#autoBill').val(null);
  $(".AppNo").focus();
  $(".current_counter_name").text(response.counter_name);
  $(".price_receipt_no, #autoBill, #active_bill").val(response.bill_no);
  $('#current_bill').text(response.bill_no);
  $(".price_date").val(response.payment_date);
  $('.reciept_status').val('pending');
  $("#service_counter_id, #active_counter").val(service_counter_id);
  $(".user_counter button:not(#btn_counter"+service_counter_id+ ")").attr('disabled', false).removeClass('active-counter');
  $(".user_counter #btn_counter"+service_counter_id).attr('disabled', true).addClass('active-counter');
  $("#price_list_id, #saveBill, .app_form_id, .AppNo").val(null);
  $("#customer_name, #total_amt, #cc, #roadTax, #note, #license, #icode").val('');
  $("#remove, #add, .remove-detail,#saveRecord, #icode").removeClass('disabled');
  $("#customer_name").removeAttr('readonly');
  $("#pList >tbody > tr").remove();
  });
}
/*====================== */

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

/*=============  click license booking button ===============*/
$('.lic_booking').on('click', function(e) {
  e.preventDefault();
  licBook();
});
/* ============================*/

/*============= Enter key from keyboard after added license no ===============*/
  $('.lic_booking').keyup(function(event) {
      event.preventDefault();
      if (event.keyCode == 13) {
        licBook();
    }
  });

function licBook(){
  
  if(checkName() == false){
    alert('ກະລຸນາປ້ອນຊື່');
    return false;
  } 
  if(checkDate() == false){
    alert($('#select_date').attr('title'));
    return false;
  }
  if(checkItem() == false){
    alert($('#at_least_item').attr('title'));
    return false;
  }
 
  if(checkQty() == false){
    alert('ກະລຸນາປ້ອນຈໍານວນ');
    return false;
  }
  var license = $("#license").val();
  var lastTwoNo = license.slice(license.length - 2);
  
  var app_form_id = $('input[name="app_form_id"]').val();
  if(app_form_id == ''){
    alert('Can not booking in manual case.');
    return false;
  }
 if ($('#pList >tbody tr').length <=0 ) {
    alert($('#at_least_item').attr('title'));
    return false;
  } 
 
  if (license == '') {
    alert($("#enter_lic").attr('title'));
    return false;
  }
  if(lastTwoNo == 27 || lastTwoNo == 67){
    alert($("#ending_27_67").attr('title'));
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
    if (data.status == "no-alphabet") {
      alert($('#alphabet_not_exist').attr('title'));
      return false;
    } else if(data.status == "include-alphabet"){
      alert("Your license no format should be likes AA 22-22, AA 2222, AA 2-222 etc.");
      return false;
    } else if (data.status == "not-use") {
      $(".license_no").text(license);
      $(".license_no").attr('purpose_no', data.veh_kind);
      confirm($('#unable_to_book').attr('title')+' '+ (license) +' '+ $('#unable_next_character').attr('title'));
      document.getElementById("license").value = "";
    }  else { //can booking license condition
      $('[name="lic_no"]').val(license);
      $('[name="customer_name"]').val($('[name="user_payer"]').val());
      $(".license_no").text(license);
      $(".license_no").attr('purpose_no', data.veh_kind);
      $("#Used").modal('show');
    }
  }
});
}
/* ================== click booking button from booking modal =======*/
$(document).on('click','.btn-booking', function(e){
  e.preventDefault();
  $.ajax({
    type:"POST",
    url: '/price-list/license-booking',
    data        : $('#price-list').serialize(), 
    dataType    : 'json' ,
    success:function(data) {
      //console.log(data.first_bill);
      if (data.status == "success") {
        $("#Used").modal('hide');
        alert($('#success_lic_book').attr('title'));
        $("#icode").addClass('disabled');
        var print_length =  $("#printList > .row ").length;
        if (print_length == 0) {
              $.each(data.price_detail,function(index,value){
                $("#printList").append('<div class="row " style="height: 30px;"><div style="width: 40px;">&nbsp;</div><div style="width: 55px;"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" style="height:35px;padding-left:8px;"></div><div style="width:488px;padding-left: 15px;" ><input type="text" class="border-0 item_name"  value="'+value['item_name']+'" name="item_name[]" readonly style="width:430px;height: 35px;font-family: Saysettha OT !important;"></div><div style="width:85px;text-align:center;" ><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]" style="width:75px;height:35px;text-align:center;padding-right: 28px;"></div><div  style="width:155px;"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" style="width:155px;height:35px;padding-right: 38px;" required></div><div  style="width:260px;margin-left: 15px;"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" style="width:260xp;height:35px;padding-right: 57px;"></div><div style="width: 25px;">&nbsp;</div></div>');
              });
        }
        printPreview(data);
        $("#license").val($("#license").val());
        $(".reciept_status").val('save');
        $("#current_bill").text(data.second_bill.price_receipt_no);
        $(".price_receipt_no, #autoBill").val(data.second_bill.price_receipt_no);
        $("#price_list_id").val(data.second_bill.id);
        $("#pList >tbody > tr").remove();
        $("#total_amt").val('');
        $("#icode").focus();
        $("#icode, #saveRecord").removeClass('disabled');
        $(".lic_booking").addClass('disabled');
       
      }
    }
  });
});


/* ============================== Print Button  =======================*/
$(document).on('click','.printBtn', function(e) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  if(checkName() == false){
    alert('ກະລຸນາປ້ອນຊື່');
    return false;
  } 
  if(checkDate() == false){
    alert($('#select_date').attr('title'));
    return false;
  }
  if(checkItem() == false){
    alert($('#at_least_item').attr('title'));
    return false;
  }
 
  if(checkQty() == false){
    alert('ກະລຸນາປ້ອນຈໍານວນ');
    return false;
  }
  if(checkQty() == false){
    alert('ກະລຸນາປ້ອນຈໍານວນ');
    return false;
  }
  if ($('.reciept_status').val() == 'cancel bill') {
    $('.reciept_status').val('cancel bill');
  } 
  var price_list_id = $("#price_list_id").val();
  /* save and print data if status is pending */
  if ($('.reciept_status').val() == 'pending' && price_list_id == '') {
    printSave();
  } else {
    $.ajax({
      type:"POST",
      url: '/price-list/print/'+ price_list_id,
      data: $('#price-list').serialize(), 
      dataType: 'json' ,
      success:function(data) {
        //console.log(data);
        $("#printList").html("");
        $("#icode").addClass('disabled');
        var print_length =  $("#printList > .row ").length;
        if (print_length == 0) {
              $.each(data.price_detail,function(index,value){
                $("#printList").append('<div class="row " style="height: 30px;"><div style="width: 40px;">&nbsp;</div><div style="width: 55px;"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" style="height:35px;padding-left:8px;"></div><div style="width:488px;padding-left: 15px;" ><input type="text" class="border-0 item_name"  value="'+value['item_name']+'" name="item_name[]" readonly style="width:430px;height: 35px;font-family: Saysettha OT !important;"></div><div style="width:85px;text-align:center;" ><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]" style="width:75px;height:35px;text-align:center;padding-right: 28px;"></div><div  style="width:155px;"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" style="width:155px;height:35px;padding-right: 38px;" required></div><div  style="width:260px;margin-left: 15px;"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" style="width:260xp;height:35px;padding-right: 57px;"></div><div style="width: 25px;">&nbsp;</div></div>');
              });
        }
        $('.reciept_status').val('printed');
        printPreview(data);
      }
    });
  } 
});
/* ======================================= */

//confrim box for print save
function doConfrimBox(msg, printYes, printNo)
{
   var confirmBox = $("#confirm");
   confirmBox.find(".print_message").text(msg);
   confirmBox.find(".yes,.no").unbind().click(function()
   {
     confirmBox.hide();
   });
   confirmBox.find(".yes").click(printYes);
   confirmBox.find(".no").click(printNo);
   confirmBox.show();
}

/*======================== save and print function when click print button while pending status ==========*/
function printSave() {
  doConfrimBox("ຕ້ອງການບັນທຶກກ່ອນບໍ່", function yes()
    {
      $.ajax({
        type:"POST",
        url: '/print-save-pricelist',
        data: $('#price-list').serialize(), 
        dataType: 'json' ,
        success:function(data) {
          $("#printList").html("");
          if (data != "not-success") {
            $("#icode").addClass('disabled');
            var print_length =  $("#printList > .row ").length;
            if (print_length == 0) {
                  $.each(data.price_detail,function(index,value){
                    $("#printList").append('<div class="row " style="height: 30px;"><div style="width: 40px;">&nbsp;</div><div style="width: 55px;"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" style="height:35px;padding-left:8px;"></div><div style="width:488px;padding-left: 15px;" ><input type="text" class="border-0 item_name"  value="'+value['item_name']+'" name="item_name[]" readonly style="width:430px;height: 35px;font-family: Saysettha OT !important;"></div><div style="width:85px;text-align:center;" ><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]" style="width:75px;height:35px;text-align:center;padding-right: 28px;"></div><div  style="width:155px;"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" style="width:155px;height:35px;padding-right: 38px;" required></div><div  style="width:260px;margin-left: 15px;"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" style="width:260xp;height:35px;padding-right: 57px;"></div><div style="width: 25px;">&nbsp;</div></div>');
                  });
                  printPreview(data);
            }
            
          } else {
            alert('something wrong');
            return false;
          }
          
        }
      });
    }, function no()
    {
      window.location.replace("/price-list/create?app_no="+ $('.AppNo').val()+ "&active_counter=" + $('#active_counter').val() + "&active_bill=" + $("#active_bill").val());
      return false;
    });
 }

 /*================================ Print Preview =============*/
 function printPreview(data)
 {
     var user_payer =  $('[name="print_user_payer"]');
  if ($('.reciept_status').val() == "printed") {  //print bill when status is "printed"
    $('[name="reciept_status"]').val("printed");
    $("#pList").find("input").attr("disabled", "disabled");
    $("#remove, #add").addClass('disabled');
    $("#price-cancel-bill").removeClass('disabled');
    $('#saveRecord').addClass('disabled');
    if(data.buy_lic){
      $(".lic_booking").addClass('disabled');
    }else{
      $(".lic_booking").removeClass('disabled');
    }
  } 
    if (data.price_list.app_form['app_no'] == null) { //check normal case bill or bill with app form
        user_payer.val(data.price_list.user_payer);
      $('[name="app_no"], [name="app_form_id"]').val('');
    } else { // print bill for existing app number
        $('[name="app_no"]').val(data.price_list.app_form['app_no']);
        $('[name="app_form_id"]').val(data.price_list.app_form_id);
        chassis_no = data.price_list.app_form.vehicle['chassis_no'];
         /*show customer name and lic no if app_purpose is not new car registration  */
        var app_purpose = data.price_list.app_form.app_form_purpose.map(function (e) { //get app_purpose id with array
          return parseInt(e.app_purpose_id);
        });
        //console.log(app_purpose);
        if (!app_purpose.includes(1)) {//if app form is not new car registration
            if(data.price_list.lic_book_no) {
                user_payer.val(data.price_list.user_payer+' + '+ data.price_list.lic_book_no.substr(-4));
            } else {
              if (data.price_list.app_form.vehicle.licence_no) {
                    user_payer.val(data.price_list.user_payer+' + '+ data.price_list.app_form.vehicle.licence_no.substr(-4));
                } else {
                    user_payer.val(data.price_list.user_payer);
                } 
            }
         
        } else {
            if (data.price_list.lic_book_no) {
                user_payer.val(data.price_list.user_payer+' + '+ data.price_list.lic_book_no.substr(-4));
            } else {
              user_payer.val(data.price_list.user_payer+' + '+ chassis_no);
            }
        }
       
    }
 
    // var t_amt = data.price_list.total_amt;
    // var total_price_amt = thousands_separator(t_amt);
    $('[name="date"]').val(data.price_list['date']);
    $('[name="service_counter"]').val(data.price_list.service_counter['name']);
    $('[name="service_counter_id"]').val(data.price_list.service_counter_id);
    $('[name="total_amt"]').val(thousands_separator(data.price_list.total_amt));
    $('[name="price_list_id"]').val(data.price_list.id);
    $('[name="reciept_status"]').val(data.price_list.reciept_status);
    $('[name="print_price_receipt_no"]').val(data.price_list.service_counter.name+ '.'+data.price_list.price_receipt_no);
    $('[name="ref_date"]').val(data.price_list['date']);
      $("#buy_lic_no").text(data.price_list.lic_book_no);
    $('.updated_by').text(data.price_list.staff.first_name+' '+ data.price_list.staff.last_name);
    jQuery('#print-paper').print();
 }

 /*========================================================================================== */
 //new bill come from select modal
$('.new_bill_from_select').click(function(e){
  e.preventDefault();
  $('#priceList').modal('hide');
  var price_id = $(this).data("id");
  $.ajax({
      type:"GET",
      url: '/new-bill-with-old'+ "/"+price_id,
      dataType: 'json',
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      success:function(data){
          // console.log(data);
        $.each(data.price_detail,function(index,value) {
        $("#pList > tbody").append('<tr><td width="50"><input type="text" class="border-0 item_code" value="'+value['item_code']+'" name="item_code[]" ></td><td width="100"><input type="text" class="border-0 item_name" value="'+value['item_name']+'" name="item_name[]" readonly><input type="hidden" class="border-0 item_name_en" value="'+value['item_name_en']+'" name="item_name_en[]"><input type="hidden" class="border-0 price_item_id" value="'+value['price_item_id']+'" name="price_item_id[]"></td><td width="20"><input type="number" class="qty"  value="'+value['quantity']+'" name="quantity[]"><input type="hidden" class="fine_percent"  value="'+value['fine_percent']+'" name="fine_percent[]" ></td><td width="50"><input type="text" class="border-0 price"  value="'+thousands_separator(value['price'])+'" name="unit_price[]" required></td><td width="50"><input type="text" class="border-0 sub_total"  value="'+thousands_separator(value['sub_total'])+'" name="sub_total[]" ></td><td><input type="hidden"  value="'+value['id']+'" name="detail_id[]"><a href="#" class="remove-detail">ລບລ້າງ</a></td></tr>');
        });
        
        $(".user_counter button:not(#btn_counter"+data.price_list.service_counter_id+ ")").attr('disabled', false).removeClass('active-counter');
        $(".user_counter #btn_counter"+data.price_list.service_counter_id).attr('disabled', true).addClass('active-counter');
        if(data.price_list.app_form_id == null){
          $('[name="app_no"], [name="user_payer"], [name="app_form_id"], #vehicle_kind').val('');
        }
        
        $('[name="app_no"]').val(data.price_list.app_form['app_no']);
        $('[name="user_payer"]').val(data.price_list.app_form['customer_name']);
        $('[name="user_payer"]').val(data.price_list.user_payer);
        $('[name="date"]').val(data.price_list['date']);
        $('.current_counter_name').text(data.price_list.service_counter['name']);
        $('#current_bill').text(data.bill_no);
        $('.updated_by').text(data.price_list.staff['first_name']+' '+ data.price_list.staff['last_name']);
        $('[name="service_counter_id"], [name="active_counter"]').val(data.price_list.service_counter_id);
        if(data.price_list.total_amt != null){
          $('[name="total_amt"]').val(thousands_separator(data.price_list.total_amt));
        }
        $('[name="app_form_id"]').val(data.price_list.app_form_id);
        $('[name="price_list_id"]').val(null);
        $('[name="reciept_status"]').val('pending');
        $('[name="price_receipt_no"], .price_receipt_no, #saveBill,[name="active_bill"]').val(data.bill_no);
        $('[name="license"]').val(data.price_list.lic_book_no);
        $('[name="cc"]').val(data.price_list.cc);
        $('[name="road_tax"]').val(data.price_list.road_tax);
        $('[name="note"]').val(data.price_list.note);
        $('[name="code"]').val(data.price_list.code);
        if(data.price_list.app_form_id != null){
             $('#vehicle_kind').val(data.price_list.app_form.vehicle['vehicle_kind_code']);
        }
       
      }
  });
});

///For buttons disabled and enabled conditions
$('.AppNo').focus(function(){
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
        if ($("#license").val() == '' && ($(".reciept_status").val() == "pending" || $(".reciept_status").val() == "save")) {
          $('#check-lic-booking').removeClass('disabled');
        }
      });
});

