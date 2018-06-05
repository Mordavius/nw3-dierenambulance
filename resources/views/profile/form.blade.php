<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if($errors->has('name'))
        <span class="help-block">
            {{ $errors->first('name') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    @if($errors->has('email'))
        <span class="help-block">
            {{ $errors->first('email') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @if($errors->has('password'))
        <span class="help-block">
            {{ $errors->first('password') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    @if($errors->has('password_confirmation'))
        <span class="help-block">
            {{ $errors->first('password_confirmation') }}
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
  <ul class="segmented-control">
    <li class="segmented-control__item">
      <input type="radio" id="option-ambulance" value="3" name="role_id">
      <label class="segmented-control__label" for="option-ambulance" value="Ambulance">Ambulance</label>
    </li>
    <li class="segmented-control__item">
      <input type="radio" id="option-centralist" value="2" name="role_id">
      <label class="segmented-control__label" for="option-centralist" value="Centralist">Centralist</label>
    </li>
    <li class="segmented-control__item">
      <input type="radio" id="option-beheerder" value="1" name="role_id">
      <label class="segmented-control__label" for="option-beheerder" value="Beheerder">Beheerder</label>
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
    <button type="submit" class="btn btn-succes">
        {{ $user->exists ? 'Bijwerken' : 'Save' }}
    </button>
    <a href="../" class="btn btn-default">
        Cancel
    </a>
</div>
