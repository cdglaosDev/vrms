@extends('vrms2.layouts.master')
@section('smart_card_setting','active')
@section('content')
@include('DisplaySetting.submenu')
<h3>{{trans('title.smartcard_code')}}</h3>
@include('flash')
<div class="card-body">
  <form class="updateCard" style="display:inline" action="{{ url('/smartcard-setting/'.$code->id) }}" method="POST">
    @csrf
    @method('POST')
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="row">
        <label class="control-label">Transport Key:</label>
        <input type="text" name="code" value="{{ $code->code }}" class="form-control smartcard-code" maxlength="5" required>
      </div><br>
      <div class="row">
        <label class="control-label">Security Pin:</label>
        <input type="text" name="security_pin" value="{{ $code->security_pin }}" class="form-control security-pin" maxlength="5" required>
      </div><br>
      <div class="row">
        <button class=" btn btn-success btn-sm">{{ trans('button.update')}}</button>
      </div>
    </div>
    </div>
  </form>
</div>
@endsection
@push('page_scripts')
<script type="text/javascript">
 
  $('.smartcard-code').keyup(function() {
    var code = $(this).val().split(" ").join("");
    if (code.length > 0) {
      code = code.match(new RegExp('.{1,2}', 'g')).join(" ");
    }
    $(this).val(code);
  });
  $('.security-pin').keyup(function() {
    var code = $(this).val().split(" ").join("");
    if (code.length > 0) {
      code = code.match(new RegExp('.{1,2}', 'g')).join(" ");
    }
    $(this).val(code);
  });
  $(".updateCard").on("submit", function() {
    if ($(".security-pin").val().length == 5 && $(".smartcard-code").val().length == 5) {
      return confirm("If you update the security code,it will effect the smart card system. Strongly suggest not to update it.Are you sure to  update it?");
    } else {
      alert('Your Security Pin and Transport Key does not correct.Both format should be like this FF FF.');
      return false;
    }
  });
</script>
@endpush