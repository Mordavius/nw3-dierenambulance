@extends('layouts.app')
@section('body_class', 'sendresetmail')
@section('content')
<div class="container">
  <div class="logo_wrap">
    <img class="logo" src="{{ asset('images/Dierenambulance-logo.svg') }}">
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h2>  Wachtwoord opnieuw instellen </h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="info"> Vul hieronder het e-mail adres van je account om je wachtwoord opnieuw in te stellen. Wij sturen naar dit e-mailadres een mail met een link waarmee jij je wachtwoord opnieuw kunt instellen </span>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                E-mailadres
                            </label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 centered">
                                <button type="submit" class="btn-success">
                                    Wachtwoord opnieuw instellen
                                </button>

                            </div>
                        </div>
                    </form>
                    <span class="col-md-6 back centered"> Al een account? <a href="../"> Druk hier om in te loggen</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
