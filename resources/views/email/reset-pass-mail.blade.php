<html>
  <head></head>
  <body>
    <p> ສະບາຍດີ {{$user['name']}}
      </br> ພວກເຮົາໄດ້ຮັບການຮ້ອງຂໍ Reset Password ຂອງລະບົບຄຸ້ມຄອງຍານພາຫະນະ ທ່ານສາມາດ reset password ໄດ້ໂດຍ ຄຣິກທີ່ ລີ້ງດ້ານລຸ່ມນີ້: <br />
      <a href="{{url('/password-reset',$user['email'])}}">Reset Your Password here.</a>
      <br /> ເພື່ອຄວາມປອດໄພ ກາລຸນາປ່ຽນລະຫັດພາຍໃນ 24 ຊົ່ວໂມງ.
    </p>
    <p> ຂໍຂອບໃຈ <br /> VRMS </p>
  </body>
</html>