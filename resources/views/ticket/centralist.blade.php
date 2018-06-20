@extends('layouts.app')
@section('body_class', 'ticket_centralist')
@section('content')
<div class="icon-bar">
    <div class="left">
        <button id="toggle-button">
            <img id="map-image" src="images/map-view.png"></img>
            <img id="list-image" src="images/list-view-active.png"></img>
        </button>
    </div>
    <div class="right">
        <img id="search-icon" src="/images/search-icon.png">
        <img id="filter-icon" src="/images/filter-icon.png">
    </div>
</div>
<a href="/melding/create">
    <button class="round">
        <img src="../images/plus.png" class="rotate-button"/>
    </button>
</a>
<div class="head">
  <div class="left">
      <h1>Meldingen</h1>
  </div>
  <div class="right">
    <button id="toggle-button-desktop">
      <img id="map-image-desktop" src="images/map-view.png">
      <img id="list-image-desktop" src="images/list-view-active.png">
    </button>
      <input type="text" class="search_field" id="search" name="search" placeholder="Zoeken..">
  </div>
  <div class="filters">
    <input type="date" name="date" value="" id="date">
    <input type="text" name="animal_species" value="" id="animal_species">
    <input type="text" name="location" value="" id="location">
    <input class="btn btn-success" type="submit" name="submit" value="Filteren" onclick="filterTickets()">
    <input class="btn btn-success" type="submit" name="resetfilter" value="Reset filter" onclick="resetFilter()">
  </div>
</div>

<div class="pages current_page" id="page1">
  <div class="tickets ticket-wrapper" >
      <div class="grid_container current_page">
          <div class="grid_header">
              <div class="tickets open_tickets"><h2>Openstaande meldingen</h2></div>
              <div class="result_amount"><span>{{$unfinishedtickets->count()}} melding(en)</span></div>
              @if(session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
          </div>
          <div class="grid_main" id="unfinished">
              @foreach($unfinishedtickets as $unfinishedticket)
                      @foreach($animals as $animal)
                          @if($unfinishedticket->animal_id == $animal->id)
                          <a href="{{ route('melding.edit', $unfinishedticket->id) }}">
                          <article class="grid_ticket">
                              <div class="test">
                              </div>
                              <div class="ticket_number">
                                  #{{ $unfinishedticket->id }}
                              </div>
                              <div class="grid_animal_icon">
                                  <div class="ticket_icon">
                                      <img src="/images/{{$animal->animal_species}}.svg" id="animal_icon">
                                  </div>
                              </div>
                              <div class="ticket_main_info">
                                  <div class="ticket_title">
                                    <h3>{{$animal->animal_species}}</h3>
                                    <span class="subheading">{{$animal->breed}}</span>
                                  </div>
                                  <div class="ticket_address">
                                    <span>
                                      @foreach($destination_array as $destination)
                                          @if($destination['ticket_id'] == $unfinishedticket->id)
                                              {{$destination['address']}}
                                              @if($destination['house_number'] != '0')
                                                  {{$destination['house_number']}}
                                              @endif
                                              ,<br>
                                              {{$destination['postal_code']}}
                                              {{$destination['city']}}
                                          @endif
                                      @endforeach
                                    </span>
                                  </div>
                              </div>
                              <p class="ticket_description">{{str_limit($animal->description, 75)}}</p>
                          </article>
                      </a>
                          @endif
                      @endforeach
              @endforeach
          </div>
      </div>
      <div class="grid_container">
          <div class="grid_header">
              <div class="tickets closed_tickets"><h2>Afgeronde meldingen</h2></div>
          </div>
          <div class="grid_main" id="finished">
              @foreach($finishedtickets as $finishedticket)
                      @foreach($animals as $animal)
                          @if($finishedticket->animal_id == $animal->id)
                          <div class="grid_ticket">
                              <div class="test">
                              </div>
                              <div class="ticket_number">
                                  #{{ $finishedticket->id }}
                              </div>
                              <div class="grid_animal_icon">
                                  <div class="ticket_icon">
                                      <img src="/images/{{$animal->animal_species}}.svg" id="animal_icon">
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
</div>
<div class="pages" id="page2">
    <div ng-app="app">
        <div ng-controller="TableController" >
            <div id="map" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
            </div>
        </div>
    </div>
</div>

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


@section('scripts')
<script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>
<script type="text/javascript" src="{{asset('js/filter.js') }}"></script>
@endsection
@endsection
