@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    <a href="javascript:history.back()">
                        <div class="btn btn-primary">
                            Ga terug
                        </div>
                    </a>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content-wrapper">
                        <section class="content-header">
                            <h1>
                                Bekijk een melding
                            </h1>
                        </section>
                        <section class="content">
                            <div class="col-6">
                                {!! Form::model($notification, [
                                    'route' => ['melding.show', $notification->id],
                                    'id' => 'post-form'
                                ]) !!}
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                        {!! Form::label('datum') !!}
                                        <input class="form-control" type="date" name="date" value="{{ \Carbon\Carbon::createFromDate($notification->year,$notification->month,$notification->day)->format('Y-m-d')}}" />
                                        @if($errors->has('date'))
                                            <span class="help-block">
                                                {{ $errors->first('date') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                        {!! Form::label('tijd (idee om een hier een klokje tijdselectie?)') !!}
                                        <input class="form-control" type="time" name="time" value="{{ \Carbon\Carbon::createFromTime($notification->hour,$notification->minute,$notification->second)->format('H-m-s')}}" />
                                        @if($errors->has('time'))
                                            <span class="help-block">
                                                {{ $errors->first('time') }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <h2>Locatie</h2>
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                        {!! Form::label('Adres') !!}
                                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('address'))
                                            <span class="help-block">
                                                {{ $errors->first('address') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('housenumber') ? 'has-error' : '' }}">
                                        {!! Form::label('Huisnummer') !!}
                                        {!! Form::text('housenumber', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('housenumber'))
                                            <span class="help-block">
                                                {{ $errors->first('housenumber') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('postalcode') ? 'has-error' : '' }}">
                                        {!! Form::label('Postcode') !!}
                                        {!! Form::text('postalcode', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('postalcode'))
                                            <span class="help-block">
                                                {{ $errors->first('postalcode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('nocode') ? 'has-error' : '' }}">
                                        {!! Form::label('Geen Postcode') !!}
                                        {!! Form::checkbox('nocode', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('nocode'))
                                            <span class="help-block">
                                                {{ $errors->first('nocode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                        {!! Form::label('Plaats') !!}
                                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('city'))
                                            <span class="help-block">
                                                {{ $errors->first('city') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('centralist') ? 'has-error' : '' }}">
                                        {!! Form::label('Centralist') !!}
                                        {!! Form::select('centralist', $user) !!}
                                        @if($errors->has('centralist'))
                                            <span class="help-block">
                                                {{ $errors->first('centralist') }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <h2>Melder</h2>
                                    <div class="form-group {{ $errors->has('reportername') ? 'has-error' : '' }}">
                                        {!! Form::label('Naam van melder') !!}
                                        {!! Form::text('reportername', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('meldernaam'))
                                            <span class="help-block">
                                                {{ $errors->first('reportername') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                        {!! Form::label('Telefoonnummer van melder') !!}
                                        {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('telephone'))
                                            <span class="help-block">
                                                {{ $errors->first('telephone') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h2>Dier</h2>
                                    <div class="form-group {{ $errors->has('animalspecies') ? 'has-error' : '' }}">
                                        {!! Form::label('Diersoort') !!}
                                        <br />
                                        {!! Form::radio('animalspecies', 'hond') !!}
                                        {!! Form::label('Hond') !!}
                                        {!! Form::radio('animalspecies', 'kat', ['class' => 'form-control']) !!}
                                        {!! Form::label('Kat') !!}
                                        {!! Form::radio('animalspecies', 'egel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Egel') !!}
                                        {!! Form::radio('animalspecies', 'vogel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Vogel') !!}
                                        {!! Form::radio('animalspecies', 'anders', ['class' => 'form-control']) !!}
                                        {!! Form::label('Anders') !!}
                                        @if($errors->has('animalspecies'))
                                            <span class="help-block">
                                                {{ $errors->first('animalspecies') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                        {!! Form::label('Geslacht') !!}
                                        <br />
                                        {!! Form::radio('gender', 'mannelijk', ['class' => 'form-control']) !!}
                                        {!! Form::label('Mannelijk') !!}
                                        {!! Form::radio('gender', 'vrouwelijk', ['class' => 'form-control']) !!}
                                        {!! Form::label('Vrouwelijk') !!}
                                        {!! Form::radio('gender', 'onbekend', ['class' => 'form-control']) !!}
                                        {!! Form::label('Onbekend') !!}
                                        @if($errors->has('gender'))
                                            <span class="help-block">
                                                {{ $errors->first('gender') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                                        {!! Form::label('Opmerkingen') !!}
                                        {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('comments'))
                                            <span class="help-block">
                                                {{ $errors->first('comments') }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                {!! Form::close() !!}
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
