{!! Form::model($user, [
    'method' => 'POST',
]) !!}

<input id="password" name="password" type="password" placeholder="Voer je wachtwoord in"/>
<input type="submit" value="Wachtwoord opslaan">
{!! Form::close() !!}
