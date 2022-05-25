//add new user form
$(".save-user").click( function (e) {
   e.preventDefault();
  
   if ($('#staff-user .first_name').val().trim() == '') {
      alert('First Name required.');
      return false;
   } else if ($('#staff-user .last_name').val().trim() == '') {
      alert('Last Name required.');
      return false;
   }  else if ($('#staff-user .user-level').val() == null ) {
      alert('User Level required.');
      return false;
   } else if ($('#staff-user .user-status').val() == null ) {
      alert('User Status is required.');
      return false;
   } else if ($('#staff-user .user-group').val() == null ) {
      alert('User Group required.');
      return false;
   } else if ($('#staff-user .birthdate').val() == '') {
      alert('Birthdate required.');
      return false;
   } else if ($('#staff-user .phone').val().trim() == '') {
      alert('Phone required.');
      return false;
   } else if ($('#staff-user .position').val().trim() == '') {
      alert('Position required.');
      return false;
   } else if ($('#staff-user .department').val() == null) {
      alert('Department required.');
      return false;
   }else if ($('#staff-user .province_code').val() == null ) {
      alert('Province required.');
      return false;
   } else if ($('#staff-user #multipleRole').val().length == 0 ) {
      alert('Role required.');
      return false;
   } else if ($('#staff-user .customer-status').val() == null) {
      alert('Customer status required.');
      return false;
   } else if ($('#staff-user .gender').val() == null) {
      alert('Gender required.');
      return false;
   } else if ($('#staff-user .login_id').val().trim() == '') {
      alert('Login Id required.');
      return false;
   } else if ($('#staff-user .password').val().trim() == '' ) {
      alert('Password required.');
      return false;
   } else if ($('#staff-user .password-confirm').val().trim() == '' ) {
      alert('Password Confirm required.');
      return false;
   } else if ($('#staff-user .address').val().trim() == '' ) {
      alert('Address required.');
      return false;
   }else if ($('#staff-user .password').val().length < 6 ) {
      alert('Password have minimun 6.');
      return false;
   }  else {
      if(email.includes($("#staff-user .email").val())){
         alert('Email already taken.'); 
         return false;
      } else if(loginId.includes($("#staff-user .login_id").val())){
         alert('login id already taken.'); 
         return false;
      } else if ($('#staff-user .password').val() != $('#staff-user .password-confirm').val()) {
         alert('Password and password confirmation does not match');  
         return false;
      } else {
         $("#staff-user").submit();
      }
   }
  
 });
$("#edit-image, #new-image").change(function(e){
   e.preventDefault();
   var ext = $(this).val().split('.').pop().toLowerCase();
   var imageExt = ["png", "jpg", "jpeg"];
   if(imageExt.indexOf(ext) == -1)  
   {   
      alert("ກະລຸນາເລືອກຮູບພາບໃຫ້ຖືກຂະໜາດ");
      $(this).val('');
      return false;  
   }   
  
})
 //add new user form
$(".edit-user").click( function (e) {
   e.preventDefault();
   var result = loginId.filter(function(elem){
      return elem != $("#edit-staff-user #old-loginId").val(); 
   });
 
   var result1 = email.filter(function(elem){
      return elem != $("#edit-staff-user .old-email").val(); 
   });

   if ($('#edit-staff-user .first_name').val().trim() == '') {
      alert('First Name required.');
      return false;
   } else if ($('#edit-staff-user .last_name').val().trim() == '') {
      alert('Last Name required.');
      return false;
   }  else if ($('#edit-staff-user .user-level').val() == null ) {
      alert('User Level required.');
      return false;
   } else if ($('#edit-staff-user .user-status').val() == null ) {
      alert('User Status is required.');
      return false;
   } else if ($('#edit-staff-user .user-group').val() == null ) {
      alert('User Group required.');
      return false;
   } else if ($('#edit-staff-user .birthdate').val() == '') {
      alert('Birthdate required.');
      return false;
   } else if ($('#edit-staff-user .phone').val().trim() == '') {
      alert('Phone required.');
      return false;
   } else if ($('#edit-staff-user .position').val().trim() == '') {
      alert('Position required.');
      return false;
   } else if ($('#edit-staff-user .department').val() == null) {
      alert('Department required.');
      return false;
   }else if ($('#edit-staff-user .province_code').val() == null ) {
      alert('Province required.');
      return false;
   } else if ($('#edit-staff-user .multiselect').val().length == 0 ) {
      alert('Role required.');
      return false;
   } else if ($('#edit-staff-user .customer-status').val() == null) {
      alert('Customer status required.');
      return false;
   } else if ($('#edit-staff-user .gender').val() == null) {
      alert('Gender required.');
      return false;
   } else if ($('#edit-staff-user .login_id').val().trim() == '') {
      alert('Login Id required.');
      return false;
   }  else if ($('#edit-staff-user .address').val().trim() == '' ) {
      alert('Address required.');
      return false;
   }  else {
      if(result1.includes($("#edit-staff-user .email").val())){
         alert('Email already taken.'); 
         return false;
      } else if(result.includes($("#edit-staff-user .login_id").val())){
         alert('login id already taken.'); 
         return false;
      } else if ($('#edit-staff-user .password').val() != $('#edit-staff-user .password-confirm').val()) {
         alert('Password and password confirmation does not match');  
         return false;
      } else {
         $("#edit-staff-user").submit();
      }
   }
  
 });