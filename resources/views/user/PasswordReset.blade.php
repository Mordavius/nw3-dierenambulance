{!! Form::model($user, [
    'method' => 'POST',
]) !!}
<input id="postal_code" name="postal_code" type="text" placeholder="Voer je postcode in"/>
<input id="address" name="address" type="text" placeholder="Voer je straatnaam in" />
<input id="house_number" name="house_number" type="text" placeholder="Voer je huisnummer in"/>
<input id="city" name="city" type="text" placeholder="Voer je stad in"/>
<input id="township" name="township" type="text" placeholder="Voer je gemeente in"/>
<input id="password" name="password" type="password" placeholder="Voer je wachtwoord in"/>
<input type="submit" value="Wachtwoord opslaan">
{!! Form::close() !!}
