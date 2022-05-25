   //update record for import
   $('.edit-form').on('click', function(e) {
	e.preventDefault();
    console.log($('.tax_no').attr('title'));
      var vehicle_kind = $('#updateForm #vehicle_kind_code').val();
      var owner_name = $('#updateForm #owner_name').val();
      var province = $('#updateForm #edit-province').val();
      var district = $('#updateForm #edit-district').val();
      var v_type = $('#updateForm .customer_vehicletype').val();
      var steer = $('#updateForm .steer').val();
      var gas = $('#updateForm .gas').val();
      var remark = $('#updateForm .remark').val();
      var cylinder = $('#updateForm .cylinder').val();
      var cc = $('#updateForm .cc').val();
      var color = $('#updateForm .color').val();
      var brand = $('#updateForm #edit-vbrand').val();
      var vmodel = $('#updateForm #edit-vmodel').val();
      var width = $('#updateForm .width').val();
      var long = $('#updateForm .long').val();
      var height = $('#updateForm .height').val();
      var seat = $('#updateForm #seat').val();
      var weight = $('#updateForm .weight').val();
      var weight_filled = $('#updateForm .weight_filled').val();
      var total_weight = $('#updateForm .total_weight').val();
      var axis = $('#updateForm .axis').val();
      var year = $('#updateForm .date-year').val();
      var motor_brand_id = $('#updateForm .motor_brand_id').val();
      var import_permit_no = $('#updateForm .import_permit_no').val();
      var import_permit_date = $('#updateForm .import_permit_date').val();
      var industrial_doc_no = $('#updateForm .industrial_doc_no').val();
      var industrial_doc_date = $('#updateForm .industrial_doc_date').val();
      var technical_doc_no = $('#updateForm .technical_doc_no').val();
      var technical_doc_date = $('#updateForm .technical_doc_date').val();
      var comerce_permit_no = $('#updateForm .comerce_permit_no').val();
      var comerce_permit_date = $('#updateForm .comerce_permit_date').val();
      var tax_date = $('#updateForm .tax_date').val();
      var tax_no = $('#updateForm .tax_no').val();
      var tax_payment_no = $('#updateForm .tax_payment_no').val();
      var tax_payment_date = $('#updateForm .tax_payment_date').val();
      var police_doc_no = $('#updateForm .police_doc_no').val();
      var police_doc_date = $('#updateForm .police_doc_date').val();
      var engine_no = $('#updateForm .engine_no').val();
      var chassis_no = $('#updateForm .chassis_no').val();
      var license_no = $('#updateForm .license_no').val();
      var old_license = $("#old-license").val();
      var village = $('#updateForm #customer_village').val();
      var save_type = $(this).val();
      var newLicense =  license_no.replace(/\s/g, '');
      var oldLicense = old_license.replace(/\s/g, '');
      var licenseArr = data.filter(function(e) { return e !== oldLicense });
      var engineArr = engineData.filter(function(e) { return e !== engine_no });
      var chassisArr = chassisData.filter(function(e) { return e !== chassis_no });
         
        if(license_no.trim() == '' ){
           alert($('#edit-license').attr('title'));
            $(".license_no").focus();
            return false;
           
        } else if(licenseArr.includes(newLicense)){
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
            alert($('#edit-province').attr('title'));
            $("#province").focus();
            return false;
        } else if(district == null ){
            alert($('#edit-district').attr('title'));
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
            alert($('#edit-vbrand').attr('title'));
            $("#edit-vbrand").focus();
            return false;
        } else if(vmodel == null ){
            alert($('#edit-vmodel').attr('title'));
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
        }else if(engineArr.includes(engine_no)){
            alert('Engine No already taken.');
            return false;
        }else if(chassisArr.includes(chassis_no)){
            alert('Chassis No already taken.');
            return false;
        } else if(v_type != 12 && width.trim() == '' ){
            alert($('.width').attr('title'));
            $(".width").focus();
            return false;
        } else if(v_type != 12 && long.trim() == ''){
            alert($('.long').attr('title'));;
            $(".long").focus();
            return false;
        } else if(v_type != 12 && height.trim() == '') {
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
              url: editImport +'/'+ $("#vehicleDetailId").val(),
              type: "PATCH",
              data: {
                _token: $("#updateForm input[name='_token']").val(),
                vehicle_kind_code: vehicle_kind,owner_name: owner_name,province_code: province,district_code: district,
                vehicle_type_id:v_type, steering_id:steer, gas_id:gas, remark:remark, cylinder:cylinder,
                cc:cc,color_id:color,brand_id:brand,model_id:vmodel,width:width,long:long, height:height,
                seat:seat,weight:weight,weight_filled:weight_filled,total_weight:total_weight,axis:axis,
                year_manufacture:year,motor_brand_id:motor_brand_id,import_permit_no:import_permit_no,
                import_permit_date:import_permit_date,industrial_doc_no:industrial_doc_no,industrial_doc_date:industrial_doc_date,
                technical_doc_no:technical_doc_no,technical_doc_date:technical_doc_date,comerce_permit_no:comerce_permit_no,
                comerce_permit_date:comerce_permit_date,tax_date:tax_date,tax_no:tax_no,tax_payment_no:tax_payment_no,
                tax_payment_date:tax_payment_date,police_doc_no:police_doc_no,police_doc_date:police_doc_date,
                engine_no:engine_no,chassis_no:chassis_no,licence_no_need:license_no,village_name:village, save_type:save_type
              },
          
              success: function(response){
               var response = JSON.parse(response);
                  if(response.statusCode==200){
                      if(response.app_status == "submit"){
                          alert('Successful submit.');
                      } else {
                           alert('Successful updated.');
                      }
                  } else if(response.statusCode==201){
                     alert(response.msg);
                  }
                  
              }
          });
        }
  });