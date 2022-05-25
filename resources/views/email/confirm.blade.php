<html>
    <head>
        <title>Complete Registered.</title>
    </head>
   <body>
     <p><b>Dear {{$user['first_name']}} {{$user['last_name']}},</b></p>

	<p>I hope you are well.</p>
	
    @if($user['user_type'] == "staff")
     <p>Register Complete!.I already sent your login ID.<br/>LoginID is {{$user['login_id']}}</p>
    <p>Please create password for login.Click this link <a href="{{url('/create-new-password',$user['id'])}}">Create New Password</a></p>
    
    @else
   <p>Register Complete! we will reply during one or  two days.</p>

    @endif
<p>Best regards,</p>
</body>
  
</html>