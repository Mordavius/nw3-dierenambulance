@extends('layouts.app')
@section('body_class', 'ticketcreate')
@section('content')

<div class="grid_container">
    <div class="icon_bar">
        <div class="icon_bar_item reporter">
            <div class="circle highlighted" id="circle1">
              <a href="#page1" class="circle_letter">
                  1
              </a>
            </div>
            <span id="span1" class="span">Melder</span>
        </div>
        <span id="divider1" class="divider"></span>
        <div class="icon_bar_item location">
            <div class="circle" id="circle2">
              <a href="#page2" class="circle_letter">
                  2
              </a>
            </div>
            <span id="span2" class="span">Locatie</span>
        </div>
        <span id="divider2" class="divider"></span>
        <div class="icon_bar_item animal">
            <div class="circle" id="circle3">
                <a href="#page3" class="circle_letter">
                    3
                </a>
            </div>
            <span id="span3" class="span">Dier</span>
        </div>
        <span id="divider3" class="divider"></span>
        <div class="icon_bar_item priority">
            <div class="circle" id="circle4">
                <a href="#page4" class="circle_letter">
                    4
                </a>
            </div>
            <span id="span4" class="span">Prioriteit</span>
        </div>
        <span id="divider4" class="divider"></span>
        <div class="icon_bar_item summary">
            <div class="circle" id="circle5">
                <a href="#page5" class="circle_letter">
                    5
                </a>
            </div>
            <span id="span5" class="span">Overzicht</span>
        </div>
    </div>
