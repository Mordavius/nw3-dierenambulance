@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
@section('body_class', 'edit_page')
<div class="wrapper">
  <form class="content" method="POST" action="{{ route('register') }}">
    <h1>Nieuwe gebruiker</h1>
      @csrf
      <div class="form-group">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>
                    {{ $errors->first('name') }}
                </strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>
                    {{ $errors->first('email') }}
                </strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>
                    {{ $errors->first('password') }}
                </strong>
            </span>
        @endif
      </div>
      <div class="form-group">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>

      <div class="form-group">
        <ul class="segmented-control">
          <li class="segmented-control__item">
            <input class="segmented-control__input" type="radio" id="option-ambulance" value="3" name="role_id">
            <label class="segmented-control__label" for="option-ambulance" value="Ambulance">Ambulance</label>
          </li>
          <li class="segmented-control__item">
            <input class="segmented-control__input" type="radio" id="option-centralist" value="2" name="role_id">
            <label class="segmented-control__label" for="option-centralist" value="Centralist">Centralist</label>
          </li>
          <li class="segmented-control__item">
            <input class="segmented-control__input" type="radio" id="option-beheerder" value="1" name="role_id">
            <label class="segmented-control__label" for="option-beheerder" value="Beheerder">Beheerder</label>
          </li>
        </ul>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
            Registreren
        </button>
      </div>
  </form>
</div>
@endsection
