@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="text-center"></div>
            <div class="form-group {{ $errors->has('filter') ? 'has-error' : '' }}">
                {!! Form::label('Laat meldingen zien vanaf') !!}
                {!! Form::select('filter', ["alles", "week", "month", "year"]) !!}
                @if($errors->has('filter'))
                    <span class="help-block">
                        {{ $errors->first('filter') }}
                    </span>
                @endif
                <form action="{{ route('search') }}">
                    <div class="form-inline">
                        <input type="search" class="form-control mr-sm-2" value="{{ request('search') }}" name="search" placeholder="Zoeken" aria-label="Search" />
                        <span class="input-group-btn">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                Zoeken
                            </button>
                        </span>
                    </div>
                </form>
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
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
                        @if ($search = request(''))
                            <div class="alert alert-info">
                                <p>Zoekresultaten<strong>{{ $search }}</strong></p>
                            </div>
                        @endif
                        <h4>
                            Actieve meldingen
                        </h4>
                        <div class="box-body ">
                            @if(session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (! $tickets->count())
                            <div class="alert alert-danger">
                                <strong>Geen meldingen gevonden</strong>
                            </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Diersoort &
                                                <br />
                                                Geslacht
                                            </td>
                                            <td>Beschrijving</td>
                                            <td>Adres</td>
                                            <td>Datum &
                                                <br />
                                                Tijd
                                            </td>

                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            @if($ticket->finished == '0')
                                            <tr>@foreach($animals as $animal)
                                                    @if($ticket->id == $animal->ticket_id)
                                                        <td>{{ $animal->animal_species }}
                                                        <br />
                                                        {{ $animal->gender}}</td>
                                                        <td>{{ $animal->description }}</td>
                                                    @endif
                                                @endforeach
                                                @foreach($destination_array as $destination)
                                                    @if($ticket->id == $destination->ticket_id)

                                                    <!-- {!! Form::hidden('coordinates', $destination->coordinates, ['id' => 'test']) !!} -->
                                                    <td>
                                                        {{ $destination->address }} {{ $destination->house_number }}

                                                        <br />
                                                        {{ $destination->postal_code }}, {{ $destination->city }}
                                                    </td>
                                                        @endif
                                                @endforeach
                                                <td>{{ $ticket->date }}
                                                {{ $ticket->time }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['melding.destroy', $ticket->id],
                                                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                                                        <a href="{{ route('melding.edit', $ticket->id) }}">
                                                            <i class="btn btn-primary">Aanpassen</i>
                                                        </a>
                                                        <br />
                                                        <a href="{{ route('melding.show', $ticket->id) }}">
                                                            <i class="btn btn-primary">Bekijk</i>
                                                        </a>
                                                        <br />
                                                        <button type="submit" class="btn btn-danger">
                                                            <i>Verwijderen</i>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <br />
                        <br />
                        <h4>
                            Afgeronde meldingen
                        </h4>
                        <div class="box-body ">
                            @if (! $tickets->count())
                            <div class="alert alert-danger">
                                <strong>Geen meldingen gevonden</strong>
                            </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Diersoort &
                                                <br />
                                                Geslacht
                                            </td>
                                            <td>Beschrijving</td>
                                            <td>Adres</td>
                                            <td>Datum &
                                                <br />
                                                Tijd
                                            </td>

                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            @if($ticket->finished == '1')
                                            <tr>@foreach($animals as $animal)
                                                @if($ticket->animal_id == $animal->id)
                                                    <td>{{ $animal->animal_species }}
                                                    <br />
                                                    {{ $animal->gender}}</td>
                                                    <td>{{$animal->description}}</td>
                                                @endif
                                            @endforeach
                                                @foreach($destinations as $destination)
                                                    @if($destination->ticket_id == $ticket->id)
                                                    <td>
                                                        {{ $destination->address }} {{ $destination->house_number }}
                                                        <br />
                                                        {{ $destination->postal_code }}, {{ $destination->city }}
                                                    </td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $ticket->date }}
                                                {{ $ticket->time }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['melding.destroy', $ticket->id],
                                                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                                                        <a href="{{ route('melding.edit', $ticket->id) }}">
                                                            <i class="btn btn-primary">Aanpassen</i>
                                                        </a>
                                                        <br />
                                                        <a href="{{ route('melding.show', $ticket->id) }}">
                                                            <i class="btn btn-primary">Bekijk</i>
                                                        </a>
                                                        <br />
                                                        <button type="submit" class="btn btn-danger">
                                                            <i>Verwijderen</i>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
