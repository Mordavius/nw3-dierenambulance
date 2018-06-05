@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Nieuwe buswissel
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
                    {!! Form::model($bus, [
                        'method' => 'POST',
                        'route' => 'bus.store'])
                    !!}
                    <div class="form-group{{ $errors->has('busname') ? 'has-error' : ''}}">
                        {!! Form::label('Bus Naam') !!}
                        {!! Form::text('bus_type', null, ['class' => 'form-control']) !!}

                        @if($errors->has('bus_type'))
                          <span class="help-block">{{ $errors->first('bus_type') }}</span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('milage') ? 'has-error' : ''}}">
                        {!! Form::label('Kilometerstand') !!}
                        {!! Form::text('milage', null, ['class' => 'form-control']) !!}

                        @if($errors->has('milage'))
                          <span class="help-block">{{ $errors->first('milage') }}</span>
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
