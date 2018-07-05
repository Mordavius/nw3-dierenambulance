<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::text('name', null, ['placeholder' => 'Naam']) !!}
    @if($errors->has('name'))
    <span class="help-block">
        {{ $errors->first('name') }}
    </span>
    @endif
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::text('email', null, ['placeholder' => 'E-mail']) !!}
    @if($errors->has('email'))
    <span class="help-block">
        {{ $errors->first('email') }}
    </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {!! Form::password('password', [ 'placeholder' => 'Wachtwoord']) !!}
    @if($errors->has('password'))
    <span class="help-block">
        {{ $errors->first('password') }}
    </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
    {!! Form::password('password_confirmation', ['placeholder' => 'Wachtwoord bevestigen']) !!}
    @if($errors->has('password_confirmation'))
    <span class="help-block">
        {{ $errors->first('password_confirmation') }}
    </span>
    @endif
</div>
<div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
    <ul class="segmented-control">
        <li class="segmented-control__item">
            {{--<input class="segmented-control__input" type="radio" id="option-ambulance" value="3" name="role_id">--}}
            @if($user->role_id == 3)
                <input class="segmented-control__input" type="radio" id="option-ambulance" value="3" name="role_id" checked>
                <label class="segmented-control__label selected" for="option-ambulance" value="Ambulance">Ambulance</label>
            @else
                <input class="segmented-control__input" type="radio" id="option-ambulance" value="3" name="role_id">
                <label class="segmented-control__label" for="option-ambulance" value="Ambulance">Ambulance</label>
            @endif

        </li>
        <li class="segmented-control__item">
            {{--<input class="segmented-control__input" type="radio" id="option-centralist" value="2" name="role_id">--}}
            @if($user->role_id == 2)
                <input class="segmented-control__input" type="radio" id="option-centralist" value="2" name="role_id" checked>
                <label class="segmented-control__label selected" for="option-centralist" value="Ambulance">Centralist</label>
            @else
                <input class="segmented-control__input" type="radio" id="option-centralist" value="2" name="role_id">
                <label class="segmented-control__label" for="option-centralist" value="Centralist">Centralist</label>
            @endif
        </li>
        <li class="segmented-control__item">
            {{--<input class="segmented-control__input" type="radio" id="option-beheerder" value="1" name="role_id">--}}
            @if($user->role_id == 1)
                <input class="segmented-control__input" type="radio" id="option-beheerder" value="1" name="role_id" checked>
                <label class="segmented-control__label selected" for="option-beheerder" value="Beheerder">Beheerder</label>
            @else
                <input class="segmented-control__input" type="radio" id="option-beheerder" value="1" name="role_id">
                <label class="segmented-control__label" for="option-beheerder" value="Beheerder">Beheerder</label>
            @endif
        </li>
    </ul>
    @if($errors->has('role_id'))
    <span class="help-block">
        {{  $errors->first('role_id') }}
    </span>
    @endif
</div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-success">
        {{ $user->exists ? 'Bijwerken' : 'Save' }}
    </button>
</div>
