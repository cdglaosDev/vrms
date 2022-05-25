// this is used for license no booking page
$(document).on("click", '.delete_btn', function (e) {
    document.getElementById("deleteform").action = '/license-number-booking' + "/" + $(this).data('id');
});

//change maxlength depend on change vehicle kind
$('.vehicle_kind').change(function () {
    $('.license_no').val("");
    $("#origin_lic").val("");
    var kind = $(this).val();
    // var originKind = $(".vehicle_kind").val();
    $(".vehicle_kind").val(kind);
    $(".upd_kind").val(kind);
    if (kind != 5 || kind != 8) {
        $('.license_no').attr('maxlength', 7);

    } else {
        $('.license_no').attr('maxlength', 8);

    }

});

//check space for license no booking input box
$('.license_no').keyup(function () {
    var vehicle_kind = $('.upd_kind').val();
    var originKind = $(".vehicle_kind").val();
    if (vehicle_kind == null) {
        alert("You must choose vehicle kind.");
        return false;
    }

    if (originKind == 5 || originKind == 8 || vehicle_kind == 5 || vehicle_kind == 8) {
        $(this).attr('maxlength', 8);
        var code = $(this).val();
        code = code.replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_]/g, '');
        $(this).val(code);

    } else {
        $(this).attr('maxlength', 7);
        var code = $(this).val().split(" ").join("");
        if (code.length > 0) {
            code = code.split(/(?=.{4}$)/).join(' ').replace(/[!@\/\\#+()$~%^&,`.'";|\[\]:*?<>{}=_-]/g, '');
        }
        $(this).val(code);
    }

});

//check status available or not available for new form
$(document).on("click", '.check-status', function () {
    var lic_no = $("#license_no").val();
    if (isNumeric(lic_no)) {
        alert("ກະລຸນາປ້ອນເລກທະບຽນໃຫ້ຖືກຕ້ອງ");
        return false;
    }
    if (checkLicFormat(lic_no) == false) {
        alert('ຮູບແບບເລກທະບຽນຄວນເປັນ ກກ 2345');
        return false;
    }

    //var lic_no = lic_number.replace(/\s/g,'');
    var vehicle_kind = $("#lic_booking_addModel .vehicle_kind").val();
    var province_code = $("#lic_booking_addModel .province").val();
    var vehicle_type_group_id = $("#lic_booking_addModel #vehicle_type_group_id").val();
    if (vehicle_kind == null) {
        alert($("#lic_booking_addModel .vehicle_kind").attr('title1'));
        $("#lic_booking_addModel .vehicle_kind").focus();
        return false;
    }
    if (vehicle_type_group_id == null) {
        alert($("#lic_booking_addModel #vehicle_type_group_id").attr('title1'));
        $("#lic_booking_addModel #vehicle_type_group_id").focus();
        return false;
    }
    if (province_code == null) {
        alert($("#lic_booking_addModel .province").attr('title1'));
        $("#lic_booking_addModel .province").focus();
        return false;
    }

    var oldId = $("#new-id").val();
    checkAvailableStatus(lic_no, vehicle_kind, province_code, vehicle_type_group_id, oldId);
});
//check status available or not available for update
$("#upd-check-status").click(function (e) {
    var lic_no = $("#upd_license_no").val();
    if (isNumeric(lic_no)) {
        alert("ກະລຸນາປ້ອນເລກທະບຽນໃຫ້ຖືກຕ້ອງ");
        return false;
    }
    if (checkLicFormat(lic_no) == false) {
        alert('ຮູບແບບເລກທະບຽນຄວນເປັນ ກກ 2345');
        return false;
    }
    var vehicle_kind = $("#lic_booking_editModel .vehicle_kind").val();
    var province_code = $("#lic_booking_editModel .province").val();
    var vehicle_type_group_id = $("#lic_booking_editModel #vehicle_type_group_id").val();

    if (vehicle_kind == null) {
        alert($("#lic_booking_editModel .vehicle_kind").attr('title1'));
        $("#lic_booking_editModel .vehicle_kind").focus();
        return false;
    }
    if (vehicle_type_group_id == null) {
        alert($("#lic_booking_editModel #vehicle_type_group_id").attr('title1'));
        $("#lic_booking_editModel #vehicle_type_group_id").focus();
        return false;
    }
    if (province_code == null) {
        alert($("#lic_booking_editModel .province").attr('title1'));
        $("#lic_booking_editModel .province").focus();
        return false;
    }

    var oldId = $("#edit-id").val();
    checkAvailableStatus(lic_no, vehicle_kind, province_code, vehicle_type_group_id, oldId);
});

