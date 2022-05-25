//for draft button, no need to check info
$('.draftBtn').one('click', function(e) {
	e.preventDefault();
    var exist_vehicle_id = $('#vehicleInfo1 #exist_vehicle_id').val();
    var vehicle_kind = $('#vehicleInfo1 #vehicle_kind_code').val();
    var owner_name = $('#vehicleInfo1 #owner_name').val();
    var province = $('#vehicleInfo1 #province').val();
    var district = $('#vehicleInfo1 #district').val();
    var v_type = $('#vehicleInfo1 .customer_vehicletype').val();
    var steer = $('#vehicleInfo1 .steer').val();
    var gas = $('#vehicleInfo1 .gas').val();
    var remark = $('#vehicleInfo1 .remark').val();
    var cylinder = $('#vehicleInfo1 .cylinder').val();
    var cc = $('#vehicleInfo1 .cc').val();
    var color = $('#vehicleInfo1 .color').val();
    var brand = $('#vehicleInfo1 #vbrand').val();
    var vmodel = $('#vehicleInfo1 #vmodel').val();
    var width = $('#vehicleInfo1 .width').val();
    var long = $('#vehicleInfo1 .long').val();
    var height = $('#vehicleInfo1 .height').val();
    var seat = $('#vehicleInfo1 #seat').val();
    var weight = $('#vehicleInfo1 .weight').val();
    var weight_filled = $('#vehicleInfo1 .weight_filled').val();
    var total_weight = $('#vehicleInfo1 .total_weight').val();
    var axis = $('#vehicleInfo1 .axis').val();
    var wheel = $('#vehicleInfo1 .wheels').val();
    var year = $('#vehicleInfo1 .date-year').val();
    var motor_brand_id = $('#vehicleInfo1 .motor_brand_id').val();
    var import_permit_no = $('#vehicleInfo1 .import_permit_no').val();
    var import_permit_date = $('#vehicleInfo1 .import_permit_date').val();
    var industrial_doc_no = $('#vehicleInfo1 .industrial_doc_no').val();
    var industrial_doc_date = $('#vehicleInfo1 .industrial_doc_date').val();
    var technical_doc_no = $('#vehicleInfo1 .technical_doc_no').val();
    var technical_doc_date = $('#vehicleInfo1 .technical_doc_date').val();
    var comerce_permit_no = $('#vehicleInfo1 .comerce_permit_no').val();
    var comerce_permit_date = $('#vehicleInfo1 .comerce_permit_date').val();
    var tax_date = $('#vehicleInfo1 .tax_date').val();
    var tax_no = $('#vehicleInfo1 .tax_no').val();
    var tax_payment_no = $('#vehicleInfo1 .tax_payment_no').val();
    var tax_payment_date = $('#vehicleInfo1 .tax_payment_date').val();
    var police_doc_no = $('#vehicleInfo1 .police_doc_no').val();
    var police_doc_date = $('#vehicleInfo1 .police_doc_date').val();
    var engine_no = $('#vehicleInfo1 .engine_no').val();
    var chassis_no = $('#vehicleInfo1 .chassis_no').val();
    var license_no = $('#vehicleInfo1 .license_no').val();
    var village = $('#vehicleInfo1 #customer_village').val();
    var unit = $('#vehicleInfo1 .unit').val();
    var vehicle_note = $('#vehicleInfo1 .note').val();
    var vehicle_send = $('#vehicleInfo1 .vehicle_send').val();
    var comerce_permit = $('#vehicleInfo1 .comerce_permit').val();
    var licenseNoSpace = license_no.replace(/\s/g, '');
        if(data.includes(licenseNoSpace)){
            alert('License no already taken.plz choose another one.');
            return false;
        }else if(engineData.includes(engine_no)){
            alert($('.engine_no').attr('title1'));
            return false;
        }else if(chassisData.includes(chassis_no)){
            alert($('.chassis_no').attr('title1'));
            return false;
        } else {
          $.ajax({
              url: addImport ,
              type: "POST",
              data: {
                _token: $("#vehicleInfo1 #csrf").val(),
                vehicle_kind_code: vehicle_kind,owner_name: owner_name,province_code: province,district_code: district,
                vehicle_type_id:v_type, steering_id:steer, gas_id:gas, remark:remark, cylinder:cylinder,
                cc:cc,color_id:color,brand_id:brand,model_id:vmodel,width:width,long:long, height:height,
                seat:seat,weight:weight,weight_filled:weight_filled,total_weight:total_weight,axis:axis,wheels:wheel,
                year_manufacture:year,motor_brand_id:motor_brand_id,import_permit_no:import_permit_no,
                import_permit_date:import_permit_date,industrial_doc_no:industrial_doc_no,industrial_doc_date:industrial_doc_date,
                technical_doc_no:technical_doc_no,technical_doc_date:technical_doc_date,comerce_permit_no:comerce_permit_no,
                comerce_permit_date:comerce_permit_date,tax_date:tax_date,tax_no:tax_no,tax_payment_no:tax_payment_no,
                tax_payment_date:tax_payment_date,police_doc_no:police_doc_no,police_doc_date:police_doc_date,
                engine_no:engine_no,chassis_no:chassis_no,licence_no_need:license_no,village_name:village,save_type:$(this).attr('value'),
                unit:unit, vehicle_send:vehicle_send, note: vehicle_note, comerce_permit:comerce_permit, old_vehicle_id:exist_vehicle_id

              },
              cache: false,
              success: function(response){
                  //console.log(response);return false;
                  //var response = JSON.parse(response);
                  if(response.statusCode==200){
                      //console.log(response.message);
                      if(response.vehicle_id){
                        $(".vehicle_id").val(response.vehicle_id);
                        alert(response.message);		
                        $("#vehicleInfo1 .save-draft, #vehicleInfo1 .approveBtn").addClass('disabled');
                        $("#exist_vehicle_id").val(response.vehicle_id);
                        $("#submitBtn, .approveBtn").attr('data-id', response.pre_app_id);

                      }
                  } else if(response.statusCode == 201){
                     alert(response.msg);
                     
                  }
                  
              }
          });
      }
  });

  //for submit button, need to check info
