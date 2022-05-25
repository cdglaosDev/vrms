// validate field when submit import application in lists page
//to submit app form from save draft stage
//use both side for submit js
   $(document).on("click", ".app-submit", function(e) {
   e.preventDefault();
   if($(this).data('licence_no_need') == " " || $(this).data('vehicle_type_id') == " " || $(this).data('width') =="" || $(this).data('height') =="" ||
   $(this).data('long') ==" " || $(this).data('vehicle_kind_code') =="" || $(this).data('brand_id') =="" || $(this).data('weight') =="" ||
   $(this).data('weight_filled') ==" " || $(this).data('owner_name') =="" || $(this).data('model_id') =="" || $(this).data('total_weight') =="" ||  
   $(this).data('engine_no') ==""  || $(this).data('province_code') =="" || $(this).data('chassis_no') =="" || $(this).data('district_code') =="" || $(this).data('cc') =="" ||
   $(this).data('tax_no') =="" ||  $(this).data('tax_date') =="" ||  $(this).data('tax_payment_no') =="" ||  $(this).data('tax_payment_date') =="")
   {
      alert($(this).attr('title1'));
      return false;
   } else {
      $("#submit-box").modal('show');
      $("#submit-box #pre_app_id").val($(this).data('id'));
   }
   
});

//app status updated when click submit button
$('.submitButton').on('click', function(e) {
   $(this).addClass('disabled');
   e.preventDefault();
   $.ajax({
   method:"POST",
   url: submit_url,
   data:{_token:$('[name="_token"]').val(), pre_app_id:$('[name="pre_app_id"]').val()},
   success:function(response) {
   //console.log(response);
   if (response.status == 200) {
      //console.log(response);
         alert(response.message);
         $('#submit-box').modal('hide');
         $(".status_image"+response.pre_app_id).attr('src',"/images/in_progress.png");
         $("#submitApp"+response.pre_app_id).css("display", "none");
         $('.submitButton').removeClass('disabled');
   }
   },
   error: function(response) {
      alert('error');
   }
   });
   
});

//show delete modal pop
$(document).on("click", '.delete_btn_staff', function(e) {
   e.preventDefault();
   $("#deleteModel").modal('show');
   $("#pre_app_id").val($(this).data('id'));
});



//change app status when click delete button
$('.deleteButton').on('click', function(e){
  $(this).addClass('disabled');
  $.ajax({
   method:"POST",
   url: '/change-app-status',
   data:{_token:$('[name="_token"]').val(), pre_app_id:$('[name="pre_app_id"]').val()},
   success:function(response) {
      //console.log(response);
      if(response.status == 200){
         alert(response.message);
         $("#deleteModel").modal('hide');
         $(".deleteButton").removeClass('disabled');
         $(".status_image"+response.pre_app_id).attr('src',"/images/rejected.png");
         $("#submitApp"+response.pre_app_id).css("display", "none");
         $("#submitApp"+ response.pre_app_id).css("display","none");
         $("#edit_image"+response.pre_app_id).attr('src',"/images/edit_gray.png");
         $("#approve_img"+response.pre_app_id).attr('src',"/images/approve_gray.png");
         $("#approve_img"+response.pre_app_id).parent().removeAttribute('data-id').removeClass('approve');
         $("#reject_img"+response.pre_app_id).attr('src',"/images/reject_gray.png");
         $("#editImport"+response.pre_app_id).attr('data-url', '');
      }
   },
   error: function(response) {
      alert('error');
   }
   });
});


 