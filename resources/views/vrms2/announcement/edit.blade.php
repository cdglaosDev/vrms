@extends('vrms2.layouts.master')
@section('anno_page','active')
@section('content')
@php
$provinces = \App\Model\Province::whereStatus(1)->pluck('province_code', 'name');
@endphp
<h3><b>{{ trans('title.edit_announce') }}</b></h3>
<div class="card-body w3-card-4">
   <form class="w3-container" method="post" action="{{ route('announcement.update', $announcement->id) }}" enctype="multipart/form-data" onsubmit= "return myFunction(this.form)">
      @csrf
      @method("PATCH")
      <table bgcolor="#FFFFFF" style="width:70%" border="0" cellpadding="3" cellspacing="2">
         <tbody>
            <tr>
               <td width="10%"><label><b>{{ trans('title.text_subject') }}</b></label></td>
               <td>
                  <input class="w3-input w3-border" value="{{ $announcement->text_subject }}" required pattern=".*\S+.*" type="text" name="text_subject" placeholder="Enter Text Subject" style="width:80%">
               </td>
            </tr>
            <tr>
               <td><label><b>{{ trans('title.text_subtitle') }}</b></label></td>
               <td>
                  <textarea name="text_subtitle"  rows="10" required  class="w3-input w3-border subtitle" placeholder="Enter Text Subtitle" style="width:80%;height:45px;">{{ $announcement->text_subtitle }}</textarea>
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
                           <td valign="top" colspan="2">
                              <div id="class">
                                 @if($anno_files)
                                    @foreach($anno_files as $index=>$anno_file)
                                       @if($anno_file->file_name)
                                         <div id="dele{{$anno_file->id}}">
                                             <input type="hidden" name="anno_file_id[]" value="{{$anno_file->id}}">
                                             <img src="{{ asset('/vrms2/anno/'.$anno_file->file_name) }}" alt="" id="img{{$anno_file->id}}" width="50" height="50" >
                                              <a type='button' value='REMOVE' onclick="remove_file1({{$anno_file->id}})"><img  src="{{ asset('vrms2/css/resources/minus.png') }}" border="0"></a><br/>
                                             <label>{{ trans('title.config_image') }}:</label>
                                             <input type="radio" name="size_img[{{ $index+1 }}]" id="max[{{ $index+1 }}]" value="1" {{ $anno_file->file_size == 1?'checked':''}}><label>100%</label>
                                             <input type="radio" name="size_img[{{ $index+1 }}]" id="max[{{ $index+1 }}]" value="0" {{ $anno_file->file_size == 0?'checked':''}}><label>{{ trans('title.original') }}</label>
                                             <input type="hidden" name="exist_id"  value="{{ $anno_file->id }}">
                                          </div> 
                                       @endif
                                      
                                    @endforeach
                                 @else
                                    <input type="file" name="file[]" id="myFile[1]" OnChange="chkFileSize('1');">
                                    <label>:</label>
                                    <input type="radio" name="size_img[1]" id="max[1]" value='1'><label>100%</label>
                                    <input type="radio" name="size_img[1]" id="ori[1]" value='0'><label>{{ trans('title.original') }}</label>
                                 @endif
                              </div>
                             
                           </td>
                        </tr>

                     </tbody>
                  </table>
                  <input type="hidden" name="num_row" id="num_row" value="0">
                  <input type="hidden" name="row_chk_img" id="row_chk_img" value="">
                  <table style="width:100%" border="0" id="file_div"></table>
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
                           <input class="form-check-input province" {{ in_array($value, $anno_province) ? "checked" : '' }}  type="checkbox" name="province_code[]" value="{{$value}}">
                           <label class="form-check-label" for="defaultCheck1">
                           {{ $key }}
                           </label>
                        @else 
                           @if(auth()->user()->user_info->province_code == $value)
                           <input class="form-check-input province" {{ in_array($value, $anno_province) ? "checked" : '' }}   type="checkbox" name="province_code[]" value="{{$value}}">
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
               <td vertical-align="middle"><a href="{{ url('/announcement') }}" style="text-decoration:underline">❮❮ {{ trans('title.go_back') }}</a></td>
               <td align="left" colspan="2">
                  <p><button class="w3-btn w3-green btn btn-success anno-save" >{{ trans('button.save') }}</button></p>
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
   
   if($('.subtitle').val().trim() == ''){
      alert('Need to fill text subtitle');
      $('.subtitle').focus();
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
 
  var num_row = parseInt(document.getElementById('num_row').value);
  if(num_row==0){ var clicks = 1; }else{ var clicks = parseInt(num_row); }
   
  function add_file(){
    
    clicks += 1;
    $("#file_div").append("<tr id='dele'><td width='15%'><input type='file' name='file[]' id='myFile["+clicks+"]' OnChange='chkFileSize("+clicks+");'></td> <td valign='top'><a type='button' value='REMOVE' onclick=remove_file(this);><img src='/vrms2/css/resources/minus.png' border='0'></a> <label>{{ trans('title.config_image') }}: </label><input type='radio' id='max["+clicks+"]' name='size_img["+clicks+"]' value='1'><label>100%</label> <input type='radio' id='ori["+clicks+"]' name='size_img["+clicks+"]' value='0'><label>{{ trans('title.original') }}</label> </td></tr>");
    document.getElementById('max['+clicks+']').checked = true;
    document.getElementById('num_row').value = clicks;

    var num_row = document.getElementById('num_row').value;
    var row_chk_img = document.getElementById('row_chk_img').value;

    // console.log('number_max==> '+clicks+' | num_row='+num_row+' | row_chk_img='+row_chk_img+'\n');
  }
   
  function remove_file(ele){
   
    clicks-=1;  
    document.getElementById('max['+clicks+']').value-=1;
    document.getElementById('ori['+clicks+']').value-=1;

    var myobj = document.getElementById("dele");
    myobj.remove();
  }
  // delete image existing file
  function remove_file1(ele){
   
    var myobj = document.getElementById("dele"+ ele);
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
   }
   
</script>
@endpush