$('.submitBtn').on('click', function(e) {
	e.preventDefault();
    var exist_vehicle_id = $('#vehicleInfo1 #exist_vehicle_id').val();
    var vehicle_kind = $('#vehicleInfo1 #vehicle_kind_code').val();
    var owner_name = $('#vehicleInfo1 #owner_name').val();
    var province = $('#vehicleInfo1 #province').val();
    var district = $('#vehicleInfo1 #district').val();
    var v_type = $('#vehicleInfo1 .customer_vehicletype').val();
    var steer = $('#vehicleInfo1 .steer').val();
    var gas = $('#vehicleInfo1 .gas').val();
    var remark = $('#vehicleInfo1 .remark').val();
    var cylinder = $('#vehicleInfo1 .cylinder').val();
    var cc = $('#vehicleInfo1 .cc').val();
    var color = $('#vehicleInfo1 .color').val();
    var brand = $('#vehicleInfo1 #vbrand').val();
    var vmodel = $('#vehicleInfo1 #vmodel').val();
    var width = $('#vehicleInfo1 .width').val();
    var long = $('#vehicleInfo1 .long').val();
    var height = $('#vehicleInfo1 .height').val();
    var seat = $('#vehicleInfo1 #seat').val();
    var weight = $('#vehicleInfo1 .weight').val();
    var weight_filled = $('#vehicleInfo1 .weight_filled').val();
    var total_weight = $('#vehicleInfo1 .total_weight').val();
    var axis = $('#vehicleInfo1 .axis').val();
    var wheel = $('#vehicleInfo1 .wheels').val();
    var year = $('#vehicleInfo1 .date-year').val();
    var motor_brand_id = $('#vehicleInfo1 .motor_brand_id').val();
    var import_permit_no = $('#vehicleInfo1 .import_permit_no').val();
    var import_permit_date = $('#vehicleInfo1 .import_permit_date').val();
    var industrial_doc_no = $('#vehicleInfo1 .industrial_doc_no').val();
    var industrial_doc_date = $('#vehicleInfo1 .industrial_doc_date').val();
    var technical_doc_no = $('#vehicleInfo1 .technical_doc_no').val();
    var technical_doc_date = $('#vehicleInfo1 .technical_doc_date').val();
    var comerce_permit_no = $('#vehicleInfo1 .comerce_permit_no').val();
    var comerce_permit_date = $('#vehicleInfo1 .comerce_permit_date').val();
    var tax_date = $('#vehicleInfo1 .tax_date').val();
    var tax_no = $('#vehicleInfo1 .tax_no').val();
    var tax_payment_no = $('#vehicleInfo1 .tax_payment_no').val();
    var tax_payment_date = $('#vehicleInfo1 .tax_payment_date').val();
    var police_doc_no = $('#vehicleInfo1 .police_doc_no').val();
    var police_doc_date = $('#vehicleInfo1 .police_doc_date').val();
    var engine_no = $('#vehicleInfo1 .engine_no').val();
    var chassis_no = $('#vehicleInfo1 .chassis_no').val();
    var license_no = $('#vehicleInfo1 .license_no').val();
    var village = $('#vehicleInfo1 #customer_village').val();
    var unit = $('#vehicleInfo1 .unit').val();
    var vehicle_note = $('#vehicleInfo1 .note').val();
    var vehicle_send = $('#vehicleInfo1 .vehicle_send').val();
    var comerce_permit = $('#vehicleInfo1 .comerce_permit').val();
    var licenseNoSpace = license_no.replace(/\s/g, '');
        if(license_no.trim() == '' ){
           alert($('#new-license').attr('title'));
            $(".license_no").focus();
            return false;
        } else if(data.includes(licenseNoSpace)){
            alert('License no already taken.plz choose another one.');
            return false;
        } else if(vehicle_kind == null){
           alert($('#vehicle_kind_code').attr('title'));
            $("#vehicle_kind_code").focus();
            return false;
        } else if(owner_name.trim() == '' ){
            alert($('#owner_name').attr('title'));
            $("#owner_name").focus();
            return false;
        } else if(province == null ){
           alert($('#province').attr('title'));
            $("#province").focus();
            return false;
        } else if(district == null ){
            alert($('#district').attr('title'));
            $("#district").focus();
            return false;
        } else if(v_type == null ){
            alert($('.customer_vehicletype').attr('title'));
            $(".customer_vehicletype").focus();
            return false;
        } else if(cc.trim() == '' ){
             alert($('.cc').attr('title'));
            $(".cc").focus();
            return false;
        }else if(brand == null ){
            alert($('#vbrand').attr('title'));
            $("#vbrand").focus();
            return false;
        } else if(vmodel == null ){
          alert($('#vmodel').attr('title'));
            $("#vmodel").focus();
            return false;
        } else if(engine_no.trim() == '' ){
            alert($('.engine_no').attr('title'));
            $('.engine_no').focus();
            return false;
        }else if(chassis_no.trim() == '' ){
            alert($('.chassis_no').attr('title'));
            $(".chassis_no").focus();
            return false;
        }else if(engineData.includes(engine_no)){
            alert($('.engine_no').attr('title1'));
            return false;
        }else if(chassisData.includes(chassis_no)){
            alert($('.chassis_no').attr('title1'));
            return false;
        } else if(v_type != 12 && width.trim() == '' ){
            alert($('.width').attr('title'));
            $(".width").focus();
            return false;
        } else if(v_type != 12 && long.trim() == ''){
            alert($('.long').attr('title'));
            $(".long").focus();
            return false;
        } else if(v_type != 12 && height.trim() == '') {
            alert($('.height').attr('title'));
            $(".height").focus();
            return false;
        }else if(width.trim() == '' ){
            alert($('.width').attr('title'));
            $(".width").focus();
            return false;
        }else if(long.trim() == '' ){
             alert($('.long').attr('title'));
            $(".long").focus();
            return false;
        }else if(height.trim() == '' ){
            alert($('.height').attr('title'));
            $(".height").focus();
            return false;
        }  else if(weight.trim() == '' ){
           alert($('.weight').attr('title'));
            $(".weight").focus();
            return false;
        } else if(weight_filled.trim() == '' ){
            alert($('.weight_filled').attr('title'));
            $(".weight_filled").focus();
            return false;
        } else if(total_weight.trim() == '' ){
             alert($('.total_weight').attr('title'));
            $(".total_weight").focus();
            return false;
        } else if(axis.trim() == '' ){
            alert($('.axis').attr('title'));
           $(".axis").focus();
           return false;
       } else if(wheel.trim() == '' ){
            alert($('.wheels').attr('title'));
            $(".wheels").focus();
            return false;
        } else if(tax_no.trim() == '' ){
            alert($('.tax_no').attr('title'));
            $(".tax_no").focus();
            return false;
        }else if(tax_date.trim() == '' ){
             alert($('.tax_date').attr('title'));
            $(".tax_date").focus();
            return false;
        }else if(tax_payment_no.trim() == '' ){
            alert($('.tax_payment_no').attr('title'));
            $(".tax_payment_no").focus();
            return false;
        } else if(tax_payment_date.trim() == '' ){
           alert($('.tax_payment_date').attr('title'));
            $(".tax_payment_date").focus();
            return false;
        }  else {
          $.ajax({
              url: addImport ,
              type: "POST",
              data: {
                _token: $("#vehicleInfo1 #csrf").val(),
                vehicle_kind_code: vehicle_kind,owner_name: owner_name,province_code: province,district_code: district,
                vehicle_type_id:v_type, steering_id:steer, gas_id:gas, remark:remark, cylinder:cylinder,
                cc:cc,color_id:color,brand_id:brand,model_id:vmodel,width:width,long:long, height:height,
                seat:seat,weight:weight,weight_filled:weight_filled,total_weight:total_weight,axis:axis,wheels:wheel,
                year_manufacture:year,motor_brand_id:motor_brand_id,import_permit_no:import_permit_no,
                import_permit_date:import_permit_date,industrial_doc_no:industrial_doc_no,industrial_doc_date:industrial_doc_date,
                technical_doc_no:technical_doc_no,technical_doc_date:technical_doc_date,comerce_permit_no:comerce_permit_no,
                comerce_permit_date:comerce_permit_date,tax_date:tax_date,tax_no:tax_no,tax_payment_no:tax_payment_no,
                tax_payment_date:tax_payment_date,police_doc_no:police_doc_no,police_doc_date:police_doc_date,
                engine_no:engine_no,chassis_no:chassis_no,licence_no_need:license_no,village_name:village,save_type:$(this).attr('value'),
                unit:unit, vehicle_send:vehicle_send, note: vehicle_note, comerce_permit:comerce_permit, old_vehicle_id:exist_vehicle_id

              },
              cache: false,
              success: function(response){
                console.log(response);
                  //var response = JSON.parse(response);
                  if(response.statusCode==200){
                      //console.log(response.message);
                      if(response.vehicle_id){
                        $(".vehicle_id").val(response.vehicle_id);
                        alert(response.message);		
                        $("#vehicleInfo1 .save-draft, #vehicleInfo1 .save-submit").addClass('disabled');
                        $(".approveBtn").removeClass('disabled');
                        $("#submitBtn, .approveBtn").attr('data-id', response.pre_app_id);
                      }
                  } else if(response.statusCode == 201){
                     alert(response.msg);
                     
                  }
                  
              }
          });
      }
  });

  //save submit button after save record in new modal form
