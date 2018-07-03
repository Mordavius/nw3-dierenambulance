@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
@include('administration.edit_menu')
@section('body_class', 'edit_page')
<div class="wrapper">
  <section class="content">
        <h1>Nieuwe adres toevoegen</h1>
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
            {!! Form::text('location_name', null, ['placeholder' => 'Naam'], ['class' => 'form-control']) !!}

            @if($errors->has('location_name'))
                <br /><span class="alert-danger">{{ $errors->first('location_name') }}</span><br /><br />
            @endif
        </div>

        <div class="form-group{{ $errors->has('postal_code') ? 'has-error' : ''}}">
            {!! Form::text('postal_code', null, ['placeholder' => 'Postcode'], ['class' => 'form-control']) !!}

            @if($errors->has('postal_code'))
                <br /><span class="alert-danger">{{ $errors->first('postal_code') }}</span><br /><br />
            @endif
        </div>

        <div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::text('address', null,['placeholder' => 'Adres'], ['class' => 'form-control']) !!}

            @if($errors->has('address'))
                <br /><span class="alert-danger">{{ $errors->first('address') }}</span><br /><br />
            @endif
        </div>

        <div class="form-group{{ $errors->has('house_number') ? 'has-error' : ''}}">
            {!! Form::text('house_number', null, ['placeholder' => 'Nummer'], ['class' => 'form-control']) !!}

            @if($errors->has('house_number'))
                <br /><span class="alert-danger">{{ $errors->first('house_number') }}</span><br /><br />
            @endif
        </div>

        <div class="form-group{{ $errors->has('city') ? 'has-error' : ''}}">
            {!! Form::text('city', null, ['placeholder' => 'Plaats'], ['class' => 'form-control']) !!}

            @if($errors->has('city'))
                <br /><span class="alert-danger">{{ $errors->first('city') }}</span><br /><br />
            @endif
        </div>

        <div class="form-group{{ $errors->has('township') ? 'has-error' : ''}}">
            {!! Form::text('township', null, ['placeholder' => 'Gemeente'], ['class' => 'form-control']) !!}
        </div>

        @if($errors->has('township'))
            <br /><span class="alert-danger">{{ $errors->first('township') }}</span><br /><br />
        @endif

            {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
        {!! Form::close()   !!}
  </section>
</div>
@endsection
