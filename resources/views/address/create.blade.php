@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Nieuwe adres toevoegen
                </div>
                <div class="card-body">
                    <a href="javascript:history.back()">
                        <div class="btn btn-primary">
                            Terug naar het menu
                        </div>
                    </a>
                    </br>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::model($known, [
                        'method' => 'POST',
                        'route' => 'bekende-adressen.store'])
                    !!}
                    <div class="form-group{{ $errors->has('location_name') ? 'has-error' : ''}}">
                        {!! Form::label('Locatie naam') !!}
                        {!! Form::text('location_name', null, ['class' => 'form-control']) !!}

                        @if($errors->has('location_name'))
                          <span class="help-block">{{ $errors->first('location_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('postal_code') ? 'has-error' : ''}}">
                        {!! Form::label('Postcode') !!}
                        {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}

                        @if($errors->has('postal_code'))
                          <span class="help-block">{{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>


                    <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
                        {!! Form::label('Straat') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}

                        @if($errors->has('address'))
                            <span class="help-block">{{ $errors->first('address') }}</span>
                        @endif
                    </div>


                    <div class="form-group{{ $errors->has('house_number') ? 'has-error' : ''}}">
                        {!! Form::label('Huisnummer') !!}
                        {!! Form::text('house_number', null, ['class' => 'form-control']) !!}

                        @if($errors->has('house_number'))
                            <span class="help-block">{{ $errors->first('house_number') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('city') ? 'has-error' : ''}}">
                        {!! Form::label('Stad') !!}
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}

                        @if($errors->has('city'))
                            <span class="help-block">{{ $errors->first('city') }}</span>
                        @endif
                    </div>

                        {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close()   !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
