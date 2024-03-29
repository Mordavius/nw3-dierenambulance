@extends('layouts.app')

@section('map')
    @include('map')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Melding maken
                </div>
                <input id="searchTextBox" type="text"/>
                <button id="searchButton">
                    Search
                </button>
                <div class="card-body">
                    <a href="../meldingen">
                        <div class="btn btn-primary">
                            Terug naar het menu
                        </div>
                    </a>
                    <br />
                    <br />
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content-wrapper">
                        <section class="content">
                            <div class="col-12">
                                {!! Form::model($ticket, [
                                    'method' => 'POST',
                                    'route' => 'melding.store'
                                ]) !!}
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                        {!! Form::label('datum') !!}
                                            <input class="form-control" type="date" name="date"
                                                @if($ticket && $ticket->date)
                                                    value="{{ date('Y-m-d', strtotime($ticket->date)) }}"
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
                                    <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                        {!! Form::label('tijd (idee om een hier een klokje tijdselectie?)') !!}
                                        <input class="form-control" type="time" name="time" value="{{ $ticket->time }}" />
                                        @if($errors->has('time'))
                                            <span class="help-block">
                                                {{ $errors->first('time') }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <h2>Locatie</h2>
                                    <div class="form-group {{ $errors->has('postalcode') ? 'has-error' : '' }}">
                                        {!! Form::label('Postcode') !!}
                                        {!! Form::text('postalcode', false, ['class' => 'form-control', 'id' => 'postalcode']) !!}
                                        @if($errors->has('postalcode'))
                                            <span class="help-block">
                                                {{ $errors->first('postalcode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('nocode') ? 'has-error' : '' }}">
                                        {!! Form::label('Geen Postcode') !!}
                                        {!! Form::checkbox('nocode', 0, null) !!}
                                        @if($errors->has('nocode'))
                                            <span class="help-block">
                                                {{ $errors->first('nocode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('housenumber') ? 'has-error' : '' }}">
                                        {!! Form::label('Huisnummer') !!}
                                        {!! Form::text('housenumber', null, ['class' => 'form-control', 'id' => 'housenumber']) !!}
                                        @if($errors->has('housenumber'))
                                            <span class="help-block">
                                                {{ $errors->first('housenumber') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                        {!! Form::label('Straatnaam') !!}
                                        {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'address']) !!}
                                        @if($errors->has('address'))
                                            <span class="help-block">
                                                {{ $errors->first('address') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                        {!! Form::label('Plaats') !!}
                                        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}
                                        @if($errors->has('city'))
                                            <span class="help-block">
                                                {{ $errors->first('city') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                        {!! Form::label('Gemeente') !!}
                                        {!! Form::text('township', null, ['class' => 'form-control', 'id' => 'township']) !!}
                                        @if($errors->has('gemeente'))
                                            <span class="help-block">
                                                {{ $errors->first('gemeente') }}
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
                                    {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
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
<!--
@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
  <script src = "{!!asset('js/angular.min.js')!!}"></script>
  <script src = "{!!asset('js/table-directive.js')!!}"></script>
@endsection -->
