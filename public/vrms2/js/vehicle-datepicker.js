$('.date-year').datepicker({
    minViewMode: 2,
    autoclose:true,
    format: 'yyyy'
});

$(".custom_date_vehicle").datepicker({
format: 'dd/mm/yyyy',
autoclose:true,
endDate: new Date(new Date().setDate(new Date().getDate() ))
});
  //date format for keypress
  $(".custom_date_vehicle, .custom_date").on('keydown', function (e) {
    IsNumeric(this, e.keyCode);
});
var isShift = false;
var seperator = "/";
function IsNumeric(input, keyCode) {
    if (keyCode == 16) {
        isShift = true;
    }
    //Allow only Numeric Keys.
    if (((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) && isShift == false) {
        if ((input.value.length == 2 || input.value.length == 5) && keyCode != 8) {
            input.value += seperator;
        }
        return true;
    }
    else {
        return false;
    }
};

$(".custom_date").datepicker({
    format: 'dd/mm/yyyy',
    autoclose:true,
   });

// $('.date-year, #import_permit_date,#industrial_doc_date, #technical_doc_date, #comerce_permit_date, #tax_payment_date, #police_doc_date, #tax_date').keydown(function(e) {
//     e.preventDefault();
//     return false;
//  });