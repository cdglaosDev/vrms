<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background:#fff url(http://vdvclao.org/thongpong/resources/bg-logo-4.jpg) top left repeat fixed;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
    <title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="stylesheet" href="{{ asset('/vrms2/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/vrms2/css/custom.css') }}" />
	<link rel="stylesheet" href="{{ asset('/vrms2/css/style.css') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	
   
    <!-- Fonts -->  
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin-left: auto;
            margin-right: auto;
            width: 932px;
            border-left: #bbb solid 1px;
            border-right: #bbb solid 1px;
            min-height: 1000px;
            background: #eee;
            box-shadow: 0px 0px 5px rgb(0 0 0 / 20%);
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="row" style="margin:0px 39px;height:91px">
            <div style="width: 223px">
                <img src="{{ asset('vrms2/css/resources/laos1.png') }}" style="margin-top:9px;margin-right:50px">
            </div>
            <div style="width: 516px">
                <center>
                        <div class="f13">ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ<br>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນະຖາວອນ</div>
                        <!--div class='f16'><B>ກະຊວງໂຍທາທິການ ແລະ ຂົນສົ່ງ</B></div>
                        <div class='f14'><B>ພະແນກ ໂຍທາທິການ ແລະ ຂົນສົ່ງ</B></div-->
                        <div class="f32" style="background-color:#ED1C24;padding:5px 8px 0px 8px;color:yellow;border-top-left-radius:4px;border-top-right-radius:4px; height: 51px;">ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່.ນວ </div>

                </center>
            </div>
            <div style="width: 112px">
                <img src="{{ asset('vrms2/css/resources/logo.png') }}" style="margin-left:50px;width:60px">
            </div>
        </div>
        <div class="row m-0" style="background-color: #ee0 !important;height:33px">
        <div id="main-menu" style="border-top:none;border-bottom:none">
			<a href="/"><font class="f20">ໜ້າຫຼັກ</font><br></a>
			<a href="/"><font class="f20">ການບໍລິການ</font><br></a>
			
			<!--a href='https://goo.gl/forms/7zS0M52scWdt1C4S2'><font  class='f20'>ເສັງຂັບຂີ່ອອນໄລນ໌</font><br></a-->
			<!--a href='http://vdvclao.org/thongpong/test_online'><font class='f20'>ຂໍ້ສອບອອນໄລນ໌</font><br></a-->
			<!--a href='http://admin.vdvclao.org'><font class='f20'>ການຈັດຕັ້ງບໍລິຫານ</font><br></a-->
			<!--a href='http://vdvclao.org/thongpong/contact'><font class='f20'>ຕິດຕໍ່</font><br></a-->
			<a href="http://blog.bm/online-submission"><font class="f20">ສົ່ງຂໍ້ມູນລົດ</font><br></a>
			<a href="http://blog.bm/drivingonline-submission"><font class="f20">ຂັບຂີ່</font><br></a>
			<!--a href='https://www.office.com/'><font class='f20'  >excel online</font><br></a-->
			<!--aa href='https://goo.gl/forms/3PjXeL8q2ITzVcvV2'><font class='f20'  >ລົງທະບຽນຕໍ່ໃບຂັບຂີ່ອອນໄລນ໌</font><br></a-->
			<!--a href='https://goo.gl/forms/ElGLazAabLOxUDrp2'><font class='f20'  >ສຳຫຼັບພະນັກງານ</font><br></a-->
			<a href="/"><font class="f20">ການເງິນ</font><br></a>
			<a href="/"><font class="f20">ຈັດຕັ້ງ-ບໍລິຫານ</font><br>
			</a><a href="http://api.whatsapp.com/send?phone=8562028245580&amp;text=ຜູ້ສົ່ງກະລຸນາແນະນຳໂຕເອງ ຈາກພາກສ່ວນໃດ%20ຈິ່ງຊິຕອບ"><font class="f20">ຕິດຕໍ່</font><br></a>
			
			<!--a href='https://www.vdvclao.org:8446/thongpong/'><font class='f20'  >DOT</font><br></a-->
		</div>
    </div>
    <div class="row">
        <div style="width: 23%">
            <form action="{{ route('user-login') }}" id="loginForm" method="POST">
				@csrf
                <div class="box1 w150" style="border:none;text-align:left;overflow-x:hidden;margin-top:27px;margin-left:27px">	<div id="login-box0" class="tl login-tool form-table login_tool_set" success="home">
                <b>LoginId:</b><input type="text" class="login-username" id="login-username" name="login_id"><br>
                <b>Password:</b><input type="password" class="login-password" name="password"><br>
                <b></b><input type="submit" class="login-submit button" value="Sign In"><br>
                
                </div>
            </form>
        </div>
    </div>

    <div style="width: 77%">
        <div id="banner">
            
        </div>
    </div>
    </div>
    <div class="row m-0" style="padding-top: 25px;">
    <div formid="10" formforce="forms/news-small-form" src="notes/j/type=news,sort=-modify_date,result_limit=20" pid="2" class="nvt-plugin nvt-form-new" plugin="Form" updatecallback="$.nvtForm" liveupdate="1"><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="1dq02jfvaiyxr" note="2039NOYYXR1" notecollection="notes" f="1">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=2039NOYYXR1" style="color:#fff;font-size:16px;text-decoration:none;">ໂຄວິດ-19 ສີດຢາຂ້າເຊື້ອ ໄວລັດ COVID-19</a><br>
	<small style="font-size:11px;color:#fff">2020-03-27T11:26:23Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="90727812_2495164450589470_4132540033821310976_o.jpg" src="http://vdvclao.org/thongpong/notes/2039NOYYXR1/photo/mediums/90727812_2495164450589470_4132540033821310976_o.jpg">
	<div style="padding:10px">
	ເພື່ອປ້ອງກັນການແພ່ລະບາດຂອງໄວລັດອັກເສບປອດສາຍພັນໃຫມ່ ຫລື ໂຄວິດ-19. ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ ໄດ້ເພີ້ມມາດຕະການສະກັດກັ້ນດ້ວຍການສີດຢາຂ້າເຊື້ອທຸກໆສະຖານທີ່ເຮັດວຽກ ເປັນປະຈຳທຸກວັນເພື່ອເພີ້ມມາດຕະການຮັກສາຄວາມປອດໄພໃຫ້ຜູ້ມາຊົມໃຊ້ບໍລິການໄດ້ອຸ່ນໃຈ
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=2039NOYYXR1" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="1dq02jfvaiyxr" note="2036NDYYXR3" notecollection="notes" f="2">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=2036NDYYXR3" style="color:#fff;font-size:16px;text-decoration:none;">ຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່ ນະຄອນຫລວງ ນຳພາພະນັກງານຄຸ້ມເຂັ້ມ ປ້ອງກັນ COVID-19</a><br>
	<small style="font-size:11px;color:#fff">2020-03-24T11:14:57Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="bbp.jpg" src="http://vdvclao.org/thongpong/notes/2036NDYYXR3/photo/mediums/bbp.jpg">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=2036NDYYXR3" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="1dq02jfvaiyxr" note="2036KoDYXR1" notecollection="notes" f="3">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=2036KoDYXR1" style="color:#fff;font-size:16px;text-decoration:none;">ໃຕ້ການນໍາພາຂອງພັກ</a><br>
	<small style="font-size:11px;color:#fff">2020-03-24T08:53:09Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="bp.jpg" src="http://vdvclao.org/thongpong/notes/2036KoDYXR1/photo/mediums/bp.jpg">
	<div style="padding:10px">
	ໜ່ວຍພັກກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ ນະຄອນຫຼວງວຽງຈັນ (ນວ) ເປັນໜ່ວຍພັກໜຶ່ງທີ່ຂຶ້ນກັບຄະນະພັກຮາກຖານ ພະແນກໂຍທາທິການ ແລະ ຂົນສົ່ງ ນວ, ມີພາລະບົດບາດ ໜ້າທີ່ ເປັນເສນາທິການໃຫ້ຄະນະພັກຮາກຖານພະແນກໂຍທາທິການ ແລະ ຂົນສົ່ງ ໃນການຄົ້ນຄ້ວາວ່າງແຜນຄຸ້ມຄອງ ແລະ ຈັດຕັ້ງຊີ້ນໍາ-ນໍາພາ ສຶກສາອົບຮົມການເມືອງແນວຄິດໃຫ້ພະນັກງານ ສະມາຊິ...
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=2036KoDYXR1" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="175EMrNc291" notecollection="notes" f="4">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=175EMrNc291" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2017-06-01T10:53:05Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_7665[1].JPG" src="http://vdvclao.org/thongpong/notes/175EMrNc291/photo/mediums/IMG_7665[1].JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=175EMrNc291" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="175EMZac294" notecollection="notes" f="5">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=175EMZac294" style="color:#fff;font-size:16px;text-decoration:none;">ກອງຄຸ້ມຄອງພາຫະນະ ແລະ ການຂັບຂີ່ນະຄອນຫລວງ ຈັດກິດຈະກຳອອກແຮງງານລວມຕ້ອນຮັບວັນເດັກ-ວັນປູກຕົ້ນໄມ້ແຫ່ງຊາດ</a><br>
	<small style="font-size:11px;color:#fff">2017-06-01T10:47:56Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_7673[1].JPG" src="http://vdvclao.org/thongpong/notes/175EMZac294/photo/mediums/IMG_7673[1].JPG">
	<div style="padding:10px">
	- ຕອນບ່າຍຂອງວັນທີ31/05/2017ກອງຄຸ້ມຄອງຮ່ວມກັບພາກສ່ວນທີ່ກ່ຽວຂ້ອງໃນຂອບເຂດຂອງກອງໄດ້ຈັດກິດຈະກຳອອກແຮງງານລວມເຮັດອານາໄມຫ້ອງການລວມທັງຕະຄອງຮ່ອງນ້ຳເປື້ອນຢາງເປັນຂະບວນຟົດຟື້ນ. ສວ່ນລາຍລະອຽດຕິດຕາມນຳໜ້າໜັງສືພີມຕ່າງໆ
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=175EMZac294" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="1739NS7c293" notecollection="notes" f="6">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=1739NS7c293" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2017-03-27T11:28:56Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_6281[1].JPG" src="http://vdvclao.org/thongpong/notes/1739NS7c293/photo/mediums/IMG_6281[1].JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=1739NS7c293" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="1739NI0c291" notecollection="notes" f="7">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=1739NI0c291" style="color:#fff;font-size:16px;text-decoration:none;">ກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີນະຄອນຫລວງຈັດກອງປະຊຸມລະນຶກວັນຜູ້ເສຍອົງຄະ</a><br>
	<small style="font-size:11px;color:#fff">2017-03-27T11:25:45Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_6283[1].JPG" src="http://vdvclao.org/thongpong/notes/1739NI0c291/photo/mediums/IMG_6283[1].JPG">
	<div style="padding:10px">
	- ຕອນບ່າຍວັນທີ23/03/2017ຫອ້ງສະໂມສອນໃຫຍ່ຂອງກອງໄດ້ຈັດພິທີລະນຶກວັນຜູ້ເສຍອົງຄະຂື້ນຢ່າງເປັນທາງການໂດຍ ທ່ານ ນວນໄຊພະໄຊສົມບັດ ເລຂາພັກຮາກຖານຂອງກອງຄູ້ມຄອງພາຫະນະແລະການຂັບຂັບຂີນະຄອນຫລວງວຽງຈັນທັງເປັນຫົວໜ້າກອງໃຫ້ກຽດເປັນປະທານເລົ່າຄືນມູນເຊື້ອອັນພິລະອາດຫານຂອງນັກຮົບທີເສຍສະລະເລື້ອດເນື້ອເພື່ອປະເທດຊາດແລະມີບັນດາອ້າຍນ້ອງພະ...
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=1739NI0c291" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16BPKtsc291" notecollection="notes" f="8">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BPKtsc291" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2016-12-13T09:03:02Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0168.JPG" src="http://vdvclao.org/thongpong/notes/16BPKtsc291/photo/mediums/IMG_0168.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BPKtsc291" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16BM387c291" notecollection="notes" f="9">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BM387c291" style="color:#fff;font-size:16px;text-decoration:none;">ທ່ານ ຮອງລັດຖະມົນຕີ ກະຊວງ ຍທຂ ພ້ອມດ້ວຍຄະນະ ລົງຢຽ້ມຢາມກອງຄຸ້ມຄອງພາຫະນະນະຄອນຫລວງ</a><br>
	<small style="font-size:11px;color:#fff">2016-12-09T15:13:27Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0177.JPG" src="http://vdvclao.org/thongpong/notes/16BM387c291/photo/mediums/IMG_0177.JPG">
	<div style="padding:10px">
	- ຕອນເຊົ້າວັນທີ09/12/2016 ທ່ານ ຮອງລັດຖະມົນຕີ ກະຊວງ ໂຍທາທິການ ແລະ ຂົນສົ່ງພ້ອມດ້ວຍຄະນະ ນຳໂດຍທ່ານ ວຽງສະຫວັດ ສີພັນດອນ ລົງຢຽ້ມຢາມກອງຄຸ້ມຄອງພາຫະນະແລະການຂັບຂີ່ນະຄອນຫລວງ.ເປັນກຽດຕ້ອນຮັບຂື້ນກ່າວບົດສະຫລຸບລາຍງານສະພາບລວມແລະທິດທາງຕໍ່ໜ້າໂດຍ ທ່ານ ນວນໄຊ ພະໄຊສົມບັດ ຄະນະພັກຮາກຖານ, ທັງເປັນຫົວໜ້າກອງຄຸ້ມຄອງພາຫະນະແລະ ການຂ...
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BM387c291" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16BM3FJc294" notecollection="notes" f="10">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BM3FJc294" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2016-12-09T15:15:54Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0085.JPG" src="http://vdvclao.org/thongpong/notes/16BM3FJc294/photo/mediums/IMG_0085.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16BM3FJc294" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16AUKOfc293" notecollection="notes" f="11">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16AUKOfc293" style="color:#fff;font-size:16px;text-decoration:none;">ທີມງານຝຶກອົບຮົມວຽກງານການຂັບຂີ່(ທີ່ວັງວຽງ)</a><br>
	<small style="font-size:11px;color:#fff">2016-11-17T08:35:51Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="DSC04009.JPG" src="http://vdvclao.org/thongpong/notes/16AUKOfc293/photo/mediums/DSC04009.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16AUKOfc293" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="168OAvoc294" notecollection="notes" f="12">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=168OAvoc294" style="color:#fff;font-size:16px;text-decoration:none;">ພີມຍີງ</a><br>
	<small style="font-size:11px;color:#fff">2016-09-10T23:00:12Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0684.JPG" src="http://vdvclao.org/thongpong/notes/168OAvoc294/photo/mediums/IMG_0684.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=168OAvoc294" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="168OAtTc292" notecollection="notes" f="13">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=168OAtTc292" style="color:#fff;font-size:16px;text-decoration:none;">ປະມວນພາບ</a><br>
	<small style="font-size:11px;color:#fff">2016-09-10T22:56:38Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0033.JPG" src="http://vdvclao.org/thongpong/notes/168OAtTc292/photo/mediums/IMG_0033.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=168OAtTc292" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16872b0c293" notecollection="notes" f="14">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16872b0c293" style="color:#fff;font-size:16px;text-decoration:none;">ໍລິສັດລາວ ໂຕໂຍຕາມອບຊຸດເຄື່ອງນຸງສູນກວດກາເຕັກນິກ ໃຫ້ກອງຄຸ້ມຄອງ 24/08/2016</a><br>
	<small style="font-size:11px;color:#fff">2016-08-24T14:38:54Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0004.JPG" src="http://vdvclao.org/thongpong/notes/16872b0c293/photo/mediums/IMG_0004.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16872b0c293" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="16872eCc295" notecollection="notes" f="15">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=16872eCc295" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2016-08-24T14:39:43Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0006.JPG" src="http://vdvclao.org/thongpong/notes/16872eCc295/photo/mediums/IMG_0006.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=16872eCc295" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="167A1Ync295" notecollection="notes" f="16">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=167A1Ync295" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2016-07-27T13:37:38Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_1741.JPG" src="http://vdvclao.org/thongpong/notes/167A1Ync295/photo/mediums/IMG_1741.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=167A1Ync295" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="167A1VTc292" notecollection="notes" f="17">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=167A1VTc292" style="color:#fff;font-size:16px;text-decoration:none;">ປະມວນຮູບພາບ</a><br>
	<small style="font-size:11px;color:#fff">2016-07-27T13:34:12Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="20150509_090719.jpg" src="http://vdvclao.org/thongpong/notes/167A1VTc292/photo/mediums/20150509_090719.jpg">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=167A1VTc292" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="1679LZAc2910" notecollection="notes" f="18">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LZAc2910" style="color:#fff;font-size:16px;text-decoration:none;">ປະມວນພາບ</a><br>
	<small style="font-size:11px;color:#fff">2016-07-27T09:35:54Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0064.JPG" src="http://vdvclao.org/thongpong/notes/1679LZAc2910/photo/mediums/IMG_0064.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LZAc2910" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="1679LX2c298" notecollection="notes" f="19">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LX2c298" style="color:#fff;font-size:16px;text-decoration:none;">ປະມວນພາບ</a><br>
	<small style="font-size:11px;color:#fff">2016-07-27T09:33:19Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0003.JPG" src="http://vdvclao.org/thongpong/notes/1679LX2c298/photo/mediums/IMG_0003.JPG">
	<div style="padding:10px">
	ປະມວນພາບ
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LX2c298" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div><div class="news-small f14" style="width:302px;min-height:250px;word-wrap:break-word;padding:0;display:inline-block;vertical-align:top;margin:6px 0px;margin-left:6px;background:#fff;box-shadow:0px 3px 6px rgba(0,0,0,0.3)" owner="129M32W0" note="1679LU3c295" notecollection="notes" f="20">
    <div style="padding:10px;min-height:70px;background:#666">
	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LU3c295" style="color:#fff;font-size:16px;text-decoration:none;"></a><br>
	<small style="font-size:11px;color:#fff">2016-07-27T09:31:25Z</small><br>
	</div>
	
	
	<img style="margin:10px 0px;width:302px" picname="IMG_0057.JPG" src="http://vdvclao.org/thongpong/notes/1679LU3c295/photo/mediums/IMG_0057.JPG">
	<div style="padding:10px">
	
	<br>
	<div style="text-align:right">
    	<a href="http://vdvclao.org/thongpong/news-page/note_id=1679LU3c295" class="link">ອ່ານຕໍ່</a>
	</div>
	</div>
</div></div>
    </div>
   
    </div>
<script src="{{ asset('vrms2/js/jquery.min.js')}}"></script>
<script>

</script>
</body>
</html>
