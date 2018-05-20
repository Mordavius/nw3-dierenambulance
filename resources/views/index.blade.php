<link rel="stylesheet" type="text/css" href="{{ asset('css/cssgrid.css') }}">
@extends('layouts.app')

@section('content')
<div class="icon-bar">
    <div class="left">
        <button id="toggle-button">
            <img id="map-image" src="images/map-view.png"></img>
            <img id="list-image" src="images/list-view-active.png"></img>
        </button>
    </div>
    <div class="right">
        <img id="search-icon" src="/images/search-icon.png"></img>
        <img id="filter-icon" src="/images/filter-icon.png"></img>
    </div>
</div>
<a href="/melding/create">
    <button class="round">
        <img src="../images/plus.png" class="rotate-button"/>
    </button>
</a>
<div class="tickets" id="target">
    <div class="grid_container">
        <div class="grid_header">
            <div class="tickets open_tickets">Openstaande meldingen</div>
            <div class="result_amount">Totaal aantal: {{$unfinishedtickets->count()}}</div>
        </div>
        <div class="grid_main">
            @foreach($unfinishedtickets as $unfinishedticket)
                    @foreach($animals as $animal)
                        @if($unfinishedticket->animal_id == $animal->id)
                        <div class="grid_ticket flag-new">
                            <div class="ticket_number">
                                #{{ $unfinishedticket->id }}
                            </div>
                            <div class="grid_animal_icon">
                                <div class="ticket_icon">
                                    <img src="/images/hond-icon.png" id="animal_icon">
                                </div>
                            </div>
                            <div class="ticket_main_info">
                                <div class="ticket_title">{{$animal->animal_species}}</div>
                                <div class="ticket_address">
                                    @foreach($destinations as $destination)
                                        @if($destination->ticket_id == $unfinishedticket->id)
                                            {{$destination->address}}
                                            @if($destination->house_number != '0')
                                                {{$destination->house_number}}
                                            @endif
                                            ,
                                            {{$destination->postal_code}}
                                            {{$destination->city}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <article class="ticket_description">
                                {{$animal->description}}
                            </article>
                        </div>
                        @endif
                    @endforeach
            @endforeach
        </div>
    </div>
    <div class="grid_container">
        <div class="grid_header">
            <div class="tickets closed_tickets">Afgeronde meldingen</div>
        </div>
        <div class="grid_main">
            @foreach($finishedtickets as $finishedticket)
                    @foreach($animals as $animal)
                        @if($finishedticket->animal_id == $animal->id)
                        <div class="grid_ticket">
                            <div class="ticket_number">
                                #{{ $finishedticket->id }}
                            </div>
                            <div class="grid_animal_icon">
                                <div class="ticket_icon">
                                    <img src="/images/hond-icon.png" id="animal_icon">
                                </div>
                            </div>
                            <div class="ticket_main_info">
                                <div class="ticket_title">{{$animal->animal_species}}</div>
                                <div class="ticket_address">
                                    @foreach($destinations as $destination)
                                        @if($destination->ticket_id == $finishedticket->id)
                                            {{$destination->address}}
                                            @if($destination->house_number != '0')
                                                {{$destination->house_number}}
                                            @endif
                                            ,
                                            {{$destination->postal_code}}
                                            {{$destination->city}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <article class="ticket_description">
                                {{$animal->description}}
                            </article>
                        </div>
                        @endif
                    @endforeach
            @endforeach
        </div>
    </div>
</div>
<div class="grid_container" id="target2" style="display: none;">
    <div class="grid_header">
        test
    </div>
    <div class="grid_main">
        <div ng-app="app">
            <div ng-controller="TableController" >
                <div id="map" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>
@endsection
@endsection
