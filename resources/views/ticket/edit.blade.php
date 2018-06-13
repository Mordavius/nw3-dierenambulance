@extends('layouts.app')
@section('content')

<div class="edit-menu">
  <a href="{{ url()->previous() }}"><img src="{{asset('images/close.svg')}}" alt=""></a>

    @foreach($animals as $animal)
      <div><h1>{{$animal->animal_species}}</h1> <h6>{{$animal->breed}}</h6></div>
      @endforeach

      <button type="button" id="edit-save-btn" onclick="edit_ticket();" >
          <img src="{{asset('images/check.svg')}}">
        </button>
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
                          <div class="edit-ticket-algemeen">
                            <h2> Algemeen </h2>
                            Centralist: {{ Auth::user()->name }}</br>
                            Datum: {{ Carbon::today()->format('Y-m-d') }}</br>
                            Tijd: {{ $ticket->time }}</br>
                          </div>


                          <div class="edit-ticket-melder">
                            <h2>Melder</h2>
                            <div class="form-group {{ $errors->has('reporter_name') ? 'has-error' : '' }}">
                                {!! Form::text('reporter_name', null, ['class' => 'form-control']) !!}
                                @if($errors->has('reporter_name'))
                                    <span class="help-block">
                                        {{ $errors->first('reporter_name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                {!! Form::text('telephone', null, ['class' => 'form-control']) !!}

                                @if($errors->has('telephone'))
                                    <span class="help-block">
                                        {{ $errors->first('telephone') }}
                                    </span>
                                @endif
                            </div>
                          </div>

                          <div class="edit-ticket-locatie">
                            <h2>Locatie</h2>
                              <!-- Table-to-load-the-destinations Part -->

                              <!-- Check if it is the first destination(Geen bg-color en prullenbak) else(bg-grey en prullenbak) -->
                              <div class="locatie-wrap">
                                @foreach ($loaddestination as $loaddestinations)
                                <table>
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
                                              <td>{{$loaddestinations->township}}</td>
                                            </tr>
                                            <tr>
                                              <td>{{$loaddestinations->verhicle}}</td>
                                            </tr>
                                            <tr>
                                              <td>{{$loaddestinations->milage}}</td>
                                            </tr>

                                  </table>
                                  @endforeach
                                  <button id="delete" name="delete" data-toggle="delete" class="btn-delete-location" value="{{$loaddestinations->id}}">
                                      <img src="https://nw3-dierenambulance.test/images/delete.svg" alt="Verwijderen" class="icon">
                                  </button>
                                </div>
                                <div class="btn-center">
                                  {!! Form::button('Extra locatie', ['class' => 'btn-add-location', 'value' => 'btn-add', 'id' => 'btn-add', 'name' => 'btn-add']) !!}
                                </div>
                          </div>
                          <div class="edit-ticket-dier">
                            <h2>Dier</h2>@foreach($animals as $animal)
                            <input type="text" value="{{$animal->animal_species}}">
                            <input type="text" value="{{$animal->breed}}">
                            <input type="text" value="{{$animal->gender}}">
                            <input type="text" value="{{$animal->injury}}">
                            <textarea>{{$animal->description}}</textarea>
                            @endforeach
                          </div>

                          <div class="edit-ticket-eigenaar">
                            <h2>Eigenaar</h2> <!-- Toevoegen van Melder is eigenaar-->
                            <input type="text" value="" placeholder="Naam">
                            <input type="text" value="" placeholder="Telefoonnummer">
                            <input type="text" value="" placeholder="Adres + Huisnummer">
                            <input type="text" value="" placeholder="Postcode">
                            <input type="text" value="" placeholder="Plaatsnaam">
                          </div>

                          <div class="edit-ticket-financien">
                            <div class="factuur-wrap">
                              <h2>financiën</h2>

                              <h6> Factuur </h6>
                              @if($ticket->invoice)
                              <div class="factuur-card">
                                <span> €{{$ticket->invoice}} </span>

                                @if ($ticket->payment_method_invoice == "Contant")
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

                              @if($ticket->gift)
                                <div class="gift-card">

                                  <span> €{{$ticket->gift}} </span>

                                  @if ($ticket->payment_method_gift == "Contant")
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

                              </div>
                          </div>
                          <div class="btn-center">
                            {!! Form::button('Extra betaling', ['class' => 'btn-add-payment', 'value' => 'btn-add-payment', 'id' => 'btn-add-payment', 'name' => 'btn-add-payment']) !!}
                          </div>
                          {!! Form::close() !!}

                            <!-- Modal (Pop up when detail destinations button clicked) -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Bestemming toevoegen</h4>
                                        </div>
                                        <div class="modal-body" id="messages">

                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <div class="alert-danger" style="display:none"></div>

                                            <div class="form-group {{ $errors->has('known') ? 'has-error' : '' }}">
                                                <label>Bekende adressen</label>
                                                <select name="users" id="knownAddress">
                                                    @foreach($known as $knownAddress)
                                                        <option value="{{$knownAddress->id}}">{{$knownAddress->location_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('known'))
                                                    <span class="help-block">
                                                    {{ $errors->first('known') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                                                {!! Form::label('Postcode') !!}
                                                {!! Form::text('postal_code',  false , ['class' => 'form-control', 'id' => 'postal_code']) !!}
                                                @if($errors->has('postal_code'))
                                                    <span class="help-block">
                                                    {{ $errors->first('postal_code') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('house_number') ? 'has-error' : '' }}">
                                                {!! Form::label('Huisnummer') !!}
                                                {!! Form::text('house_number', null, ['class' => 'form-control', 'id' => 'house_number', 'value' => '']) !!}
                                                @if($errors->has('house_number'))
                                                    <span class="help-block">
                                                    {{ $errors->first('house_number') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                {!! Form::label('Straatnaam') !!}
                                                {!! Form::text('address', null, ['class' => 'form-control', 'id'=> 'address', 'value' => '']) !!}
                                                @if($errors->has('address'))
                                                    <span class="help-block">
                                                    {{ $errors->first('address') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                {!! Form::label('Plaats') !!}
                                                {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'value' => '']) !!}
                                                @if($errors->has('city'))
                                                    <span class="help-block">
                                                    {{ $errors->first('city') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('township') ? 'has-error' : '' }}">
                                                {!! Form::label('Gemeente') !!}
                                                {!! Form::text('township', null, ['class' => 'form-control', 'id' => 'township', 'value' => '']) !!}
                                                @if($errors->has('township'))
                                                    <span class="help-block">
                                                    {{ $errors->first('township') }}
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('verhicle') ? 'has-error' : '' }}">
                                                {!! Form::label('Voertuig') !!} <br />
                                                <select name="verhicle" id="verhicle">
                                                    @foreach($bus as $buses)
                                                        <option value="{{$buses}}">{{$buses}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('verhicle'))
                                                    <span class="help-block">
                                                        {{ $errors->first('verhicle') }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('milage') ? 'has-error' : '' }}">
                                                {!! Form::label('Kilometer op locatie') !!}
                                                {!! Form::text('milage', null, ['class' => 'form-control', 'id' => 'milage', 'value' => '']) !!}
                                                @if($errors->has('milage'))
                                                    <span class="help-block">
                                                    {{ $errors->first('milage') }}
                                                </span>
                                                @endif
                                            </div>

                                            <div class="alert-success" style="display:none"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Sluit</span></button>
                                            <button type="button" class="btn btn-primary" id="btn-save" name="btn-save" value="add">Opslaan</button>
                                            <input type="hidden" id="task_id" name="task_id" value="0">
                                            <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal (Pop up when detail destinations button clicked) -->
                            <div class="modal fade" id="myModal-payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Betaling toevoegen</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="alert alert-danger" style="display:none"></div>

                                            Financien
                                            <div class="form-group {{ $errors->has('payment_invoice') ? 'has-error' : '' }}">
                                                {!! Form::label('Factuur') !!}
                                                {!! Form::text('payment_invoice', null, ['class' => 'form-control', 'id' => 'payment_invoice', 'value' => '']) !!}
                                                @if($errors->has('payment_invoice'))
                                                    <span class="help-block">
                                                {{ $errors->first('payment_invoice') }}
                                            </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('payment_gifts') ? 'has-error' : '' }}">
                                                {!! Form::label('Giften') !!}
                                                {!! Form::text('payment_gifts', null, ['class' => 'form-control', 'id' => 'payment_gifts', 'value' => '']) !!}
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
                                        <div class="modal-footer">
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

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/angular.min.js')}}"></script>
<script src="{{asset('js/ajax-destinations.js')}}"></script>
<script src="{{asset('js/edit-ticket.js')}}"></script>


@endsection
