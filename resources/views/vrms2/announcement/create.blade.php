@extends('vrms2.layouts.master')
@section('anno_page','active')
@section('content')
@php
$provinces = \App\Model\Province::whereStatus(1)->pluck('province_code', 'name');
@endphp
<h3><b>{{ trans('title.add_announce') }}</b></h3>
<div class="card-body w3-card-4">
   <form class="w3-container" id="myForm" method="post" action="{{ route('announcement.store') }}" enctype="multipart/form-data" onsubmit= "return myFunction(this.form)">
      @csrf
      <table bgcolor="#FFFFFF" style="width:70%" border="0" cellpadding="3" cellspacing="2">
         <tbody>
            <tr>
               <td width="10%"><label><b>{{ trans('title.text_subject') }}</b></label></td>
               <td>
                  <input class="w3-input w3-border subject"  type="text" name="text_subject" required  placeholder="Enter Text Subject" style="width:80%">
               </td>
            </tr>
            <tr>
               <td><label><b>{{ trans('title.text_subtitle') }}</b></label></td>
               <td>
                  <textarea name="text_subtitle"  rows="10"  required  class="w3-input w3-border subtitle" placeholder="Enter Text Subtitle" style="width:80%;height:45px;"></textarea>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                  <table style="width:100%">
                     <tbody>
                        <tr class="tblSubHead">
                           <td width="15%"><b>{{ trans('title.upload_file') }}</b></td>
                           <td valign="top"><a onclick="add_file();" title="Add more"><img src="{{ asset('vrms2/css/resources/add.png') }}" border="0"></a></td>
                        </tr>
                        <tr class="txt">
                           <td valign="top"><input type="file" name="file[]" id="myFile[1]" OnChange="chkFileSize('1');"></td>
                           <td valign="top"><label>{{ trans('title.config_image') }}:</label>
                              <input type="radio" name="size_img[1]" id="max[1]" value='1'><label>100%</label>
                              <input type="radio" name="size_img[1]" id="ori[1]" value='0'><label>{{ trans('title.original') }}</label>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <table style="width:100%" border="0" id="file_div">	
                    <!-- <div > </div> -->
                  </table>
               </td>
            </tr>
            <tr>
               <td align="left" colspan="2"> <label for="pin"><b>{{ trans('title.province_search') }}</b></label> </td>
            </tr>
            <tr>
               <td colspan="2" width="90%" >
                  @foreach($provinces as $key=>$value)
                  <div class="form-check form-check-inline">
                     @if(auth()->user()->user_level =="admin")
                        <input class="form-check-input province" type="checkbox" name="province_code[]" value="{{$value}}">
                        <label class="form-check-label" for="defaultCheck1">
                        {{ $key }}
                        </label>
                     @else
                        @if(auth()->user()->user_info->province_code == $value)
                           <input class="form-check-input province" type="checkbox" name="province_code[]" value="{{$value}}">
                           <label class="form-check-label" for="defaultCheck1">
                           {{ $key }}
                           </label>
                        @endif
                     @endif
                  </div>
                  @endforeach      
               </td>
               <td width="10%">&nbsp;</td>
            </tr>
            <tr>
               @if(auth()->user()->user_level == "admin")
               <td align="left" colspan="2">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="checkbox" name="province_code[]" value="" onclick="javascript:checkAll(this,'province')")>
                     <label class="form-check-label" for="defaultCheck1">
                     {{ trans('title.all_province') }}
                     </label>
                  </div>
               </td>
               @endif
            </tr>
            <tr>
               <td vertical-align="middle"><a href="{{ url('/announcement') }}" style="text-decoration:underline">?????? {{ trans('title.go_back') }}</a></td>
               <td align="left" colspan="2">
                  <p><button class="w3-btn w3-green btn btn-success anno-save" >{{ trans('button.submit') }}</button></p>
               </td>
            </tr>
         </tbody>
      </table>
   </form>
</div>
@endsection
@push('page_scripts')
<script>
   $(".anno-save").on('click',function(){
   
      if($('.subtitle').val().trim() == '' || $('.subject').val().trim() == ''){
         alert('Need to fill both subject and text subtitle');
         return false;
         
      }
   });
   function checkAll(o, type) {
   var boxes = document.getElementsByClassName(type);
      for (var x = 0; x < boxes.length; x++) {
      var obj = boxes[x];
         if (obj.type == "checkbox") {
         if (obj.name != "check")
            obj.checked = o.checked;
         }
      }
   }
   var clicks = 1; 
  document.getElementById('max[1]').checked = true;
   function add_file()
   {
         clicks += 1;
         $("#file_div").append("<tr id='dele'><td width='15%'><input type='file' name='file[]' id='myFile["+clicks+"]' OnChange='chkFileSize("+clicks+");'></td> <td valign='top'><a type='button' value='REMOVE' onclick=remove_file(this);><img src='/vrms2/css/resources/minus.png' border='0'></a> <label>{{ trans('title.config_image') }}: </label><input type='radio' id='max["+clicks+"]' name='size_img["+clicks+"]' value='1'><label>100%</label> <input type='radio' id='ori["+clicks+"]' name='size_img["+clicks+"]' value='0'><label>{{ trans('title.original') }}</label> </td></tr>");
         document.getElementById('max['+clicks+']').checked = true;
   }

   function remove_file(ele){
      var myobj = document.getElementById("dele");
      myobj.remove();
   }

   function chkFileSize(clicks){ //Check file size
      var size = document.getElementById('myFile['+clicks+']').files[0].size;
      if(size > 2000000){ //2GB.
         alert('Sorry, your file is too large.');
         window.location.reload();
      }
   }

   function myFunction(){
   
   var checkedCount = $('.province').filter(':checked').length
      if(checkedCount > 0){
         return true;
      }else{
         alert("Please checke at least one at Province!!!");
         return false;
      }
      var arrInputs = myForm.getElementsByTagName("input");
     
      for (var i = 0; i < arrInputs.length; i++) {
          var oInput = arrInputs[i];
          if (oInput.type == "file") {
              var sFileName = oInput.value;
              if (sFileName.length < 0) {
               alert('Please browse/choose at least one file');
			      return false;
              }
          }
      }
		
   }
   
</script>
@endpush