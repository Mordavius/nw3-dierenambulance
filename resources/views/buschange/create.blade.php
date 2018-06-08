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

                            @if($errors->has('bus'))
                                <span class="help-block">
                                    {{ $errors->first('bus') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                            {!! Form::label('Van') !!} <br />
                            <select name="from" id="from">
                                @foreach($users as $user)
                                    <option value="{{$user}}">{{$user}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('from'))
                                <span class="help-block">
                                    {{ $errors->first('from') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                            {!! Form::label('Naar') !!} <br />
                            <select name="to" id="to">
                                @foreach($users as $user)
                                    <option value="{{$user}}">{{$user}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('to'))
                                <span class="help-block">
                                        {{ $errors->first('to') }}
                                    </span>
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
