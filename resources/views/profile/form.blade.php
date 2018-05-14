<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('naam') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if($errors->has('name'))
        <span class="help-block">
            {{ $errors->first('name') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::label('E-mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    @if($errors->has('email'))
        <span class="help-block">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {!! Form::label('Wachtwoord') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @if($errors->has('password'))
        <span class="help-block">
            {{ $errors->first('password') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
    {!! Form::label('Wachtwoord bevestigen') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    @if($errors->has('password_confirmation'))
        <span class="help-block">
            {{ $errors->first('password_confirmation') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
    {!! Form::label('Voornamelijk actief als') !!}
    {{Form::select('role_id', array('1' => 'Administrator', '2' => 'Centralist', '3' => 'Ambulance Medewerker', '4' => 'Administratie Medewerker'))}}
@if($errors->has('role_id'))
        <span class="help-block">
            {{  $errors->first('role_id') }}
        </span>
    @endif
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">
        {{ $user->exists ? 'Update account' : 'Save' }}
    </button>
    <a href="../" class="btn btn-default">
        Cancel
    </a>
</div>
