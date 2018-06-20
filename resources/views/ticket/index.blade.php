@extends('layouts.app')
@section('body_class', 'ticket_page')
@section('content')
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
<a href="/melding/create">
    <button class="round">
        <img src="../images/plus.png" class="rotate-button"/>
    </button>
</a>
<div class="pages current_page" id="page1">
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  <div class="tickets ticket-wrapper" >
      <div class="grid_container current_page">
          <div class="grid_header">
              <div class="tickets open_tickets">Openstaande meldingen</div>
              <div class="result_amount">{{$unfinishedtickets->count()}} melding(en)</div>
          </div>
          <div class="grid_main">

                  <div class="form-group">
                      <input type="text" class="form-controller" id="search" name="search">
                  </div>
                  <table class="table table-bordered table-hover">
                      <thead>
                      <tr>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>

              @foreach($unfinishedtickets as $unfinishedticket)
                @foreach($animals as $animal)
                    @if($unfinishedticket->animal_id == $animal->id)
                    <a href="{{ route('melding.edit', $unfinishedticket->id) }}">
                    <div class="grid_ticket">
                        <div class="test">
                        </div>
                        <div class="ticket_number">
                            #{{ $unfinishedticket->id }}
                        </div>
                        <div class="grid_animal_icon">
                            <div class="ticket_icon">
                                <img src="/images/"{{$animal->animal_species}}".svg" id="animal_icon">
                            </div>
                        </div>
                        <div class="ticket_main_info">
                            <div class="ticket_title">{{$animal->animal_species}}</div>
                            <div class="ticket_address">
                                {{$destination_array}}
                                @foreach($destination_array as $destination)
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
                        <p class="ticket_description">{{str_limit($animal->description, 75)}}</p>
                    </div>
                    </a>
                    @endif
                @endforeach
              @endforeach
          </div>
      </div>
      <div class="grid_container">
          <div class="grid_header">
              <!-- <select id="times">
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
      </select> -->
              <div class="tickets closed_tickets">Afgeronde meldingen</div>
          </div>
          <div class="grid_main">
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
                                  <!-- <div class="ticket_icon">
                                      <img src="/images/hond-icon.png" id="animal_icon">
                                  </div> -->
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
                                        @foreach($unfinishedtickets as $unfinishedticket)
                                            <tr>@foreach($animals as $animal)
                                                    @if($unfinishedticket->id == $animal->ticket_id)
                                                        <td>{{ $animal->animal_species }}
                                                        <br />
                                                        {{ $animal->gender}}</td>
                                                        <td>{{ $animal->description }}</td>
                                                    @endif

                                                @endforeach
                                                @foreach($destinations as $destination)
                                                    @if($unfinishedticket->id == $destination->ticket_id)

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
                            @if (! $finishedtickets->count())
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
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/filter.js')}}"></script>


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
