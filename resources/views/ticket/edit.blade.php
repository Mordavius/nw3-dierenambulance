@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
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
                            <h4>Meldingslocatie</h4>
                            <table class="table">
                                    <tr>
                                    <td> {{  $destinations['postal_code'] }} </td>
                                    <td> {{  $destinations['address'] }} </td>
                                    <td> {{  $destinations['house_number'] }} </td>
                                    <td> {{  $destinations['city'] }} </td>
                                    <td> {{  $destinations['township'] }} </td>
                            </tr>
                            </table>


                            {!! Form::submit('Voeg bestemming toe', ['class' => 'btn-primary', 'value' => 'btn-add', 'id' => 'btn-add', 'name' => 'btn-add']) !!}


                            <!-- Table-to-load-the-destinations Part -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Bestemmingsnummer</th>
                                    <th>Postcode</th>
                                    <th>Adres</th>
                                    <th>Plaats</th>
                                    <th>Gemeente</th>
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
                                        <td>

                                            <button id="delete" name="delete" data-toggle="delete" class="btn btn-danger btn-xs btn-delete delete-task" value="{{$loaddestinations->id}}">Verwijder</button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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
                                    Financien
                                    <div class="form-group {{ $errors->has('payment_invoice') ? 'has-error' : '' }}">
                                    {!! Form::label('Factuur') !!}
                                    {!! Form::text('payment_invoice', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('payment_invoice'))
                                        <span class="help-block">{{ $errors->first('payment_invoice') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('payment_method_invoice') ? 'has-error' : '' }}">
                                    {!! Form::label('Betaalmethode') !!}
                                    <br />
                                    {!! Form::radio('payment_method_invoice', 'Contant', ['class' => 'form-control']) !!}
                                    {!! Form::label('Contant') !!}
                                    {!! Form::radio('payment_method_invoice', 'Pinnen', ['class' => 'form-control']) !!}
                                    {!! Form::label('Pinnen') !!}
                                    @if($errors->has('payment_method_invoice'))
                                        <span class="help-block">{{ $errors->first('payment_method_invoice') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('payment_gifts') ? 'has-error' : '' }}">
                                    {!! Form::label('Factuur') !!}
                                    {!! Form::text('payment_gifts', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('payment_gifts'))
                                        <span class="help-block">{{ $errors->first('payment_gifts') }}</span>
                                    @endif
                                    {!! Form::label('Betaalmethode') !!}
                                    <br />
                                    {!! Form::radio('payment_method_gifts', 'Contant', ['class' => 'form-control']) !!}
                                    {!! Form::label('Contant') !!}
                                    {!! Form::radio('payment_method_gifts', 'Pinnen', ['class' => 'form-control']) !!}
                                    {!! Form::label('Pinnen') !!}
                                    @if($errors->has('payment_method_gifts'))
                                        <span class="help-block">{{ $errors->first('paymentmethod_gifts') }}</span>
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
                                        <div class="modal-body">
                                            {!! Form::model($loaddestination, [
                                             'method' => 'POST',
                                             'route' => 'melding.store',
                                             'id' => 'destination',
                                             'name' => 'destination',
                                             'novalidate' => ''
                                              ]) !!}

                                            <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                                                {!! Form::label('Postcode') !!}
                                                {!! Form::text('postal_code', false, ['class' => 'form-control', 'id' => 'postal_code']) !!}
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

                                            <div class="form-group {{ $errors->has('milage') ? 'has-error' : '' }}">
                                                {!! Form::label('Kilometer op locatie') !!}
                                                {!! Form::text('milage', null, ['class' => 'form-control', 'id' => 'milage', 'value' => '']) !!}
                                                @if($errors->has('milage'))
                                                    <span class="help-block">
                                                    {{ $errors->first('milage') }}
                                                </span>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="btn-save" name="btn-save" value="add">Opslaan</button>
                                            <input type="hidden" id="task_id" name="task_id" value="0">
                                            <input type="hidden" id="ticket_id" name="ticket_id" value={{ $ticket_id }}>

                                            {!! Form::close() !!}
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
<script src="{{asset('js/ajax-destinations.js')}}"></script>


@endsection

