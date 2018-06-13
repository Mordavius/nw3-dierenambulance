<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
Your registered email-id is {{$user['email']}}



<a href="http://nw3-dierenambulance.test/passwords/reset/{{$user['id']}}/{{$user['token']}}"><button>Wachtwoord wijzigen</button></a>
</body>

</html>
