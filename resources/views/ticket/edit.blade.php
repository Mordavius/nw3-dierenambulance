@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');
@section('content')
@section('body_class', 'edit_ticket')

<div class="edit-menu-balk">
    <div class="edit-menu-ticket container">
        <a href="../"><img src="{{asset('images/Close.svg')}}" alt=""></a>

        <div><h1>{{$ticket->animal->animal_species}}</h1> <h6>{{$ticket->animal->breed}}</h6></div>

        <button type="button" id="edit-save-btn" onclick="edit_ticket();" >
            <img src="{{asset('images/Check.svg')}}">
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
            Bus: {{ $ticket->bus->bus_type }}
        </div>

        <div class="edit-ticket-blok">
            <h2>Melder</h2>
            <div class="form-group {{ $errors->has('reporter_name') ? 'has-error' : '' }}">
                {!! Form::text('reporter_name', null, ['placeholder'=> 'Melder']) !!}
            </div>
            <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                {!! Form::text('telephone', null, ['placeholder' => 'Telefoonnummer']) !!}

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
            @foreach ($ticket->destinations as $loaddestinations)
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
                    <img src="{{asset('images/Delete.svg')}}" alt="Verwijderen" class="delete-dest">
                </button>

            </div>
            @endif
            @endforeach

            <div class="btn-center">
                {!! Form::button('Extra locatie', ['class' => 'btn-success btn-add-payment', 'value' => 'btn-add-destination', 'id' => 'btn-add-destination', 'name' => 'btn-add-destination']) !!}
            </div>
        </div>
        <div class="edit-ticket-blok">
            <h2>Dier</h2>
            <input type="text" name="animal_species" value="{{$ticket->animal->animal_species}}" placeholder="Dier"> {{-- TODO: hier een dropdown van maken me de juiste opties --}}
            <input type="text" name="breed" value="{{$ticket->animal->breed}}" placeholder="Ras">
            <input type="text" name="gender" value="{{$ticket->animal->gender}}" placeholder="Geslacht">
            <input type="text" name="injury" value="{{$ticket->animal->injury}}" placeholder="Verwonding">
            <textarea name="description" placeholder="Beschrijving">{{$ticket->animal->description}}</textarea>
        </div>

        <div class="edit-ticket-blok">
          <h2>Eigenaar</h2>
            @if($ticket->owner)
                {!! Form::label('owner-animal', 'Melder is ook eigenaar van het dier') !!}
                <input type="checkbox" id="animalowner"  onclick="animalOwner()"><br /><br />
                <input name="owner_name" id="owner_name" type="text" value="{{$ticket->owner->name}}" placeholder="Naam">
                <input name="owner_telephone_number" id="owner_telephone_number" type="text" value="{{$ticket->owner->telephone_number}}" placeholder="Telefoonnummer">
                <input name="owner_address" type="text" value="{{$ticket->owner->owner_address}}" placeholder="Adres">
                <input name="owner_house_number" type="text" value="{{$ticket->owner->owner_house_number}}" placeholder="Huisnummer">
                <input name="owner_postal_code" type="text" value="{{$ticket->owner->owner_postal_code}}" placeholder="Postcode">
                <input name="owner_city" type="text" value="{{$ticket->owner->owner_city}}" placeholder="Plaatsnaam">
                <input name="owner_township" type="text" value="{{$ticket->owner->owner_township}}" placeholder="Gemeente">
            @endif
      </div>

        <div class="edit-ticket-blok financien">
            <div class="factuur-wrap">
                <h2>Financiën</h2>

                <h6> Factuur </h6>
                @if($ticket->payment_invoice)
                <div class="factuur-card">
                    <span> €{{$ticket->payment_invoice}} </span>

                    @if ($ticket->payment_method == "Contant")
                    <img src="/images/cash-multiple-dark.svg" class="icon">
                    <img src="/images/credit-card-light.svg" class="icon">
                    @else
                    <img src="/images/cash-multiple-light.svg" class="icon">
                    <img src="/images/credit-card-dark.svg" class="icon">
                    @endif

                    <button id="delete" name="delete" data-toggle="delete" class="delete-task-payment" value="{{$ticket->id}}">
                        <img src="/images/close-red.svg">
                    </button>
                </div>
                @else
                <span class="italic"> Geen factuur gevonden </span>
                @endif
            </div>

            <div class="gift-wrap">
                <h6> Gift </h6>

                @if($ticket->payment_gift)
                <div class="gift-card">

                    <span> €{{$ticket->payment_gift}} </span>

                    @if ($ticket->payment_method == "Contant")
                    <img src="/images/cash-multiple-dark.svg" class="icon">
                    <img src="/images/credit-card-light.svg" class="icon">
                    @else
                    <img src="/images/cash-multiple-light.svg" class="icon">
                    <img src="/images/credit-card-dark.svg" class="icon">
                    @endif

                    <button id="delete" name="delete" data-toggle="delete" class="delete-task-payment" value="{{$ticket->id}}">
                        <img src="/images/close-red.svg">
                    </button>

                </div>
                @else
                <span class="italic"> Geen gift gevonden </span>
                @endif
            </div>
            <div class="btn-center">
                {!! Form::button('Wijzig betaling', ['class' => 'btn-success btn-add-payment', 'value' => 'btn-add-payment', 'id' => 'btn-add-payment', 'name' => 'btn-add-payment']) !!}
            </div>
                {!! Form::close() !!}
            {!!Form::open(['route' => ['ticket.finish', $ticket->id], 'class' => 'btn-center'])!!}
                {{Form::submit('Afronden',['class' => 'btn-success btn-success'])}}
            {!!Form::close()!!}
        </div>

        <!-- Modal (Pop up when detail destinations button clicked) -->
        <div class="modal fade" id="destination_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content-ticket">
                    <div class="modal-header-ticket">
                        <h2 class="modal-title" id="myModalLabel">Bestemming toevoegen</h2>
                        <button type="button" class="close-model" data-dismiss="modal" aria-label="Close">
                              <img src="{{asset('images/close-black.svg')}}">
                        </button>
                    </div>
                    <div class="modal-body" id="messages">

                        <div class="alert alert-danger destination" style="display:none"></div>
