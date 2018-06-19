@extends('layouts.app')
@section('body_class', 'login_page')
@section('content')
<div class="container">
  <div class="logo_wrap">
    <img class="logo" src="{{ asset('images/dierenambulance-logo.svg') }}">
  </div>
      <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
                  <input id="email" placeholder="E-mail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                      <span class="invalid-feedback">
                          <strong>
                              {{ $errors->first('email') }}
                          </strong>
                      </span>
                  @endif
          </div>
          <div class="form-group">
                  <input id="password" placeholder="Wachtwoord" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                  @if ($errors->has('password'))
                      <span class="invalid-feedback">
                          <strong>
                              {{ $errors->first('password') }}
                          </strong>
                      </span>
                  @endif
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-success full-width">
                  Inloggen
              </button>
              <a class="btn btn-link" href="{{ route('password.request') }}">
                  Wachtwoord vergeten
              </a>
          </div>
      </form>

</div>
@endsection
