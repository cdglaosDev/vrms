$(document).on("click", "#btnVinfoSave", function (e) {
    e.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    var id = $(form).find('input[name=id]').val();

    var license_no = $(form).find('input[name=licence_no]').val();
    license_no = (license_no == "0000") ? '' : license_no;
    var old_license = $(form).find('input[name=old_license]').val();

    var issue_date = $(form).find('input[name=issue_date]').val();
    var expire_date = $(form).find('input[name=expire_date]').val();

    var vehicle_kind = $(form).find('select[name=vehicle_kind_code]').val();
    var owner_name = $(form).find('input[name=owner_name]').val();
    var province = $(form).find('select[name=province_code]').val();
    var district = $(form).find('select[name=district_code]').val();
    var v_type = $(form).find('select[name=vehicle_type_id]').val();
    var cc = $(form).find('input[name=cc]').val();
    var brand = $(form).find('select[name=brand_id]').val();
    var vmodel = $(form).find('select[name=model_id]').val();
    var engine_no = $(form).find('input[name=engine_no]').val();
    engine_no = engine_no.replace(/[\;\:\.\,\/\\\s-]/g, "").toUpperCase();
    $(form).find('input[name=engine_no]').val(engine_no);//For refresh UI
    var chassis_no = $(form).find('input[name=chassis_no]').val();
    chassis_no = chassis_no.replace(/[\;\:\.\,\/\\\s-]/g, "").toUpperCase();
    $(form).find('input[name=chassis_no]').val(chassis_no);//For refresh UI

    var width = $(form).find('input[name=width]').val();
    var long = $(form).find('input[name=long]').val();
    var height = $(form).find('input[name=height]').val();
    var weight = $(form).find('input[name=weight]').val();
    var weight_filled = $(form).find('input[name=weight_filled]').val();
    var total_weight = $(form).find('input[name=total_weight]').val();
    var axis = $(form).find('input[name=axis]').val();
    var wheels = $(form).find('input[name=wheels]').val();
    var tax_no = $(form).find('input[name=tax_no]').val();
    var tax_date = $(form).find('input[name=tax_date]').val();
    var tax_payment_no = $(form).find('input[name=tax_payment_no]').val();
    var tax_payment_date = $(form).find('input[name=tax_payment_date]').val();

    var newLicense = license_no.replace(/\s/g, '');
    var oldLicense = old_license.replace(/\s/g, '');   
    
    if (oldLicense.trim() != '' && license_no.trim() == '') {
        alert($(form).find('input[name=licence_no]').attr('title'));
        $(form).find('input[name=licence_no]').focus();
        return false;
    } 
    // else if (license_no.trim() != '') {
    //     if (licenseData.includes(newLicense)) {
    //         alert($(form).find('input[name=license_no_already_title]').attr('title'));
    //         $(form).find('input[name=licence_no]').focus();
    //         return false;
    //     }
    // } 
    
    if (issue_date.trim() != '' && expire_date.trim() != '') {
        var arr_issue_date = issue_date.split("/");
        var arr_expire_date = expire_date.split("/");

        issue_date = new Date(arr_issue_date[2], arr_issue_date[1], arr_issue_date[0]);
        expire_date = new Date(arr_expire_date[2], arr_expire_date[1], arr_expire_date[0]);
        if(issue_date >= expire_date){
            alert($(form).find('input[name=expire_title]').attr('title'));
            $(form).find('input[name=expire_date]').focus();
            return false;
        }
    } else if (vehicle_kind == null) {
        alert($(form).find('select[name=vehicle_kind_code]').attr('title'));
        $(form).find('select[name=vehicle_kind_code]').focus();
        return false;
    } else if (owner_name.trim() == '') {
        alert($('#owner_name').attr('title'));
        $("#owner_name").focus();
        return false;
    } else if (province == null) {
        alert($('.cls_province_code').attr('title'));
        $(".cls_province_code").focus();
        return false;
    } else if (district == null) {
        alert($(form).find('select[name=district_code]').attr('title'));
        $(form).find('select[name=district_code]').focus();
        return false;
    } else if (v_type == null) {
        alert($('#vehicle_type').attr('title'));
        $("#vehicle_type").focus();
        return false;
    } else if (cc.trim() == '') {
        alert($('#v-cc').attr('title'));
        $("#v-cc").focus();
        return false;
    } else if (brand == null) {
        alert($(form).find('select[name=brand_id]').attr('title'));
        $(form).find('select[name=brand_id]').focus();
        return false;
    } else if (vmodel == null) {
        alert($(form).find('select[name=model_id]').attr('title'));
        $(form).find('select[name=model_id]').focus();
        return false;
    } 
    
    if (engine_no.trim() == '') {
        alert($(form).find('input[name=engine_no]').attr('title'));
        $(form).find('input[name=engine_no]').focus();
        return false;
    }else if (engineData.includes(engine_no)) {
        alert($(form).find('input[name=engine_already_title]').attr('title'));
        $(form).find('input[name=engine_no]').focus();
        return false;
    } 
    
    if (chassis_no.trim() == '') {
        alert($(form).find('input[name=chassis_no]').attr('title'));
        $(form).find('input[name=chassis_no]').focus();
        return false;
    } else if (chassisData.includes(chassis_no)) {
        alert($(form).find('input[name=chassis_already_title]').attr('title'));
        $(form).find('input[name=chassis_no]').focus();
        return false;
    } 
    
    if (v_type != 12 && width.trim() == '') {
        alert($('#width').attr('title'));
        $("#width").focus();
        return false;
    } else if (v_type != 12 && long.trim() == '') {
        alert($('#long').attr('title'));;
        $("#long").focus();
        return false;
    } else if (v_type != 12 && height.trim() == '') {
        alert($('#height').attr('title'));
        $("#height").focus();
        return false;
    } else if (weight.trim() == '') {
        alert($('#weight').attr('title'));
        $("#weight").focus();
        return false;
    } else if (weight_filled.trim() == '') {
        alert($('#weight_filled').attr('title'));
        $("#weight_filled").focus();
        return false;
    } else if (total_weight.trim() == '') {
        alert($('#total_weight').attr('title'));
        $("#total_weight").focus();
        return false;
    } else if (axis.trim() == '') {
        alert($('#axis').attr('title'));
        $("#axis").focus();
        return false;
    } else if (wheels.trim() == '') {
        alert($('#wheels').attr('title'));
        $("#wheels").focus();
        return false;
    } else if (tax_no.trim() == '') {
        alert($('#tax_no').attr('title'));
        $("#tax_no").focus();
        return false;
    } else if (tax_date.trim() == '') {
        alert($('#tax_date').attr('title'));
        $("#tax_date").focus();
        return false;
    } else if (tax_payment_no.trim() == '') {
        alert($('#tax_payment_no').attr('title'));
        $("#tax_payment_no").focus();
        return false;
    } else if (tax_payment_date.trim() == '') {
        alert($('#tax_payment_date').attr('title'));
        $("#tax_payment_date").focus();
        return false;
    }

    $.ajax({
        url: "/update-vehicle/" + id,
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            //console.log(data);
            if (data.status == "OK") {
                alert(data.message);

                $('#' + 'vModal' + id).modal('toggle');
                vehicleModal(id, "re_load");

                //For refreshing list page
                searchVehicles(0);
                
            } else if (data.status == "error") {
                alert(data.message);
            } else if (data.status == "lic_duplicate"){
                alert(data.message);
                $("#lic_control_btn").removeClass("disable-btn");
            } else if (data.status == "div_duplicate" || data.status == "pro_duplicate"){
                alert(data.message);
                $("#div_control_btn").removeClass('disable-btn');
            } else {
                alert('Error in updating Vehicle Information!');
            }
        },
        error: function (data) {
            // console.log(data);
            var err = JSON.parse(data.responseText);
            alert(err.message + "\n" + data.responseText);
        }
    });

});