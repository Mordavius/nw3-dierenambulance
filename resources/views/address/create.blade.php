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
                            <br /><span class="alert alert-danger">{{ $errors->first('location_name') }}</span><br /><br />
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('postal_code') ? 'has-error' : ''}}">
                        {!! Form::label('Postcode') !!}
                        {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}

                        @if($errors->has('postal_code'))
                            <br /><span class="alert alert-danger">{{ $errors->first('postal_code') }}</span><br /><br />
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
                        {!! Form::label('Straat') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}

                        @if($errors->has('address'))
                            <br /><span class="alert alert-danger">{{ $errors->first('address') }}</span><br /><br />
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('house_number') ? 'has-error' : ''}}">
                        {!! Form::label('Huisnummer') !!}
                        {!! Form::text('house_number', null, ['class' => 'form-control']) !!}

                        @if($errors->has('house_number'))
                            <br /><span class="alert alert-danger">{{ $errors->first('house_number') }}</span><br /><br />
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('city') ? 'has-error' : ''}}">
                        {!! Form::label('Stad') !!}
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}

                        @if($errors->has('city'))
                            <br /><span class="alert alert-danger">{{ $errors->first('city') }}</span><br /><br />
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('township') ? 'has-error' : ''}}">
                        {!! Form::label('Gemeente') !!}
                        {!! Form::text('township', null, ['class' => 'form-control']) !!}
                    </div>

                    @if($errors->has('township'))
                        <br /><span class="alert alert-danger">{{ $errors->first('township') }}</span><br /><br />
                    @endif

                        {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close()   !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
