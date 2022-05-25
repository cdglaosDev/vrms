<!DOCTYPE html>
<html>
<head>
	<title>lodding Button</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container main-section">
	<div class="row">

		<div class="col-lg-12 col-md-12 col-12 text-center">
      <input type="text" name="" id="licence" placeholder="Enter Licence No">
      <button id="call" class="btn btn-primary">Call</button>
      <button class="btn btn-primary" type="button" id="calling" style="display: none;">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Calling...
      </button>
      <button class="btn btn-primary" type="button" id="process" style="display: none;">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Processing...
      </button>
      <button class="btn btn-primary" type="button" id="done" style="display: none;">
        
        Done
      </button>
     
    </div>
	</div>
</div>
<script>
  $('#call').on('click',function(){
  var $btn = $(this);
  var calling = $("#calling");
  var process = $("#process");
  var done = $("#done");
  $btn.hide();
  calling.show();
    calling.on('click',function(){
    $("#licence").prop("disabled", true);
    calling.hide();
    process.show();
    });
    process.on('click',function(){
    process.hide();
    done.show();
    });
   done.on('click',function(){
     location.reload();
   }) ;
});

</script>
</body>
</html>	