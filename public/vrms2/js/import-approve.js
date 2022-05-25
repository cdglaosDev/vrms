 //approve app from editmodal, newmodal and list page
 $(".approve, .approveBtn").one('click', function() {
   var pre_app_id = $(this).data('id');
    $.ajax({
         url: '/approve-importer-app'+'/'+pre_app_id,
         type: "POST",
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         success:function(data){  
         //alert(data.msg);return false;
            if(data.status == 'ok'){
               alert(data.msg);
               $(".approve, .approveBtn").addClass('disabled');
               $("#appNumber"+pre_app_id).text(data.app_number);
               $("#approve_img"+pre_app_id).attr('src',"/images/approve_gray.png");
               $("#reject_img"+pre_app_id).attr('src',"/images/reject_gray.png");
               $(".status_image"+pre_app_id).attr('src',"/images/approved.png");
            } else{
               alert(data.msg);
               return false;
            }
         }
    });
 });