<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
        <form>
            <div id="app">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="app_number" value="" placeholder="Enter App Number" id="application_number" required></td>
                        <td><input type="button" class="btn btn-primary btn-sm save-data" id="Btn" value="Call" name="status"></td>
                        <td><input type="button" class="btn btn-danger btn-sm delete" value="Cancel"></td>
                        <td><input type="hidden" id="del_btn" value="" name="id"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </form>
</body>
</html>

@push('page_scripts')
 
<script type="text/javascript">

    $(document).ready(function() {
           
         if(sessionStorage.app_number){
            document.getElementById("application_number").value = sessionStorage.app_number;
            document.getElementById("Btn").value = sessionStorage.status;
            document.getElementById("del_btn").value = sessionStorage.id;
         }else{
            document.getElementById("Btn").value = "Call";
         }
        
    });


//Save and Update and Search data
    $(".save-data").click(function(event){
        event.preventDefault();
        document.getElementById("Btn").disabled = true;

        var status = $("input[name=status]").val();
        if(status == "Call"){
            var app_number = $("input[name=app_number]").val();
            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:'POST',
                url:'/display',
                data:{app_number:app_number,_token: _token},
                success:function(data){
                    var app_number = data['app_number'];
                    sessionStorage.setItem('app_number',data['app_number']);
                    sessionStorage.setItem('status',data['status']);
                    sessionStorage.setItem('id',data['id']);

                    if(!app_number)
                    {                        
                        document.getElementById("Btn").disabled = false;
                        alert(data);
                        document.getElementById("application_number").value = '';
                        document.getElementById("Btn").value = 'Call';
                        sessionStorage.removeItem("app_number");
                        sessionStorage.removeItem("status");
                        sessionStorage.removeItem("id");
                    }else{
                        document.getElementById("application_number").value = sessionStorage.app_number;
                        document.getElementById("Btn").value = sessionStorage.status;
                        document.getElementById("del_btn").value = sessionStorage.id;
                        document.getElementById("Btn").disabled = false;
                    }
                }
            });
        }else{
            var app_number = $("input[name=app_number]").val();
            var status = $("input[name=status]").val();
            var _token   = $('meta[name="csrf-token"]').attr('content');
            var update_id = $("input[name=id]").val();
  
            document.getElementById("Btn").disabled = true;

            $.ajax({
                type:'POST',
                url:'/display/'+update_id+'/update',
                data:{id:update_id,app_number:app_number,status:status,_token: _token},
                success:function(data){
                    
                    sessionStorage.setItem('app_number',data['app_number']);
                    sessionStorage.setItem('status',data['status']);
                    sessionStorage.setItem('id',data['id']);

                    var status = sessionStorage.getItem('status');

                    if(status == "delete")
                    {
                        sessionStorage.removeItem("app_number");
                        sessionStorage.removeItem("status");
                        sessionStorage.removeItem("id");

                        document.getElementById("application_number").value = '';
                        document.getElementById("Btn").value = 'Call';
                        document.getElementById("Btn").disabled = false;
                    }else {
                      
                        document.getElementById("application_number").value = sessionStorage.app_number;
                        document.getElementById("Btn").value = sessionStorage.status;
                        document.getElementById("del_btn").value = sessionStorage.id;
                        document.getElementById("Btn").disabled = false;
                    }
                }
            });
        }
        
    });

//Delete Data
    $(".delete").click(function(event){
        event.preventDefault();
        var delete_id = $("input[name=id]").val();
    $.ajax({
        url: '/display/'+delete_id+'/delete',
        type: 'get',
        success: function(response){
            sessionStorage.removeItem("app_number");
            sessionStorage.removeItem("status");
            sessionStorage.removeItem("id");

            document.getElementById("application_number").value = '';
            document.getElementById("Btn").value = 'Call';
            document.getElementById("Btn").disabled = false;
        }
    });
    });

  </script>
