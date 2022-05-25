@extends('layouts.master')
@section('user','active')
@section('content')

    <div class="card">
   
      <div class="card-body">
     <h4 class="bold">Adde 5000 record per one times.</h4>
     <form method='post' action="{{route('save.vehicleId')}}"  >
      {{ csrf_field() }}
      @if(Session::has('success'))
        <p class="alert alert-info">{{ Session::get('success') }}. You can start this vehicle ID {{ session()->get('start_no') + 1 }} next time.</p>
      @endif
     
       <input type="number" name="start" id="start" placeholder="Enter Start Vehicle Id" value="">
       <input type="number" name="end" id="end" placeholder="Enter End Vehicle Id" readonly>
       <input type='submit' name='submit' value='Add' class="btn btn-primary">
     </form>
      </div>
    </div>
@endsection
@push("page_scripts")
  <script>
 $("#start").keypress(function(){
   var end_value =$(this).val();
   var sum_value = 9;
  $("#end").val(end_value + sum_value);
 
});
  </script>
@endpush