//check status function 
function checkAvailableStatus(lic_no, veh_kind, province_code, vehicle_type_group_id, oldId = null) {
    var url = "/check-license?lic_no=" + lic_no + "&province_code=" + province_code + "&veh_kind=" + veh_kind + "&id=" + oldId + "&vehicle_type_group_id=" + vehicle_type_group_id;
    $.get(url, function (response) {
        //console.log(response);

        if (response == "Not-Available") {
            $(".status, .upd-status").text(response).css("color", "red");
            $(".control-save").css("pointer-events", "none").addClass('disabled');
        } else {
            $(".status, .upd-status").text(response).css("color", "green");
            $(".control-save").css("pointer-events", "auto").removeClass('disabled');
        }
    })
}

// get application form by province at license no booking
$('#lic_booking_addModel .province,#lic_booking_addModel .vehicle_kind,#lic_booking_addModel #vehicle_type_group_id').change(function () {
    var veh_kind = $("#lic_booking_addModel .vehicle_kind").val();
    if (veh_kind == "") {
        alert('need to choose vehicle kind.');
        return false;
    }
    var app_old_id = $("#new-app-id").val();
    var province_code = $("#lic_booking_addModel .province").val();
    var v_type = $("#lic_booking_addModel #vehicle_type_group_id").val();
    checkAppForm(veh_kind, province_code, app_old_id, v_type);
});

// get application form by province at license no booking for update
$('#lic_booking_editModel .province, #lic_booking_editModel .vehicle_kind, #lic_booking_editModel #vehicle_type_group_id').change(function () {
    var veh_kind = $("#lic_booking_editModel .vehicle_kind").val();
    if (veh_kind == "") {
        alert('need to choose vehicle kind.');
        return false;
    }
    var app_old_id = $("#edit-app-id").val();
    var province_code = $("#lic_booking_editModel .province").val();
    var v_type = $("#lic_booking_editModel #vehicle_type_group_id").val();
    checkAppForm(veh_kind, province_code, app_old_id, v_type);
});

//check status function 
function checkAppForm(veh_kind, province_code, app_old_id = null, v_type) {
    var url = "/get-app-form?province_code=" + province_code + "&veh_kind=" + veh_kind + "&id=" + app_old_id + "&v_type=" + v_type;
    $.get(url, function (response) {
        //console.log(response);
        if (response) {
            $.each(response, function (key, value) {
                $('.app_no').append('<option value="' + key + '">' + value + '</option>');
            });
        }
    })
}

//get customer name when onchange 
$('.app_no').change(function () {
    var app_id = $(this).val();
    if (app_id) {
        $.ajax({
            type: "GET",
            url: '/get-customer-name' + "/" + app_id,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            success: function (data) {
                //console.log(data);
                if (data.customer_name) {
                    $('input[name="customer_name"]').val(data.customer_name);

                } else {
                    $('input[name="customer_name"]').val("");
                }
            }
        });
    } else {
        $('input[name="customer_name"]').val("");

    }
});

function isNumeric(val) {
    return /^-?\d+$/.test(val);
}

$("#control-save").click(function (e) {
    e.preventDefault();
    var province = $("#lic_booking .province :selected").val();
    var appForm = $("#lic_booking .app_no :selected").val();
    var vehicle_kind = $('#lic_booking .upd_kind').val();
    var originKind = $("#lic_booking .vehicle_kind :selected").val();
    var licenseNo = $('#lic_booking .license_no').val();
    if (isNumeric(licenseNo)) {
        alert("ກະລຸນາປ້ອນເລກທະບຽນໃຫ້ຖືກຕ້ອງ");
        return false;
    }
    var myform = $("#lic_booking");
    var oldId = $("#new-id").val();
    var v_type = $("#lic_booking #vehicle_type_group_id :selected").val();
    checkLicense(province, vehicle_kind, originKind, licenseNo, appForm, myform, oldId, v_type);

});

