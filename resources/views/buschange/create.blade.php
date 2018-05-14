@extends('layouts.app')

@section('content')
<div class="container">
<<<<<<< HEAD
  <div class="row justify-content-center">
    <div class="col-md-12">
      <nav class="navbar navbar-light bg-light">
      </nav>
      <div class="card">
        <div class="card-header">Nieuwe buswissel</div>
        <div class="card-body">
          <a href="javascript:history.back()">
            <div class="btn btn-primary">Terug naar het menu</div>
          </a>
          <br />
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          {!! Form::model($buschange, [
            'method' => 'POST',
            'route' => 'buswissel.store'])
          !!}
          <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
            {!! Form::label('datum') !!}
              <input class="form-control" type="date" name="date"
                @if($buschange && $buschange->date)
                  value="{{ date('d-m-Y', strtotime($buschange->date)) }}"
                @else
                  value="{{ date('Y-m-d') }}"
                @endif
              />
            @if($errors->has('date'))
              <span class="help-block">{{ $errors->first('date') }}</span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('bus') ? 'has-error' : ''}}">
            {!! Form::label('bus') !!}
            {!! Form::select('bus', array('Bus' => 'Bus', 'Caddy' => 'Caddy')) !!}

            @if($errors->has('bus'))
              <span class="help-block">{{ $errors->first('bus') }}</span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('from') ? 'has-error' : ''}}">
            {!! Form::label('van') !!}
            {!! Form::select('from',$users) !!}
=======
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Nieuwe buswissel
                </div>
                <div class="card-body">
                    <a href="../buswissel">
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
                    {!! Form::model($buschange, [
                        'method' => 'POST',
                        'route' => 'buswissel.store'])
                    !!}
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                            {!! Form::label('datum') !!}
                            <input class="form-control" type="date" name="date"
                                @if($buschange && $buschange->date)
                                    value="{{ date('d-m-Y', strtotime($buschange->date)) }}"
                                @else
                                    value="{{ date('Y-m-d') }}"
                                @endif
                            />
                            @if($errors->has('date'))
                                <span class="help-block">
                                    {{ $errors->first('date') }}
                                </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('bus') ? 'has-error' : ''}}">
                            {!! Form::label('bus') !!}
                            {!! Form::select('bus', array('Bus' => 'Bus', 'Caddy' => 'Caddy')) !!}
>>>>>>> dev

                            @if($errors->has('bus'))
                                <span class="help-block">
                                    {{ $errors->first('bus') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('from') ? 'has-error' : ''}}">
                            {!! Form::label('van') !!}
                            {!! Form::select('from',$users) !!}

                            @if($errors->has('from'))
                                <span class="help-block">{{ $errors->first('from') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('to') ? 'has-error' : ''}}">
                            {!! Form::label('naar') !!}
                            {!! Form::select('to', $users) !!}

                            @if($errors->has('to'))
                                <span class="help-block">{{ $errors->first('to') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('kilometerstraveled') ? 'has-error' : ''}}">
                            {!! Form::label('Kilometerstand') !!}
                            {!! Form::text('kilometerstraveled', null, ['class' => 'form-control']) !!}

                            @if($errors->has('kilometerstraveled'))
                              <span class="help-block">{{ $errors->first('kilometerstraveled') }}</span>
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