<form>
                        <div class="form-group {{ $errors->has('known') ? 'has-error' : '' }}">
                            <select required name="users" id="knownAddress">
                                <option value="" selected class="selected">Bekend adres</option>
                                @foreach($known_addresses as $known_addresse)
                                <option value="{{$known_addresse->id}}">{{$known_addresse->location_name}}</option>
                                @endforeach
                                @foreach($known_users as $known_user)
                                    <option value="{{$known_user->name}}">{{$known_user->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('known'))
                            <span class="help-block">
                                {{ $errors->first('known') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                            {!! Form::text('postal_code',  false , ['id' => 'postal_code', 'placeholder' => 'Postcode']) !!}
                            @if($errors->has('postal_code'))
                            <span class="help-block">
                                {{ $errors->first('postal_code') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            {!! Form::text('address', null, ['id'=> 'address', 'value' => '' , 'placeholder' => 'Straatnaam']) !!}
                            @if($errors->has('address'))
                            <span class="help-block">
                                {{ $errors->first('address') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('house_number') ? 'has-error' : '' }}">
                            {!! Form::text('house_number', null, ['id' => 'house_number', 'value' => '', 'placeholder' => 'Huisnummer']) !!}
                            @if($errors->has('house_number'))
                            <span class="help-block">
                                {{ $errors->first('house_number') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            {!! Form::text('city', null, ['id' => 'city', 'value' => '', 'placeholder' => 'Plaatsnaam']) !!}
                            @if($errors->has('city'))
                            <span class="help-block">
                                {{ $errors->first('city') }}
                            </span>
                            @endif
                        </div>
                            <div class="form-group {{ $errors->has('township') ? 'has-error' : '' }}">
                                {!! Form::text('township', null, ['id' => 'township', 'value' => '', 'placeholder' => 'Gemeente']) !!}
                                @if($errors->has('township'))
                                    <span class="help-block">
                                        {{ $errors->first('township') }}
                                    </span>
                                @endif
                            </div>
                        <div class="form-group">
                            {!! Form::label('Voertuig') !!} <br />
                            <div class="form-control" id="vehicle">{{$ticket->bus->bus_type}}</div>
                        </div>

                        <div class="form-group {{ $errors->has('milage') ? 'has-error' : '' }}">
                            {!! Form::number('milage', null, ['id' => 'milage', 'value' => '', 'placeholder' => 'Kilometer op locatie']) !!}
                            @if($errors->has('milage'))
                            <span class="help-block">
                                {{ $errors->first('milage') }}
                            </span>
                            @endif
                        </div>

                        <div class="alert-success" style="display:none"></div>
</form>
                    </div>
                    <div class="modal-footer-ticket model-center">
                        <button type="button" class="btn-success" id="btn-save" name="btn-save" value="add">Opslaan</button>
                        <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket->id }}>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal (Pop up when for adding a owner button clicked) -->
        <div class="modal fade" id="myModal-owner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content-ticket">
                    <div class="modal-header-ticket">
                        <h2 class="modal-title" id="myModalLabel">Eigenaar toevoegen</h2>
                        <button type="button" class="close-model" data-dismiss="modal" aria-label="Close">
                            <img src="{{asset('images/close-black.svg')}}">
                        </button>
                    </div>
                    <div class="modal-body">
<form>
                        <div class="alert alert-danger owner" style="display:none"></div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {!! Form::text('name',  false , ['id' => 'name', 'placeholder' => 'Naam']) !!}
                            @if($errors->has('name'))
                                <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('telephone_number') ? 'has-error' : '' }}">
                            {!! Form::text('telephone_number',  false , ['id' => 'telephone_number', 'placeholder' => 'Telefoonnummer']) !!}
                            @if($errors->has('telephone_number'))
                                <span class="help-block">
                                {{ $errors->first('telephone_number') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('owner_postal_code') ? 'has-error' : '' }}">
                            {!! Form::text('owner_postal_code',  false , ['id' => 'owner_postal_code', 'placeholder' => 'Postcode']) !!}
                            @if($errors->has('owner_postal_code'))
                                <span class="help-block">
                                {{ $errors->first('owner_postal_code') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('owner_address') ? 'has-error' : '' }}">
                            {!! Form::text('owner_address', null, ['id'=> 'owner_address', 'value' => '' , 'placeholder' => 'Straatnaam']) !!}
                            @if($errors->has('owner_address'))
                                <span class="help-block">
                                {{ $errors->first('owner_address') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('owner_house_number') ? 'has-error' : '' }}">
                            {!! Form::text('owner_house_number', null, ['id' => 'owner_house_number', 'value' => '', 'placeholder' => 'Huisnummer']) !!}
                            @if($errors->has('owner_house_number'))
                                <span class="help-block">
                                {{ $errors->first('owner_house_number') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('owner_city') ? 'has-error' : '' }}">
                            {!! Form::text('owner_city', null, ['id' => 'owner_city', 'value' => '', 'placeholder' => 'Plaatsnaam']) !!}
                            @if($errors->has('owner_city'))
                                <span class="help-block">
                                {{ $errors->first('owner_city') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('owner_township') ? 'has-error' : '' }}">
                            {!! Form::text('owner_township', null, ['id' => 'owner_township', 'value' => '', 'placeholder' => 'Gemeente']) !!}
                            @if($errors->has('owner_township'))
                                <span class="help-block">
                                        {{ $errors->first('owner_township') }}
                                    </span>
                            @endif
                        </div>
</form>
                    </div>
                    <div class="modal-footer-ticket model-center">
                        <button type="button" class="btn-success" id="btn-save-owner" name="btn-save-owner" value="add">Opslaan</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                        <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket->id }}>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal (Pop up when factuur button clicked) -->
        <div class="modal fade" id="myModal-payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content-ticket">
                    <div class="modal-header-ticket">
                        <h2 class="modal-title" id="myModalLabel">Betaling toevoegen</h2>
                        <button type="button" class="close-model" data-dismiss="modal" aria-label="Close">
                            <img src="{{asset('images/close-black.svg')}}">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger payment" style="display:none"></div>
                        <div class="form-group {{ $errors->has('payment_invoice') ? 'has-error' : '' }}">
                            {!! Form::number('payment_invoice', null, ['id' => 'payment_invoice', 'value' => '', 'placeholder' => 'Factuur bedrag']) !!}
                            @if($errors->has('payment_invoice'))
                                <span class="help-block">
                        {{ $errors->first('payment_invoice') }}

                    </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('payment_gifts') ? 'has-error' : '' }}">
                            {!! Form::number('payment_gifts', null, ['id' => 'payment_gifts', 'value' => '', 'placeholder' => 'Gift bedrag']) !!}
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
                    <div class="modal-footer-ticket model-center">
                        <button type="button" class="btn-success" id="btn-save-payment" name="btn-save-payment" value="add">Opslaan</button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                        <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket->id }}>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@section('scripts')
<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/ajax-destinations.js')}}"></script>
<script src="{{asset('js/table-directive.js')}}"></script>
<script src="{{asset('js/edit-ticket.js')}}"></script>
@endsection
