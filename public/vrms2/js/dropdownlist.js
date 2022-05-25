 // get district by province  for new and edit form
$('#province, #edit-province').change(function() {
    var province_code = $(this).val(); 
    if (province_code) {
        $.ajax({
           type:"GET",
            url:dist_url+ "/"+province_code,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
           success:function(data) {
               //console.log(data); 
            if (data) {
                $("#district, #edit-district").empty();
                $("#district, #edit-district").append('<option value="" selected disabled hidden> Select</option>');
                $.each(data.district,function(key,value){
                    $("#district, #tenant-district, #edit-district, #edit-tenant-district").append('<option value="'+key+'">'+value+'</option>');
                });
                $("#province_abb, #edit_province_abb").text(data.province_abb);
            } else {
                $("#district, #edit-district").empty();
            }
           }
        });
    } else {
        $("#district, #edit-district").empty();
       
    }      
   });

   // get district by province  for tenant form
   $('#tenant-province, #edit-tenant-province').change(function() {
    var province_code = $(this).val(); 
   
    if (province_code) {
        $.ajax({
           type:"GET",
            url:dist_url+ "/"+province_code,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
           
           success:function(data) {  
            if (data) {
                $("#tenant-district, #edit-tenant-district").empty();
                $("#tenant-district, #edit-tenant-district").append('<option value="" selected disabled hidden> Select</option>');
                $.each(data.district,function(key,value){
                    $("#tenant-district, #edit-tenant-district").append('<option value="'+key+'">'+value+'</option>');
                });
          
            } else {
               $("#tenant-district, #edit-tenant-district").empty();
            }
           }
        });
    } else {
        $("#tenant-district, #edit-tenant-district").empty();
       
    }      
   });

   $('#vbrand, #edit-vbrand').change(function() {
    var brand = $(this).val(); 
    
    if (brand) {
        $.ajax({
           type:"GET",
            url:get_vmodal+ "/"+brand,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
           success:function(data){  
           
            if (data) {
                $("#vmodel, #edit-vmodel").empty();
                $("#vmodel, #edit-vmodel").append('<option value="" selected disabled hidden>Select</option>');
                $.each(data,function(key,value) {
                
                    $("#vmodel, #edit-vmodel").append('<option value="'+key+'">'+value+'</option>');
                });
           
            } else {
               $("#vmodel, #edit-vmodel").empty();
            }
           }
        });
    } else {
        $("#vmodel, #edit-vmodel").empty();
    }      
   });
   

 $('#pro').change(function(){
    var province_code = $(this).val(); 
   
    if (user_id) {
        $.ajax({
           type:"GET",
            url:user_url+ "/"+province_code,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            success:function(data){  
           
            if (data) {
                $("#user").empty();
                $("#user").append('<option>Select</option>');
                $.each(data,function(key,value){
                    $("#user").append('<option value="'+key+'">'+value+'</option>');
                });
           
            } else {
               $("#user").empty();
            }
           }
        });
    } else {
        $("#user").empty();
    }      
   });
