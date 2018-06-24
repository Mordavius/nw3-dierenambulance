<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welkom bij Notepet, {{$user['name']}}</h2>
<br/>
Je bent geregistreerd met dit e-mail adres: {{$user['email']}}


<br/>
Druk op de knop hieronder om je gegevens in te vullen en je wachtwoord wijzigen.
<br/>
<a href="https://notepet.nl/passwords/reset/{{$user['id']}}/{{$user['token']}}"><button>Wachtwoord wijzigen</button></a>
</body>

</html>
