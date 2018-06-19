@extends('layouts.app')
@section('content')
@section('body_class', 'edit_ticket')

<div class="edit-menu-balk">
    <div class="edit-menu-ticket container">
        <a href="../"><img src="{{asset('images/close.svg')}}" alt=""></a>

        @foreach($animals as $animal)
        <div><h1>{{$animal->animal_species}}</h1> <h6>{{$animal->breed}}</h6></div>
        @endforeach

        <button type="button" id="edit-save-btn" onclick="edit_ticket();" >
            <img src="{{asset('images/check.svg')}}">
        </button>
  </div>
</div>

<div class="container">
    {!! Form::model($ticket, [
        'method' => 'PUT',
        'route' => ['melding.update', $ticket->id],
        'id' => 'edit_ticket_form'
        ]) !!}
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <section class="content">
            <div class="edit-ticket-blok">
                <h2> Algemeen </h2>
                Centralist: {{ Auth::user()->name }}</br>
                Datum: {{ Carbon::today()->format('Y-m-d') }}</br>
                Tijd: {{ $ticket->time }}</br>
                Bus: {{ $ticket->vehicle }}
            </div>


            <div class="edit-ticket-blok">
                <h2>Melder</h2>
                <div class="form-group {{ $errors->has('reporter_name') ? 'has-error' : '' }}">
                    {!! Form::text('reporter_name', null, ['class' => 'form-control', 'placeholder'=> 'Melder']) !!}
                    @if($errors->has('reporter_name'))
                    <span class="help-block">
                        {{ $errors->first('reporter_name') }}
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                    {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'Telefoonnummer']) !!}

                    @if($errors->has('telephone'))
                    <span class="help-block">
                        {{ $errors->first('telephone') }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="edit-ticket-blok">
                <h2>Locatie</h2>
                <!-- Table-to-load-the-destinations Part -->

                <!-- Check if it is the first destination(Geen bg-color en prullenbak) else(bg-grey en prullenbak) -->
                @foreach ($loaddestination as $loaddestinations)
                @if ($loop->first)
                <div class="locatie-wrap">
                    <table>
                      <tr>
                          <th class="th">Melder locatie</th>
                      </tr>
                        <tr>
                            <td>{{$loaddestinations->address}} {{$loaddestinations->house_number}}</td>
                        </tr>
                        <tr>
                            <td>{{$loaddestinations->postal_code}}</td>
                        </tr>
                        <tr>
                            <td>{{$loaddestinations->city}}</td>
                        </tr>
                        <tr>
                            <td class="italic">({{$loaddestinations->milage}} km)</td>
                        </tr>
                    </table>
                </div>
                @endif
                @if ($loop->index)
                <div class="locatie-wrap grey">
                    <!-- Check welke bestemming het is en dat cijfer invullen Bestemming X -->
                    <table>
                        <tr>
                            <th class="th">Bestemming {{$loop->index}}</th>
                        </tr>
                        <tr>
                            <td>{{$loaddestinations->address}} {{$loaddestinations->house_number}}</td>
                        </tr>
                        <tr>
                            <td>{{$loaddestinations->postal_code}}</td>
                        </tr>
                        <tr>
                            <td>{{$loaddestinations->city}}</td>
                        </tr>
                        <tr>
                            <td class="italic">({{$loaddestinations->milage}} km)</td>
                        </tr>
                    </table>
                      <button id="delete" name="delete" data-toggle="delete" class="delete-task" value="{{$loaddestinations->id}}">
                        <img src="{{asset('images/delete.svg')}}" alt="Verwijderen" class="delete-dest">
                    </button>

                </div>
                @endif
                @endforeach

                <div class="btn-center">
                    {!! Form::button('Extra locatie', ['class' => 'btn-primary btn-add-payment', 'value' => 'btn-add-destination', 'id' => 'btn-add-destination', 'name' => 'btn-add-destination']) !!}
                </div>
            </div>
            <div class="edit-ticket-blok">
                <h2>Dier</h2>
                @foreach($animals as $animal)
                <input type="text" name="animal_species" value="{{$animal->animal_species}}" placeholder="Dier">
                <input type="text" name="breed" value="{{$animal->breed}}" placeholder="Ras">
                <input type="text" name="gender" value="{{$animal->gender}}" placeholder="Geslacht">
                <input type="text" name="injury" value="{{$animal->injury}}" placeholder="Verwonding">
                <textarea placeholder="Beschrijving">{{$animal->description}}</textarea>
                @endforeach
            </div>

            <div class="edit-ticket-blok">
                <h2>Eigenaar</h2> <!-- Toevoegen van Melder is eigenaar-->
                <input type="text" value="" placeholder="Naam">
                <input type="text" value="" placeholder="Telefoonnummer">
                <input type="text" value="" placeholder="Adres + Huisnummer">
                <input type="text" value="" placeholder="Postcode">
                <input type="text" value="" placeholder="Plaatsnaam">
            </div>

            <div class="edit-ticket-blok financien">
                <div class="factuur-wrap">
                    <h2>Financiën</h2>

                    <h6> Factuur </h6>
                    @if($ticket->payment_invoice)
                    <div class="factuur-card">
                        <span> €{{$ticket->payment_invoice}} </span>

                        @if ($ticket->payment_method == "Contant")
                        <img src="https://nw3-dierenambulance.test/images/cash-multiple-dark.svg" class="icon">
                        <img src="https://nw3-dierenambulance.test/images/credit-card-light.svg" class="icon">
                        @else
                        <img src="https://nw3-dierenambulance.test/images/cash-multiple-light.svg" class="icon">
                        <img src="https://nw3-dierenambulance.test/images/credit-card-dark.svg" class="icon">
                        @endif

                        <button id="delete" name="delete" data-toggle="delete" class="delete-task-payment" value="{{$ticket->id}}">
                            <img src="https://nw3-dierenambulance.test/images/close-red.svg">
                        </button>
                    </div>
                    @else
                    <span class="italic"> Geen factuur gevonden </span>
                    @endif
                </div>

                <div class="gift-wrap">
                    <h6> Gift </h6>

                    @if($ticket->payment_gifts)
                    <div class="gift-card">

                        <span> €{{$ticket->payment_gifts}} </span>

                        @if ($ticket->payment_method == "Gepint")
                        <img src="https://nw3-dierenambulance.test/images/cash-multiple-dark.svg" class="icon">
                        <img src="https://nw3-dierenambulance.test/images/credit-card-light.svg" class="icon">
                        @else
                        <img src="https://nw3-dierenambulance.test/images/cash-multiple-light.svg" class="icon">
                        <img src="https://nw3-dierenambulance.test/images/credit-card-dark.svg" class="icon">
                        @endif

                        <button id="delete" name="delete" data-toggle="delete" class="delete-task-payment" value="{{$ticket->id}}">
                            <img src="https://nw3-dierenambulance.test/images/close-red.svg">
                        </button>

                    </div>
                    @else
                    <span class="italic"> Geen gift gevonden </span>
                    @endif
                </div>
        <div class="btn-center">
            {!! Form::button('Extra betaling', ['class' => 'btn-primary btn-add-payment', 'value' => 'btn-add-payment', 'id' => 'btn-add-payment', 'name' => 'btn-add-payment']) !!}
        </div>
        {!! Form::close() !!}
        {!!Form::open(['route' => ['ticket.finish', $ticket->id], 'class' => 'pull-left'])!!}
            {{Form::submit('Afronden',['class' => 'btn btn-success'])}}
        {!!Form::close()!!}

        <!-- Modal (Pop up when detail destinations button clicked) -->
        <div class="modal fade" id="destination_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Bestemming toevoegen</h2>
                        <button type="button" class="close-model" data-dismiss="modal" aria-label="Close"><h2 aria-hidden="true">X</h2></button>
                    </div>
                    <div class="modal-body" id="messages">

                        <div class="alert alert-danger destination" style="display:none"></div>

                        <div class="form-group {{ $errors->has('known') ? 'has-error' : '' }}">
                            <select required name="users" id="knownAddress">
                                <option value="" selected class="selected">Bekend adres</option>
                                @foreach($known as $knownAddress)
                                <option value="{{$knownAddress->id}}">{{$knownAddress->location_name}}</option>
                                @endforeach
                                @foreach($knownUser as $knownUsers)
                                    <option value="{{$knownUsers->name}}">{{$knownUsers->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('known'))
                            <span class="help-block">
                                {{ $errors->first('known') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                            {!! Form::text('postal_code',  false , ['class' => 'form-control', 'id' => 'postal_code', 'placeholder' => 'Postcode']) !!}
                            @if($errors->has('postal_code'))
                            <span class="help-block">
                                {{ $errors->first('postal_code') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'address', 'value' => '' , 'placeholder' => 'Straatnaam']) !!}
                            @if($errors->has('address'))
                            <span class="help-block">
                                {{ $errors->first('address') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('house_number') ? 'has-error' : '' }}">
                            {!! Form::text('house_number', null, ['class' => 'form-control', 'id' => 'house_number', 'value' => '', 'placeholder' => 'Huisnummer']) !!}
                            @if($errors->has('house_number'))
                            <span class="help-block">
                                {{ $errors->first('house_number') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'value' => '', 'placeholder' => 'Plaatsnaam']) !!}
                            @if($errors->has('city'))
                            <span class="help-block">
                                {{ $errors->first('city') }}
                            </span>
                            @endif
                        </div>
                            <div class="form-group {{ $errors->has('township') ? 'has-error' : '' }}">
                                {!! Form::text('township', null, ['class' => 'form-control', 'id' => 'township', 'value' => '', 'placeholder' => 'Gemeente']) !!}
                                @if($errors->has('township'))
                                    <span class="help-block">
                                        {{ $errors->first('township') }}
                                    </span>
                                @endif
                            </div>
                        <div class="form-group {{ $errors->has('vehicle') ? 'has-error' : '' }}">
                            {!! Form::label('Voertuig') !!} <br />
                            {!! Form::text('vehicle', $vehicle->first(), ['class' => 'form-control', 'id' => 'vehicle', 'value' => '', 'placeholder' => 'Geen bus gekoppeld', 'disabled']) !!}
                            @if($errors->has('vehicle'))
                                <span class="help-block">
                                    {{ $errors->first('vehicle') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('milage') ? 'has-error' : '' }}">
                            {!! Form::number('milage', null, ['class' => 'form-control', 'id' => 'milage', 'value' => '', 'placeholder' => 'Kilometer op locatie']) !!}
                            @if($errors->has('milage'))
                            <span class="help-block">
                                {{ $errors->first('milage') }}
                            </span>
                            @endif
                        </div>

                        <div class="alert-success" style="display:none"></div>

                    </div>
                    <div class="modal-footer model-center">
                        <button type="button" class="btn btn-primary" id="btn-save" name="btn-save" value="add">Opslaan</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                        <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>



                    </div>
                </div>
            </div>
        </div>
        <!-- Modal (Pop up when factuur button clicked) -->
        <div class="modal fade" id="myModal-payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Betaling toevoegen</h2>
                        <button type="button" class="close-model" data-dismiss="modal" aria-label="Close"><h2 aria-hidden="true">X</h2></button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger payment" style="display:none"></div>
                        <div class="form-group {{ $errors->has('payment_invoice') ? 'has-error' : '' }}">
                            {!! Form::number('payment_invoice', null, ['class' => 'form-control', 'id' => 'payment_invoice', 'value' => '', 'placeholder' => 'Factuur bedrag']) !!}
                            @if($errors->has('payment_invoice'))
                            <span class="help-block">
                                {{ $errors->first('payment_invoice') }}

                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('payment_gifts') ? 'has-error' : '' }}">
                            {!! Form::number('payment_gifts', null, ['class' => 'form-control', 'id' => 'payment_gifts', 'value' => '', 'placeholder' => 'Gift bedrag']) !!}
                            @if($errors->has('payment_gifts'))
                            <span class="help-block">
                                {{ $errors->first('payment_gifts') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                            {!! Form::label('Betaalmethode') !!}
                            {!! Form::select('Betaalmethode', array('Gepint' => 'Gepint', 'Contant' => 'Contant'), 'default', array('id' => 'payment_method')); !!}
                            @if($errors->has('payment_method'))
                            <span class="help-block">
                                {{ $errors->first('payment_method') }}
                            </span>
                            @endif
                        </div>


                    </div>
                    <div class="modal-footer model-center">
                        <button type="button" class="btn btn-primary" id="btn-save-payment" name="btn-save-payment" value="add">Opslaan</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                        <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>


                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
</div>


@endsection
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/angular.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/ajax-destinations.js')}}"></script>
<script src="{{asset('js/table-directive.js')}}"></script>
<script src="{{asset('js/edit-ticket.js')}}"></script>
