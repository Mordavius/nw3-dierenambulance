@extends('layouts.appambulance')
@section('body_class', 'ticket_ambulance')
@section('content')
<div class="pages current_page" id="page1">
  <div class="tickets ticket-wrapper" >
      <div class="grid_container current_page">
          <div class="grid_header">
              <div class="tickets open_tickets"><h2>Openstaande meldingen</h2></div>
              <div class="result_amount"><span id="number_results">{{$unfinishedtickets->count()}}</span><span> melding(en)</span></div>
              @if(session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
          </div>
          <div class="grid_main" id="unfinished">
              @foreach($unfinishedtickets as $unfinishedticket)
                  <a href="{{ route('melding.edit', $unfinishedticket->id) }}">
                    @if (count($unfinishedtickets) < 2)
                      <article class="grid_ticket single">
                    @else
                      <article class="grid_ticket">
                    @endif
                          <div class="test">
                          </div>
                          <div class="ticket_number">
                              #{{ $unfinishedticket->id }}
                          </div>
                          <div class="grid_animal_icon">
                              <div class="ticket_icon">
                                  <img src="/images/{{$unfinishedticket->animal['animal_species']}}.svg" id="animal_icon">
                              </div>
                          </div>
                          <div class="ticket_main_info">
                              <div class="ticket_title">
                                <h3>{{$unfinishedticket->animal['animal_species']}}</h3>
                                <span class="subheading">{{$unfinishedticket->animal['breed']}}</span>
                              </div>
                              <div class="ticket_address">
                                <span>
                                  {{$unfinishedticket->mainDestination()['address']}}
                                  @if($unfinishedticket->mainDestination()['house_number'] != '0')
                                      {{$unfinishedticket->mainDestination()['house_number']}}
                                  @endif
                                  ,<br>
                                  {{$unfinishedticket->mainDestination()['postal_code']}}
                                  {{$unfinishedticket->mainDestination()['city']}}
                                </span>
                              </div>
                          </div>
                          <p class="ticket_description">{{$unfinishedticket->animal['description']}}</p>
                      </article>
                  </a>
              @endforeach
          </div>
      </div>
      <div class="grid_container">
          <div class="grid_main" id="rest_tickets">
              <div class="overlay_rest"></div>
              @foreach($finishedtickets as $finishedticket)
                  <a href="{{ route('melding.edit', $finishedticket->id) }}">
                  @if (count($finishedtickets) < 2)
                    <article class="grid_ticket single">
                  @else
                    <article class="grid_ticket">
                  @endif
                      <div class="test">
                      </div>
                      <div class="ticket_number">
                          #{{ $finishedticket->id }}
                      </div>
                      <div class="grid_animal_icon">
                          <div class="ticket_icon">
                              <img src="/images/{{$finishedticket->animal['animal_species']}}.svg" id="animal_icon">
                          </div>
                      </div>
                      <div class="ticket_main_info">
                          <div class="ticket_title">
                            <h3>{{$finishedticket->animal['animal_species']}}</h3>
                            <span class="subheading">{{$finishedticket->animal['breed']}}</span>
                          </div>
                          <div class="ticket_address">
                            <span>
                              {{$finishedticket->mainDestination()->address}}
                              @if($finishedticket->mainDestination()->house_number != '0')
                                  {{$finishedticket->mainDestination()->house_number}}
                              @endif
                              ,<br>
                              {{$finishedticket->mainDestination()->postal_code}}
                              {{$finishedticket->mainDestination()->city}}
                            </span>
                          </div>
                      </div>
                      <p class="ticket_description">
                          {{$finishedticket->animal['description']}}
                      </p>
                  </article>
                    <a/>
              @endforeach
          </div>
      </div>
  </div>
</div>
<div class="pages" id="page2">
    <div ng-app="app">
        <div ng-controller="TableController" >
            <div id="map" data-coordinates="{{ $coordinates }}" class="panel panel-default panel-success">
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>
<script type="text/javascript" src="{{asset('js/filter.js') }}"></script>
@endsection
@endsection