</div>
<div class="main">
    <div class="pages current_page" id="page1">
        <div class="page">
            <div class="title_page">
                <h1>Melder</h1>
            </div>
            <div class="alert-danger name" style="display:none"></div>
            <div class="reporter_info">
                <div class="name">
                    <input type="text" id="name_text_field" class="ticket_text_field" placeholder="Naam" name="reporter_name">
                </div>
                <div class="phone_number">
                    <input type="text" id="number_text_field" class="ticket_text_field" placeholder="Telefoonnummer" name="telephone">
                </div>
            </div>
            <p class="boodschap">Vergeet niet te melden dat de gegevens van de melder worden opgeslagen</p>
        </div>
    </div>
    <div class="pages" id="page2">
        <div class="page">
            <div class="title_page">
                <h1>Locatie</h1>
            </div>
            <div class="searchStuff">
                <input id="searchTextBox" type="text" placeholder="Zoeken"/>
                <select id="knownAddress">
                    <option value="test1">Eerste</option>
                    <option value="test2">Tweede</option>
                </select>
                <button id="searchButton" class="btn-succes">
                    Ga
                </button>
            </div>
            <input type="button" id="sendLocationButton" class="btn btn-success">
            <div id="app" ng-app="app">
                <div ng-controller="TableController" >
                    <div id="map" class="panel panel-default panel-success">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pages" id="page3">
        <div class="page">
            <div class="title_page">
                <h1>Dier</h1>
            </div>
            <div class="animal_page">
                <div class="animal_cards" id="animal_cards">
                    <div class="animal_card" onclick="selectAnimalSpieces('Hond', 'images/Hond.svg');">
                        <img src="{{asset('images/Hond.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Hond</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Kat', 'images/Kat.svg');">
                      <img src="{{asset('images/Kat.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Kat</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Vogel', 'images/Vogel.svg');">
                      <img src="{{asset('images/Vogel.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Vogel</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Egel', 'images/Egel.svg');">
                      <img src="{{asset('images/Egel.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Egel</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Konijn', 'images/Konijn.svg');">
                      <img src="{{asset('images/Konijn.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Konijn</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Anders', 'images/Anders.svg');">
                      <img src="{{asset('images/Anders.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Anders</span>
                        </div>
                    </div>
                </div>
                <div class="selectedAnimal" id="selectedAnimal"><img id="image" src="" alt=""> <span id="selected_animal"></span></div>
                <div class="animal_info" id="animal_info">
                    <input type="text" class="ticket_text_field breed" placeholder="Ras" name="breed" id="breed_field"/>
                    <input type="text" class="ticket_text_field gender" placeholder="Geslacht" name="gender" id="gender_field"/>
                    <input type="text" class="ticket_text_field chip_number" placeholder="ID" name="chip_number" id="chip_number_field"/>
                    <input type="text" class="ticket_text_field injury" placeholder="Verwondingen" name="injury" id="injury_field"/>
                    <textarea class="ticket_text_field description" placeholder="Opmerkingen" name="description" id="description_field"/></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="pages" id="page4">
        <div class="page">
            <div class="title_page">
                <h1>Prioriteit</h1>
            </div>
            </div>
            <div class="map_grid">
              <div ng-app="app">
                  <div ng-controller="TableController" >
                      <div id="map2" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
                      </div>
                  </div>
              </div>
              <div class="ticket_cards_grid">
                  <div class="new_ticket">
                      <div class="new_ticket_prio">
                          <input type="number" class="new_ticket_priority" name="priority_field" id="priority_field" placeholder="-">
                      </div>
                      <div class="animal_main_info" id="animal_main_info">
                          <div class="animal_title" id="animal_title">
                          </div>
                          <p class="animal_breed" id="animal_breed">
                          </p>
                      </div>
                      <div class="destination_info" id="destination_info">
                      </div>
                  </div>
                  <div class="bus_name">
                      <h2 class="bus_name_title">Bus</h2>
                      <div class="bus_task_list">
                          @foreach($destinations as $destination)
                              <div class="ticket">
                                  @foreach($unfinishedtickets as $unfinishedticket)
                                      @if($unfinishedticket->id == $destination->ticket_id)
                                      <div class="ticket_priority">
                                          {{$unfinishedticket->priority}}
                                      </div>
                                      @foreach($animals as $animal)
                                      @if($unfinishedticket->animal_id == $animal->id)
                                              <div class="unfinishedtickets_animal_title">
                                                  {{$animal->animal_species}}
                                              </div>
                                              <div class="unfinishedtickets_animal_breed">
                                                  {{$animal->breed}}
                                              </div>
                                      @endif
                                      @endforeach
                                  <div class="ticket_address">
                                      {{$destination->address}}
                                      @if($destination->house_number != '0')
                                          {{$destination->house_number}}
                                      @endif
                                      ,
                                      {{$destination->postal_code}}
                                      {{$destination->city}}
                                  </div>
                                  @endif
                                  @endforeach
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
            </div>

    </div>
    <div class="pages" id="page5">
        <div class="page">
            <div class="title_page">
                <h1>Overzicht</h1>
            </div>
            {!! Form::model($ticket, [
                'method' => 'POST',
                'route' => 'melding.store',
                'id' => 'submit_form'
            ]) !!}
            <div class="new_ticket_information">
              <div class="left_info">
                <div ng-app="app">
                  <div ng-controller="TableController" >
                      <div id="map3" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
                      </div>
                  </div>
                </div>
                <label class="general">Algemeen</label>
                <div class="new_ticket_info">
                    <label class="general_labels centralist">Centralist:</label>
                    <input id="centralist" type="label" name="centralist" class="general_information centralist" value="{{ Auth::user()->name }}"></input>
                    <label class="general_labels date">Datum:</label>
                    <input type="label" name="date" class="general_information date" id="date" value="{{ Carbon::today()->format('Y-m-d') }}"></label>
                    <label class="general_labels time">Tijd</label>
                    <input name="time" type="label" class="general_information time" id="time" value="{{Carbon::now('Europe/Amsterdam')->toTimeString()}}" ></text>
                </div>
              </div>
              <div class="right_info">
                <div class="address_info_new_ticket">
                    <label class="location_label">Locatie</label>
                    <input type="label" class="address_info" placeholder="Straat" name="address" id="address"/>
                    <input type="label" class="address_info" placeholder="Huisnummer" name="house_number" id="house_number"/>
                    <input type="label" class="address_info" placeholder="Postcode" name="postal_code" id="postal_code"/>
                    <input type="label" class="address_info" placeholder="Stad" name="city" id="city"/>
                    <input type="hidden" class="address_info township" placeholder="Gemeente" name="township" id="township"/>
                    <input type="hidden" name="coordinates" id="coordinates"/>
                </div>
                <div class="reporter_new_ticket">
                    <label class="reporter_label">Melder</label>
                    <input type="text" id="reporter_name" class="ticket_text_field" placeholder="Naam" name="reporter_name"/>
                    <input type="text" id="phone_number" class="ticket_text_field" placeholder="Telefoonnummer" name="telephone"/>
                </div>
                <div class="animal_new_ticket">
                    <label class="reporter_label">Dier</label>
                    <div class="animal_info_new_ticket" id="animal_info">
                        <input class="ticket_text_field" id="animal_species" type="text" name="animal_species" placeholder="Soort"/>
                        <input type="text" class="ticket_text_field breed" placeholder="Ras" name="breed" id="breed"/>
                        <input type="text" class="ticket_text_field gender" placeholder="Geslacht" name="gender" id="gender"/>
                        <input type="text" class="ticket_text_field chip_number" placeholder="ID" name="chip_number" id="chip_number"/>
                        <input type="text" class="ticket_text_field injury" placeholder="Verwondingen" name="injury" id="injury"/>
                        <textarea rows="4" wrap="soft" class="ticket_text_field description" placeholder="Opmerkingen" name="description" id="description"/></textarea>
                    </div>
                </div>
                <div class="priority_new_ticket">
                    <label class="priority_label">Prioriteit</label>
                    <div class="form-group {{ $errors->has('vehicle') ? 'has-error' : '' }}">
                        {!! Form::label('Selecteer het voertuig') !!} <br />
                        <select name="vehicle" id="vehicle">
                            @foreach($bus as $buses)
                                <option value="{{$buses}}">{{$buses}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('vehicle'))
                            <span class="help-block">
                                {{ $errors->first('vehicle') }}
                            </span>
                        @endif
                    </div>
                    <input type="hidden" id="milage" name="milage" value={{ $milage }}>
                    <input class="ticket_text_field" type="label" name="priority" id="priority"/>
                </div>
              </div>
            </div>
            <input class="footer_button_submit" type="button" id="footer_button_submit" name="" value="Opslaan">
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="footer" id="footer">
    <button id="footer_button_back" class="footer_button">< Vorige</button>
    <div class="address_info_grid">
        <span contenteditable="true" class="address_info" name="address" id="address_field"></span>
        <span contenteditable="true" class="address_info" name="house_number" id="house_number_field"></span>
        <span contenteditable="true" class="address_info" name="postal_code" id="postal_code_field"></span>
        <br>
        <span contenteditable="true" class="address_info" name="city_field" id="city_field"></span>
        <span contenteditable="true" class="address_info" name="township" id="township_field"></span>
            <!-- <input type="text" class="address_info" placeholder="Straat" name="address" id="address_field"/>
            <input type="text" class="address_info" placeholder="Huisnummer" name="house_number" id="house_number_field"/>
            <input type="text" class="address_info" placeholder="Postcode" name="postal_code" id="postal_code_field"/>
            <input type="text" class="address_info" placeholder="Stad" name="city" id="city_field"/>
            <input type="text" class="address_info township" placeholder="Gemeente" name="township" id="township_field"/> -->
            <input type="hidden" name="coordinates" id="coordinates_field"/>
        </div>
        <button id="footer_button_forward" class="footer_button">Volgende ></button>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet-gesture-handling.js') }}"></script>
<script type="text/javascript" src="{{asset('js/table-directive.js') }}"></script>
@endsection