$("#upd-control-save").click(function (e) {
    e.preventDefault();
    var province = $("#editform .province :selected").val();
    var appForm = $("#editform .app_no :selected").val();
    var vehicle_kind = $('#editform .upd_kind').val();
    var originKind = $("#editform .vehicle_kind").val();
    var licenseNo = $('#editform .license_no').val();
    if (isNumeric(licenseNo)) {
        alert("ກະລຸນາປ້ອນເລກທະບຽນໃຫ້ຖືກຕ້ອງ");
        return false;
    }
    var myform = $("#editform");
    var oldId = $("#edit-id").val();
    var v_type = $("#editform #vehicle_type_group_id :selected").val();
    checkLicense(province, vehicle_kind, originKind, licenseNo, appForm, myform, oldId, v_type);

});

function checkLicense(province, vehicle_kind, originKind, licenseNo, appForm, myform, oldId = null, v_type) {
    var url = "/check-license-booking?vehicle_kind=" + originKind + "&province=" + province + "&licenseNo=" + licenseNo + "&id=" + oldId + "&v_type=" + v_type;
    $.get(url, function (response) {
        //console.log(response);
        var lastTwoNo = licenseNo.slice(licenseNo.length - 2);
        if (vehicle_kind == 5 || vehicle_kind == 8 || originKind == 5 || originKind == 8) {
            if (originKind == null || originKind == "") {
                alert('Vehicle Kind should not be blank.');
            } else if (v_type == null || v_type == "") {
                alert('Vehicle Type Group should not be blank.');
            } else if (province == null || province == "") {
                alert('Province should not be blank.');
            } else if (appForm == null || appForm == "") {
                alert('Application should not be blank.');
            } else if (response.status == "used") {
                alert(response.message);
                return false;
            } else if (response.status == "not_exist") {
                alert(response.message);
                return false;
            } else if (lastTwoNo == 27 || lastTwoNo == 67) {
                alert('Number that ending with "27" and "67" not allow to book.');
                var splitLicense = licenseNo.split(" ");
                insertNotSaleNumber(splitLicense[1], province);
                return false;
            } else {
                myform.submit();
            }
        } else {
            var license = licenseNo.split(" ");
            first = /^\D+$/.test(license[0]);
            last = /^\d+$/.test(license[1]);

            if (first && last) {
                if (originKind == null || originKind == "") {
                    alert('Vehicle Kind should not be blank.');
                } else if (v_type == null || v_type == "") {
                    alert('Vehicle Type Group should not be blank.');
                } else if (province == null || province == "") {
                    alert('Province should not be blank.');
                } else if (appForm == null || appForm == "") {
                    alert('Application should not be blank.');
                } else if (response.status == "used") {
                    alert(response.message);
                    return false;
                } else if (response.status == "not_exist") {
                    alert(response.message);
                    return false;
                } else if (lastTwoNo == 27 || lastTwoNo == 67) {
                    alert('Number that ending with "27" and "67" not allow to book.');
                    var splitLicense = licenseNo.split(" ");
                    insertNotSaleNumber(splitLicense[1], province);
                    return false;
                } else {
                    myform.submit();
                }

            } else {
                alert('ຮູບແບບເລກທະບຽນຄວນເປັນ ກກ 2345');
                return false;
            }
        }
    });
}

function insertNotSaleNumber(licNo, province_code) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: '/save-license-not-sale',
        data: { province_code: province_code, licNo: licNo },
        dataType: 'json',
        success: function (data) {

        }
    });
}

function checkLicFormat(lic_no) {
    var license = lic_no.split(" ");
    first = /^\D+$/.test(license[0]);
    last = /^\d+$/.test(license[1]);
    if (first && last) {
        return true;
    }
    return false;
}
