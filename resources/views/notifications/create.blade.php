@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Nieuwe melding toevoegen
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
                        <div class="col-6">
                            {!! Form::model($notification, [
                                'method' => 'POST',
                                'route' => 'melding.store'
                            ]) !!}

                            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                {!! Form::label('datum') !!}
                                <input class="form-control" type="date" name="date" value="{{ \Carbon\Carbon::createFromDate($notification->year,$notification->month,$notification->day)->format('Y-m-d')}}" />


                                @if($errors->has('date'))
                                    <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                {!! Form::label('tijd') !!}
                                <input class="form-control" type="time" name="time" value="{{ \Carbon\Carbon::createFromTime($notification->hour,$notification->minute,$notification->second)->format('H-m-s')}}" />

                                @if($errors->has('time'))
                                    <span class="help-block">{{ $errors->first('time') }}</span>
                                @endif
                            </div>

                            <h2>Locatie</h2>
                            <small>(automatisch adresgegevens aanvullen moet nog)</small>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                {!! Form::label('Adres') !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}

                                @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('housenumber') ? 'has-error' : '' }}">
                                {!! Form::label('Huisnummer') !!}
                                {!! Form::text('housenumber', null, ['class' => 'form-control']) !!}

                                @if($errors->has('housenumber'))
                                    <span class="help-block">{{ $errors->first('housenumber') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('postalcode') ? 'has-error' : '' }}">
                                {!! Form::label('Postcode') !!}
                                {!! Form::text('postalcode', null, ['class' => 'form-control']) !!}

                                @if($errors->has('postalcode'))
                                    <span class="help-block">{{ $errors->first('postalcode') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                {!! Form::label('Plaats') !!}
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}

                                @if($errors->has('city'))
                                    <span class="help-block">{{ $errors->first('city') }}</span>
                                @endif
                            </div>

                            <hr>

                            {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.box-body -->
        </section>
        <!-- /.content -->
    </div>

@endsection