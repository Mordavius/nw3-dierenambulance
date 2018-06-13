
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
<div class="container">
<div class="icon-bar">
    <div class="left">
        <button id="toggle-button">
            <img id="map-image" src="images/map-view.png">
            <img id="list-image" src="images/list-view-active.png">
        </button>
    </div>
    <div class="right">
        <img id="search-icon" src="/images/search-icon.png">
        <img id="filter-icon" src="/images/filter-icon.png">
    </div>
</div>

<div class="container testin">
    <div class="row justify-content-center">

        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Test search </h3>
                        <br /><br /><br />
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-controller" id="search" name="search">
                            <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="target">
            <div class="text-center"></div>
            <div class="form-group {{ $errors->has('filter') ? 'has-error' : '' }}">
                {!! Form::label('Laat meldingen zien vanaf') !!}
                <!--{!! Form::select('filter', ["alles", "week", "month", "year"]) !!}-->
                    <select id="times">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <select id="tf" onclick="filterTickets()">
                        <option>Filter</option>
                    <option value="everything">
                        Alles
                    </option>
                    <option value="week">
                        Weken
                    </option>
                    <option value="month">
                        Maanden
                    </option>
                    <option value="year">
                        Jaren
                    </option>
                </select>
                @if($errors->has('filter'))
                    <span class="help-block">
                        {{ $errors->first('filter') }}
                    </span>
                @endif

                    <div class="form-inline">

                    </div>
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
                            @if (! $unfinishedtickets->count())
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
                                    <tbody class="zoekresultaten">
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
                                                <td>{{ $unfinishedticket->date }}
                                                {{ $unfinishedticket->time }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['melding.destroy', $unfinishedticket->id],
                                                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                                                        <a href="{{ route('melding.edit', $unfinishedticket->id) }}">
                                                            <i class="btn btn-primary">Aanpassen</i>
                                                        </a>
                                                        <br />
                                                        <a href="{{ route('melding.show', $unfinishedticket->id) }}">
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
                        <br />
                        <br />
                        <h4 id="finishedtext">
                            Afgeronde meldingen
                        </h4>
                        <div class="box-body">
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
                                    <tbody id="finished">
                                    <tbody>
                                        @foreach($finishedtickets as $finishedticket)
                                            <tr>@foreach($animals as $animal)
                                                @if($finishedticket->animal_id == $animal->id)
                                                    <td>{{ $animal->animal_species }}
                                                    <br />
                                                    {{ $animal->gender}}</td>
                                                    <td>{{$animal->description}}</td>
                                                @endif
                                            @endforeach
                                                @foreach($destinations as $destination)
                                                    @if($destination->ticket_id == $finishedticket->id)
                                                    <td>
                                                        {{ $destination->address }} {{ $destination->house_number }}
                                                        <br />
                                                        {{ $destination->postal_code }}, {{ $destination->city }}
                                                    </td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $finishedticket->date }}
                                                {{ $finishedticket->time }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['melding.destroy', $finishedticket->id],
                                                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                                                        <a href="{{ route('melding.edit', $finishedticket->id) }}">
                                                            <i class="btn btn-primary">Aanpassen</i>
                                                        </a>
                                                        <br />
                                                        <a href="{{ route('melding.show', $finishedticket->id) }}">
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
        <div class="col-md-12" id="target2" style="display:none;">

            <div ng-app="app">
                <div ng-controller="TableController" >
                    <div id="map" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
                    </div>
                </div>
            </div>
        </div>
        <a href="/melding/create">
            <button class="round">
                <img src="../images/plus.png" class="rotate-button"/>
            </button>
        </a>

    </div>
</div>
</div>


@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/filter.js')}}"></script>
    @endsection


    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

    </script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

@endsection
