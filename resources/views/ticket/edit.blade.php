@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card target">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    <a href="javascript:history.back()">
                        <div class="btn btn-primary">
                            Ga terug
                        </div>
                    </a>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content-wrapper">
                        <section class="content-header">
                            <h1>
                                Update een melding
                            </h1>
                        </section>
                        <section class="content">
                            {!! Form::submit('Voeg bestemming toe', ['class' => 'btn-primary', 'value' => 'btn-add', 'id' => 'btn-add', 'name' => 'btn-add']) !!}


                            <!-- Table-to-load-the-destinations Part -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Bestemmings<br />nummer</th>
                                    <th>Postcode</th>
                                    <th>Adres</th>
                                    <th>Plaats</th>
                                    <th>Gemeente</th>
                                    <th>Voertuig</th>
                                    <th>Kilometerstand</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tasks-list" name="tasks-list">
                                @foreach ($loaddestination as $loaddestinations)
                                    <tr id="task{{$loaddestinations->id}}">
                                        <td>{{$loaddestinations->id}}</td>
                                        <td>{{$loaddestinations->postal_code}}</td>
                                        <td>{{$loaddestinations->address}} {{$loaddestinations->house_number}}</td>
                                        <td>{{$loaddestinations->city}}</td>
                                        <td>{{$loaddestinations->township}}</td>
                                        <td>{{$loaddestinations->verhicle}}</td>
                                        <td>{{$loaddestinations->milage}}</td>
                                        <td>
                                            <button id="delete" name="delete" data-toggle="delete" class="btn btn-danger btn-xs btn-delete delete-task" value="{{$loaddestinations->id}}">Verwijder</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br /><br />
                                <!-- Table-to-load-the-destinations Part -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Factuur</th>
                                        <th>Gift</th>
                                        <th>Betaalmethode</th>
                                        <th>Acties</th>
                                    </tr>
                                    </thead>
                                    <tbody id="finance-list" name="finance-list">
                                    @foreach ($loadfinances as $loadfinance)
                                        <tr id="task">
                                            <td>{{$loadfinance->payment_invoice}}</td>
                                            <td>{{$loadfinance->payment_gifts}}</td>
                                            <td>{{$loadfinance->payment_method}}</td>
                                            <td>
                                                <button id="delete" name="delete" data-toggle="delete" class="btn btn-danger btn-xs btn-delete delete-task-payment" value="{{$loadfinance->id}}">Verwijder</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            {!! Form::submit('Voeg een betaling toe', ['class' => 'btn-primary', 'value' => 'btn-add-payment', 'id' => 'btn-add-payment', 'name' => 'btn-add-payment']) !!}

                                <!-- Table-to-load-the-destinations Part -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Naam</th>
                                        <th>Telefoonnmmer</th>
                                        <th>Adres</th>
                                        <th>Plaats</th>
                                        <th>Postcode</th>
                                        <th>Gemeente</th>
                                    </tr>
                                    </thead>
                                    <tbody id="owner-list" name="owner-list">
                                    @foreach ($loadowners as $loadowner)
                                        <tr id="task">
                                            <td>{{$loadowner->name}}</td>
                                            <td>{{$loadowner->telephone_number}}</td>
                                            <td>{{$loadowner->owner_address}} {{ $loadowner->owner_house_number }}</td>
                                            <td>{{$loadowner->owner_city}}</td>
                                            <td>{{$loadowner->owner_postal_code}}</td>
                                            <td>{{$loadowner->owner_township}}</td>
                                            <td>
                                                <button id="delete" name="delete" data-toggle="delete" class="btn btn-danger btn-xs btn-delete delete-task-owner" value="{{$loadowner->id}}">Verwijder</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {!! Form::submit('Voeg een eigenaar toe', ['class' => 'btn-primary', 'value' => 'btn-add-owner', 'id' => 'btn-add-owner', 'name' => 'btn-add-owner']) !!}

                            {!! Form::model($ticket, [
                                'method' => 'PUT',
                                'route' => ['melding.update', $ticket->id],
                                'ticket_id' => 'post-form'
                             ]) !!}
                            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                {!! Form::label('datum') !!}
                                <input class="form-control" type="date" name="date" value="{{ date('Y-m-d', strtotime($ticket->date)) }}" />
                                @if($errors->has('date'))
                                    <span class="help-block">
                                                {{ $errors->first('date') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                {!! Form::label('tijd (idee om een hier een klokje tijdselectie?)') !!}
                                <input class="form-control" type="time" name="time" value="{{ $ticket->time }}" />
                                @if($errors->has('time'))
                                    <span class="help-block">
                                                {{ $errors->first('time') }}
                                            </span>
                                @endif
                            </div>
                                    <hr>
                                    <h2>Melder</h2>
                                    <div class="form-group {{ $errors->has('reporter_name') ? 'has-error' : '' }}">
                                        {!! Form::label('Naam van melder') !!}
                                        {!! Form::text('reporter_name', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('reporter_name'))
                                            <span class="help-block">
                                                {{ $errors->first('reporter_name') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                        {!! Form::label('Telefoonnummer van melder') !!}
                                        {!! Form::text('telephone', null, ['class' => 'form-control']) !!}

                                        @if($errors->has('telephone'))
                                            <span class="help-block">
                                                {{ $errors->first('telephone') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h2>Dier</h2>
                                    <div class="form-group {{ $errors->has('animal_species') ? 'has-error' : '' }}">
                                        {!! Form::label('Diersoort') !!}
                                        <br />
                                        {!! Form::radio('animal_species', 'hond') !!}
                                        {!! Form::label('Hond') !!}
                                        {!! Form::radio('animal_species', 'kat', ['class' => 'form-control']) !!}
                                        {!! Form::label('Kat') !!}
                                        {!! Form::radio('animal_species', 'egel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Egel') !!}
                                        {!! Form::radio('animal_species', 'vogel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Vogel') !!}
                                        {!! Form::radio('animal_species', 'anders', ['class' => 'form-control']) !!}
                                        {!! Form::label('Anders') !!}
                                        @if($errors->has('animal_species'))
                                            <span class="help-block">{{ $errors->first('animal_species') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                        {!! Form::label('Geslacht') !!}
                                        <br />
                                        {!! Form::radio('gender', 'mannelijk', ['class' => 'form-control']) !!}
                                        {!! Form::label('Mannelijk') !!}
                                        {!! Form::radio('gender', 'vrouwelijk', ['class' => 'form-control']) !!}
                                        {!! Form::label('Vrouwelijk') !!}
                                        {!! Form::radio('gender', 'onbekend', ['class' => 'form-control']) !!}
                                        {!! Form::label('Onbekend') !!}
                                        @if($errors->has('gender'))
                                            <span class="help-block">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                                        {!! Form::label('Opmerkingen') !!}
                                        {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('comments'))
                                            <span class="help-block">{{ $errors->first('comments') }}</span>
                                        @endif
                                    </div>

                                    <hr>
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary', 'id' => 'update']) !!}
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

                                <!-- Modal (Pop up when detail destinations button clicked) -->
                                <div class="modal fade" id="myModal-owner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Eigenaar toevoegen</h4>
                                            </div>
                                            <div class="modal-body" id="messages">

                                                @if (session('status'))
                                                    <div class="alert alert-success">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                <div class="alert-danger" style="display:none"></div>

                                                {!! Form::label('owner-animal', 'Melder is ook eigenaar van het dier') !!}
                                                <input type="checkbox" id="animalowner"  onclick="animalOwner()">

                                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                    {!! Form::label('Naam') !!}
                                                    {!! Form::text('name',  false , ['class' => 'form-control', 'id' => 'name']) !!}
                                                    @if($errors->has('name'))
                                                        <span class="help-block">
                                                {{ $errors->first('name') }}
                                                </span>
                                                    @endif
                                                </div>

                                                <div class="form-group {{ $errors->has('telephone_number') ? 'has-error' : '' }}">
                                                        {!! Form::label('Telefoonnummer') !!}
                                                        {!! Form::text('telephone_number',  false , ['class' => 'form-control', 'id' => 'telephone_number']) !!}
                                                        @if($errors->has('telephone_number'))
                                                            <span class="help-block">
                                                    {{ $errors->first('telephone_number') }}
                                                    </span>
                                                        @endif
                                                </div>

                                                <div class="form-group {{ $errors->has('owner_postal_code') ? 'has-error' : '' }}">
                                                    {!! Form::label('Postcode') !!}
                                                    {!! Form::text('owner_postal_code',  false , ['class' => 'form-control', 'id' => 'owner_postal_code']) !!}
                                                    @if($errors->has('owner_postal_code'))
                                                        <span class="help-block">
                                                    {{ $errors->first('owner_postal_code') }}
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('owner_house_number') ? 'has-error' : '' }}">
                                                    {!! Form::label('Huisnummer') !!}
                                                    {!! Form::text('owner_house_number', null, ['class' => 'form-control', 'id' => 'owner_house_number', 'value' => '']) !!}
                                                    @if($errors->has('owner_house_number'))
                                                        <span class="help-block">
                                                    {{ $errors->first('owner_house_number') }}
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('owner_address') ? 'has-error' : '' }}">
                                                    {!! Form::label('Straatnaam') !!}
                                                    {!! Form::text('owner_address', null, ['class' => 'form-control', 'id'=> 'owner_address', 'value' => '']) !!}
                                                    @if($errors->has('owner_address'))
                                                        <span class="help-block">
                                                    {{ $errors->first('owner_address') }}
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('owner_city') ? 'has-error' : '' }}">
                                                    {!! Form::label('Plaats') !!}
                                                    {!! Form::text('owner_city', null, ['class' => 'form-control', 'id' => 'owner_city', 'value' => '']) !!}
                                                    @if($errors->has('owner_city'))
                                                        <span class="help-block">
                                                    {{ $errors->first('owner_city') }}
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('owner_township') ? 'has-error' : '' }}">
                                                    {!! Form::label('Gemeente') !!}
                                                    {!! Form::text('owner_township', null, ['class' => 'form-control', 'id' => 'owner_township', 'value' => '']) !!}
                                                    @if($errors->has('owner_township'))
                                                        <span class="help-block">
                                                    {{ $errors->first('owner_township') }}
                                                </span>
                                                    @endif
                                                </div>

                                                <div class="alert-success" style="display:none"></div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Sluit</span></button>
                                                <button type="button" class="btn btn-primary" id="btn-save-owner" name="btn-save-owner" value="add">Opslaan</button>
                                                <input type="hidden" id="task_id" name="task_id" value="0">
                                                <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/angular.min.js')}}"></script>
<script src="{{asset('js/ajax-destinations.js')}}"></script>
<script src="{{asset('js/table-directive.js')}}"></script>


@endsection

