@extends('layouts.app')
<script type="text/javascript" src="{{asset('js/jquery-min.js')}}"></script>
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
                    Ga
                </button>
                <div class="card-body">
                    <a href="/">
                        <div class="btn btn-primary">
                            Terug naar het menu
                        </div>
                    </a>
                    <a>
                        <div class="btn btn-primary" id="sendLocationButton">
                            Locatie opvragen
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
                            <div class="col-12 melding">
                                {!! Form::model($ticket, [
                                    'method' => 'POST',
                                    'route' => 'melding.store'
                                ]) !!}
                                        <hr>
                                        <h2>Melder</h2>
                                        <div class="form-group {{ $errors->has('reporter_name') ? 'has-error' : '' }}">
                                            {!! Form::label('Naam van melder') !!}
                                            {!! Form::text('reporter_name', null, ['class' => 'form-control', 'autocomplete' => "reporter_name"]) !!}
                                            @if($errors->has('meldernaam'))
                                                <span class="help-block">
                                                    {{ $errors->first('reporter_name') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                            {!! Form::label('Telefoonnummer van melder') !!}
                                            {!! Form::text('telephone', null, ['class' => 'form-control', 'autocomplete' => "telephone"]) !!}
                                            @if($errors->has('telephone'))
                                                <span class="help-block">
                                                    {{ $errors->first('telephone') }}
                                                </span>
                                            @endif
                                        </div>
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
                                            {!! Form::label('tijd') !!}
                                            <input class="form-control" type="time" name="time" value="{{ date('h:i', strtotime($ticket->current_time)) }}" />
                                            @if($errors->has('time'))
                                                <span class="help-block">
                                                    {{ $errors->first('time') }}
                                                </span>
                                            @endif
                                        </div>
                                        <hr>
                                        <h2>Locatie</h2>
                                        {!! Form::hidden('coordinates', false, ['id' => 'coordinates']) !!}
                                        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                                            {!! Form::label('Postcode') !!}
                                            {!! Form::text('postal_code', false, ['class' => 'form-control', 'id' => 'postal_code', 'autocomplete' => "postal-code"]) !!}
                                            @if($errors->has('postal_code'))
                                                <span class="help-block">
                                                    {{ $errors->first('postal_code') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('house_number') ? 'has-error' : '' }}">
                                            {!! Form::label('Huisnummer') !!}
                                            {!! Form::text('house_number', null, ['class' => 'form-control', 'id' => 'house_number', 'autocomplete' => "house_number"]) !!}
                                            @if($errors->has('house_number'))
                                                <span class="help-block">
                                                    {{ $errors->first('house_number') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            {!! Form::label('Straatnaam') !!}
                                            {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'address', 'autocomplete' => "address"]) !!}
                                            @if($errors->has('address'))
                                                <span class="help-block">
                                                    {{ $errors->first('address') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            {!! Form::label('Plaats') !!}
                                            {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'autocomplete' => "city"]) !!}
                                            @if($errors->has('city'))
                                                <span class="help-block">
                                                    {{ $errors->first('city') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            {!! Form::label('Gemeente') !!}
                                            {!! Form::text('township', null, ['class' => 'form-control', 'id' => 'township', 'autocomplete' => "township"]) !!}
                                            @if($errors->has('gemeente'))
                                                <span class="help-block">
                                                    {{ $errors->first('gemeente') }}
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
                                        <div class="form-group {{ $errors->has('centralist') ? 'has-error' : '' }}">

                                        <div autocomplete="name" class="form-group {{ $errors->has('centralist') ? 'has-error' : '' }}" >
                                            {!! Form::label('Centralist') !!}
                                            {!! Form::select('centralist', $user, ['class' => 'form-control', 'id' => 'centralist', 'autocomplete' => "name"]) !!}
                                            @if($errors->has('centralist'))
                                                <span class="help-block">
                                                    {{ $errors->first('centralist') }}
                                                </span>
                                            @endif
                                        </div>
                                        <hr>
                                        <h2>Dier</h2>
                                        <div class="form-group {{ $errors->has('animal_species') ? 'has-error' : '' }}">
                                            {!! Form::label('Diersoort') !!}
                                            <br />
                                            {!! Form::radio('animal_species', 'hond', ['class' => 'form-control']) !!}
                                            {!! Form::label('Hond') !!}

                                            {!! Form::radio('animal_species', 'Kat', ['class' => 'form-control']) !!}
                                            {!! Form::label('Kat') !!}

                                            {!! Form::radio('animal_species', 'Egel', ['class' => 'form-control']) !!}
                                            {!! Form::label('Egel') !!}

                                            {!! Form::radio('animal_species', 'Vogel', ['class' => 'form-control']) !!}
                                            {!! Form::label('Vogel') !!}

                                            {!! Form::radio('animal_species', 'Anders', ['class' => 'form-control']) !!}
                                            {!! Form::label('Anders') !!}

                                            @if($errors->has('animal_species'))
                                                <span class="help-block">
                                                    {{ $errors->first('animal_species') }}
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
                                        <div style="display: none;" class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            {!! Form::label('Opmerkingen') !!}
                                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

                                            @if($errors->has('description'))
                                                <span class="help-block">
                                                    {{ $errors->first('description') }}
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

@section('scripts')
@endsection
