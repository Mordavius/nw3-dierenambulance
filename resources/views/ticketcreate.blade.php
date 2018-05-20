<link rel="stylesheet" type="text/css" href="{{ asset('css/ticketcreate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">

@extends('layouts.app')

@section('content')
<div class="grid_container">

    <div class="icon_bar">
        <div class="reporter">
            <div class="circle highlighted">
                    <p class="test">1</p>
            </div>
            Melder
        </div>
        <div class="location">
            <div class="circle">
                <div class="circle_letter">
                    2
                </div>
            </div>
            <p>Locatie</p>
        </div>
        <div class="animal">
            <div class="circle">
                <div class="circle_letter">
                    3
                </div>
            </div>
            <p>Dier</p>
        </div>
        <div class="priority">
            <div class="circle">
                <div class="circle_letter">
                    4
                </div>
            </div>
            <p>Prioriteit</p>
        </div>
        <div class="summary">
            <div class="circle">
                <div class="circle_letter">
                    5
                </div>
            </div>
            <p>Overzicht</p>
        </div>
    </div>
</div>
<div class="main">
    {!! Form::model($ticket, [
        'method' => 'POST',
        'route' => 'melding.store'
    ]) !!}
    <div class="page1" id="page1" style="display: block;">
        <div class="name">
            <input type="text" class="ticket_text_field" placeholder="Naam" name="reporter_name">
            <div class="line">
            </div>
        </div>
        <br />
        <div class="phone_number">
            <input type="text" class="ticket_text_field" placeholder="Telefoonnummer" name="telephone">
            <div class="line">
            </div>
        </div>
    </div>
    <div class="page2" id="page2" style="display: none;">
        test
    </div>
    <div class="page3" id="page3" style="display: none;">
        Other test
    </div>
</div>
<div class="save_button" style="display: none;">

{!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

</div>
<div class="footer">
    <button onclick="next()" id="footer_button">Volgende ></button>

</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/ticketcreate.js') }}"></script>

@endsection
