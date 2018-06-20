<link rel="stylesheet" type="text/css" href="{{ asset('css/cssgrid.css') }}">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@extends('layouts.app')

@section('content')
<div class="icon-bar">
    <div class="left">
        <button id="toggle-button">
            <img id="map-image" src="images/Map-view.png">
            <img id="list-image" src="images/List-view-active.png">
        </button>
    </div>
    <div class="right">
        <img id="search-icon" src="/images/Search-icon.png">
        <img id="filter-icon" src="/images/Filter-icon.png">
    </div>
</div>
    <a href="/melding/create">
    <button class="round">
        <img src="../images/plus.png" class="rotate-button"/>
    </button>
</a>
<div class="pages current_page" id="page1">
<div class="tickets" >
    <div class="grid_container current_page">
        <div class="grid_header">
            <div class="tickets open_tickets">Openstaande meldingen</div>
            <div class="result_amount">Totaal aantal: {{$unfinishedtickets->count()}}</div>
        </div>
        <div class="grid_main">

                <div class="panel-body">
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
                </div>

            @foreach($unfinishedtickets as $unfinishedticket)
                    @foreach($animals as $animal)
                        @if($unfinishedticket->animal_id == $animal->id)
                        <a href="{{ route('melding.edit', $unfinishedticket->id) }}">
                            <div class="grid_ticket flag-new">
                            <div class="test">
                            </div>
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
                            <textarea wrap="soft" rows="3" readonly class="ticket_description">{{str_limit($animal->description, 75)}}</textarea>
                        </div>
                    </a>
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
                                    @foreach($destination_array as $destination)
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
<script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>


@endsection
@endsection
