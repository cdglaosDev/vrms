//validate for seat
$( "#seat" ).keyup(function() {
    if($(this).val()< 1  ){
          $('#err1').show();
         
    }else{
       $('#err1').hide();
    }
  
    });
    //validate for wheels
    $( "#wheel" ).keyup(function() {
    if($(this).val()< 1  ){
          $('#err2').show();
    }
    else{
       $(' #err2').hide();
    }
    });
//validate for engine no and chassis no
$(".eng-validate").keyup(function(event){
  this.value = this.value.trim().toUpperCase();
  
});
      //engine and chassis no vildate
      $(".eng-validate").keypress(function(event){
            var ew = event.which;
            if(ew == 32)
              return false;
            if(48 <= ew && ew <= 57)
              return true;
            if(65 <= ew && ew <= 90)
              return true;
            if(97 <= ew && ew <= 122)
              return true;
            if( ew == 45)
            return true;
          return false;
      });
       //cc, weight, and weight fill vilidate
       $(".num-dash-validate").keypress(function(event){
        var ew = event.which;
        if (ew != 46 && ew != 45 && ew > 31
          && (ew < 48 || ew > 57))
           return false;
      
        return true;
      });

       //width, long, height validate by vehicle for new form 
      $('#vehicleInfo1 .num-validate-vtype').keyup(function() {
        var v_type = $('#vehicleInfo1 .customer_vehicletype').val();
          if (v_type == null) {
              alert("You need to choose vehicle type.");
              return false;
          }
          if (v_type == 12 ) {
            this.value = this.value.replace(/[^0-9-]/g, '');
          
          } else {
            this.value = this.value.replace(/[^0-9]/g, '');
          }
        });
    

    //width, long, height validate by vehicle for edit form
    $('#updateForm .num-validate-vtype').keyup(function() {
      var v_type = $('#updateForm .customer_vehicletype').val();
        if (v_type == null) {
            alert("You need to choose vehicle type.");
            return false;
        }
        if (v_type == 12 ) {
          this.value = this.value.replace(/[^0-9-]/g, '');
        
        } else {
          this.value = this.value.replace(/[^0-9]/g, '');
        }
      });

    // clear width, height and row when change vehicle type
        $(document).on("change", '.customer_vehicletype', function () 
        { 
          $('.width, .long, .height').val('');
        
        });

      $('.date-year').datepicker({
        minViewMode: 2,
        format: 'yyyy'
      });
  


  //js for remove required attribute when change motorcycle in vehicle type
  // $(document).on("change", '.vehicle_type', function () 
  // { 
  //   $('#licence_number, #width, #long, #height, #steering').prop('required',false);
   
  // });