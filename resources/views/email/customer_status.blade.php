<html>
  <head>
    <title>Customer login ID</title>
  </head>
  <body>
    <p>
      <b>Dear {{$user['first_name']}} {{$user['last_name']}},</b>
    </p>
    <p>I hope you are well.</p>
    <p>I already sent your login ID. <br />LoginID is {{$user['login_id']}}
    </p>
    <p>Your password is that you created before.</p>
    <p>Please let me know if you have something.</p>
    <p>Have a nice day!</p>
    <p>Best regards,</p>
  </body>
</html>