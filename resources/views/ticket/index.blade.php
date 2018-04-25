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
                        <a href="meldingen">
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
                                            <td>Diersoort</td>
                                            <td>Plaats</td>
                                            <td>Datum</td>
                                            <td>Tijd</td>
                                            <td>Beschrijving</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{ $ticket->animal_species }}</td>
                                                <td>{{ $ticket->city }}</td>
                                                <td>{{ $ticket->date }}</td>
                                                <td>{{ $ticket->time }}</td>
                                                <td>{{ $ticket->comments }}</td>
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
