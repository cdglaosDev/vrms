$(document).ready(function(){
  
  $("#province").change(function(){
        var code = $(this).val();
        
         $.ajax({
                type:"GET",
                url:getCode+"/"+code,
                success:function(data){  
                  $("#pro_code").val(data.pro_code);
                   $("#book_code").val(data.code_no);
                  
                }
            });
        
 });
});


 
