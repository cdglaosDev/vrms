@extends('layouts.master')
@section('reg','active')
@section('title','Print')
@section('content')
	<div class="card">
    <input type="hidden" name="id" id="register_id" value="{{$reg_id}}">
    <div id="print" class="right">
    </div>
    <div class="no-print">
        <hr/>
        <div class="form-group">
          <label for="page" class="col-sm-1 control-label">Page :</label>
          <div class="col-xs-2">
            <select id="page" class="form-control">
                <option value="p1" selected="selected">Page 1</option>
                <option value="p2">Page 2</option>
                <option value="p3">Page 3</option>
                <option value="p4">Page 4</option>
            </select>
          </div>
        </div>

        <div class="form-group col-xs-2">
        <button class="form-control print-link no-print btn btn-primary" onclick="jQuery('#print').print()">Print</button>
        </div>
    </div>
</div>

  

@endsection
@push("page_scripts")
	<script src="js/bootstrap.min.js"></script>
    <script type='text/javascript'>

    $(document).ready(function(){
      //fetchData("p1");
      var page = $("#page").val();
    
      fetchData(page);
      });

        $("#page").on('change', function(e){
            e.preventDefault();
          var pg = $(this).val();
          fetchData(pg);
        });


        /*
        $("#h-align").on('change', function(e){
            var align = $(this).val();
            $("#print").attr("class", align);
        });
        */

function fetchData(page){

  var id = $("#register_id").val();
  var print = $("#print");
 
  $(print).css('background-image','url(../images/'+page+'.png)');
  if((page=="p1") || (page=="p3")){
    $("#print").attr("class", "right");
  }else{
    $("#print").attr("class", "left");
  }

$("#print").html('<img src="../images/'+page+'.png">');

  $.ajax({
      type: "GET",
        url:'/getPrint',
      data: {id:id,page:page},
      success: function(msg){
        //console.log(msg);
          if(msg != 0){
          print.html(msg);
          }
      }
  });

}

    </script>
    <script src="{{asset('js/jQuery.print.js')}}"></script>
@endpush

