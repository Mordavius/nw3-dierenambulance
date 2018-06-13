<link rel="stylesheet" type="text/css" href="{{ asset('css/ticketcreate.css') }}">

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
            <span>Melder</span>

        </div>
        <span class="divider"></span>
        <div class="icon_bar_item location">
            <div class="circle" id="circle2">
              <a href="#page2" class="circle_letter">
                  2
              </a>
            </div>
            <span>Locatie</span>
        </div>
        <span class="divider"></span>
        <div class="icon_bar_item animal">
            <div class="circle" id="circle3">
                <a href="#page3" class="circle_letter">
                    3
                </a>
            </div>
            <span>Dier</span>
        </div>
        <span class="divider"></span>
        <div class="icon_bar_item priority">
            <div class="circle" id="circle4">
                <a href="#page4" class="circle_letter">
                    4
                </a>
            </div>
            <span>Prioriteit</span>
        </div>
        <span class="divider"></span>
        <div class="icon_bar_item summary">
            <div class="circle" id="circle5">
                <a href="#page5" class="circle_letter">
                    5
                </a>
            </div>
            <span>Overzicht</span>
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
                <label for="eigenaar"><input type="checkbox" name="eigenaar" value="eigenaar">Melder is eigenaar</label>
                <span></span>
                <p class="boodschap">Vergeet niet te melden dat de gegevens van de melder worden opgeslagen</p>
            </div>
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
                <button id="searchButton">
                    Ga
                </button>
            </div>
        </div>
        <div id="app" ng-app="app">
            <div ng-controller="TableController" >
                <div id="map" class="panel panel-default panel-success">
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
                    <div class="animal_card" onclick="selectAnimalSpieces('Hond');">
                        <img src="{{asset('images/hond.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Hond</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Kat');">
                      <img src="{{asset('images/kat.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Kat</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Vogel');">
                      <img src="{{asset('images/vogel.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Vogel</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Egel');">
                      <img src="{{asset('images/egel.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Egel</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Konijn');">
                      <img src="{{asset('images/konijn.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Konijn</span>
                        </div>
                    </div>
                    <div class="animal_card" onclick="selectAnimalSpieces('Anders');">
                      <img src="{{asset('images/dino.svg')}}" alt="">
                        <div class="animal_grid">
                            <span>Anders</span>
                        </div>
                    </div>
                </div>
                <div class="selectedAnimal" id="selectedAnimal"><p id="selected_animal"></p></div>
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
                    <div class="bus_name_title">
                         Bus
                    </div>

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
                <label class="general">Algemeen</label>
                <br />
                <div class="new_ticket_info">
                    <label class="general_labels centralist">Centralist:</label>
                    <input id="centralist" type="label" name="centralist" class="general_information centralist" value="{{ Auth::user()->name }}"></input>
                    <label class="general_labels date">Datum:</label>
                    <input type="label" name="date" class="general_information date" id="date" value="{{ Carbon::today()->format('Y-m-d') }}"></label>
                    <label class="general_labels time">Tijd</label>
                    <input name="time" type="label" class="general_information time" id="time" value="{{Carbon::now('Europe/Amsterdam')->toTimeString()}}" ></text>
                </div>

                <div class="address_info_new_ticket">
                <label class="location_label">Locatie</label>
                    <input type="label" class="address_info" placeholder="Straat" name="address" id="address"/>
                    <input type="label" class="address_info" placeholder="Huisnummer" name="house_number" id="house_number"/>
                    <input type="label" class="address_info" placeholder="Postcode" name="postal_code" id="postal_code"/>
                    <input type="label" class="address_info" placeholder="Stad" name="city" id="city"/>
                    <input type="hidden" class="address_info township" placeholder="Gemeente" name="township" id="township"/>
                    <input type="hidden" name="coordinates" id="coordinates"/>
                </div>
                <div class="line">
                </div>
                <div class="reporter_new_ticket">
                    <label class="reporter_label">Melder</label>
                    <input type="text" id="reporter_name" class="ticket_text_field" placeholder="Naam" name="reporter_name"/>
                    <div class="line">
                    </div>
                    <input type="text" id="phone_number" class="ticket_text_field" placeholder="Telefoonnummer" name="telephone"/>
                    <div class="line">
                    </div>
                </div>
                <div class="animal_new_ticket">
                    <label class="reporter_label">Dier</label>
                    <div class="animal_info_new_ticket" id="animal_info">
                        <input class="ticket_text_field" id="animal_species" type="text" name="animal_species"/>
                        <div class="line">
                        </div>
                        <input type="text" class="ticket_text_field breed" placeholder="Ras" name="breed" id="breed"/>
                        <div class="line">
                        </div>
                        <input type="text" class="ticket_text_field gender" placeholder="Geslacht" name="gender" id="gender"/>
                        <div class="line">
                        </div>
                        <input type="text" class="ticket_text_field chip_number" placeholder="ID" name="chip_number" id="chip_number"/>
                        <div class="line">
                        </div>
                        <input type="text" class="ticket_text_field injury" placeholder="Verwondingen" name="injury" id="injury"/>
                        <div class="line">
                        </div>
                        <textarea rows="4" wrap="soft" class="ticket_text_field description" placeholder="Opmerkingen" name="description" id="description"/></textarea>
                        <div class="line">
                        </div>
                    </div>
                </div>
                <div class="priority_new_ticket">
                    <label class="priority_label">Prioriteit</label>
                    <label class="ticket_text_field" class="bus">Sprinter</label>
                    <input class="ticket_text_field" type="label" name="priority" id="priority"/>
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
