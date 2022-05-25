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

    // $(document).ready(function() {
           
    //      if(sessionStorage.app_number){
    //         document.getElementById("application_number").value = sessionStorage.app_number;
    //         document.getElementById("Btn").value = sessionStorage.status;
    //         document.getElementById("del_btn").value = sessionStorage.id;
    //      }else{
    //         document.getElementById("Btn").value = "Call";
    //      }
        
    // });


//Save and Update and Search data
    $(".save-data").click(function(event){
        event.preventDefault();
        var app_number = $("input[name=app_number]").val();
        if(app_number){
            var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type:'POST',
                    url:'/display/update',
                    data:{app_number:app_number,_token: _token},
                    success:function(data){
                    alert(data.status);
                    }
                });
        }else{
            alert("Need to fill App No.");
            
        }
       
    });

//Delete Data
    $(".delete").click(function(event){
        event.preventDefault();
        var app_number = $("input[name=app_number]").val();
        if(app_number){
            $.ajax({
                url: '/display/delete/'+ app_number,
                type: 'get',
                success: function(response){
                    alert(response.status);
                }
            });
        }else{
            alert("Need to fill app no you want to delete.");
        }
    });

  </script>