//   $("#submitBtn").on("click", function() {
//     $("#submit-box").modal('show');
//     $('#submitForm').on('submit',function(e){
//         e.preventDefault();
//         $.ajax({
//           method:"POST",
//           url: '/submit-app-by-modal/'+ $("#submitBtn").data('id'),
//           data:{_token:$('[name="_token"]').val()},
//           success:function(response) {
             
//             if(response.status == 200){
//                 alert(response.message);
//                 $("#submit-box").modal('hide');
//                 $("#submitBtn").addClass('disabled');
//                 $('#approveBtn').removeClass('disabled');
//             }
//           },
//           error: function(response) {
//               alert('error');
//           }
//         });
//     });
//  });

  //add tenant
//   $('.tenant').on('click', function(e) {
// 	e.preventDefault();
//     var detailId = $('#tenant1 .vehicle_id').val();
//     if(detailId == ""){
//         alert('Need to add Vehicle first.');
//         return false;
//     }
//       var tenant_name = $('#tenant1 .tenant_name').val();
//       var province_code = $('#tenant1 #tenant_province').val();
//       var district_code = $('#tenant1 #tenant_district').val();
//       var village = $('#tenant1 .village').val();
//       var phone = $('#tenant1 .phone').val();
//       var note = $('#tenant1 .note').val();
     
//       if(tenant_name!="" && province_code!="" && district_code!="" && phone!=""){
      
//           $.ajax({
//               url: addTenant,
//               type: "POST",
//               data: {
//                 _token: $("#vehicleInfo1 #csrf").val(),
//                 tenant_name: tenant_name,province_code: province_code,district_code: district_code,village: village,
//                 phone:phone, note:note,vehicle_detail_id:detailId
//               },
//               cache: false,
//               success: function(response){
               
//                   if(response.status==200){
//                    alert('Tenant added.');			
//                   }
//                   else if(response.status==201){
//                      alert("Error occured !");
//                   }
                  
//               }
//           });
//       }
//       else{
//           alert('Please fill all the field !');
//       }
//   });

//add document
  $('#myForm').on('submit',(function(e) {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     
    e.preventDefault();
    var vehId = $("#myForm .vehicle_id").val();
   if(vehId == ""){
       alert('Need to add vehicle first.');
       return false;
   }
    var formData = new FormData(this);
    $.ajax({
       type:'POST',
       url: addDoc,
       data:formData,
       cache:false,
       contentType: false,
       processData: false,
       success: function(response) 
        {
          alert(response.msg);
        }

    });
}));
