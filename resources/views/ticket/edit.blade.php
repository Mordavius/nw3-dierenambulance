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
                                    <h2>Locatie</h2>

                                    @foreach($destinations as $destination)
                                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                    {!! Form::label('Adres') !!}
                                                    {!! Form::label('address', $destination->address, ['class' => 'form-control']) !!}
                                                    @if($errors->has('address'))
                                                        <span class="help-block">
                                                            {{ $errors->first('address') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                @endforeach

                                    <div class="form-group {{ $errors->has('housenumber') ? 'has-error' : '' }}">
                                        {!! Form::label('Huisnummer') !!}
                                        {!! Form::text('housenumber', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('housenumber'))
                                            <span class="help-block">
                                                {{ $errors->first('housenumber') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('postalcode') ? 'has-error' : '' }}">
                                        {!! Form::label('Postcode') !!}
                                        {!! Form::text('postalcode', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('postalcode'))
                                            <span class="help-block">
                                                {{ $errors->first('postalcode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('nocode') ? 'has-error' : '' }}">
                                        {!! Form::label('Geen Postcode') !!}
                                        {!! Form::checkbox('nocode', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('nocode'))
                                            <span class="help-block">
                                                {{ $errors->first('nocode') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                        {!! Form::label('Plaats') !!}
                                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('city'))
                                            <span class="help-block">
                                                {{ $errors->first('city') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                        {!! Form::label('Gemeente') !!}
                                        {!! Form::text('township', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('township'))
                                            <span class="help-block">
                                                {{ $errors->first('township') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('centralist') ? 'has-error' : '' }}">
                                        {!! Form::label('Centralist') !!}
                                        {!! Form::select('centralist', $users) !!}
                                        @if($errors->has('centralist'))
                                            <span class="help-block">
                                                {{ $errors->first('centralist') }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <h2>Melder</h2>
                                    <div class="form-group {{ $errors->has('reportername') ? 'has-error' : '' }}">
                                        {!! Form::label('Naam van melder') !!}
                                        {!! Form::text('reportername', null, ['class' => 'form-control']) !!}
                                        @if($errors->has('meldernaam'))
                                            <span class="help-block">
                                                {{ $errors->first('reportername') }}
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
                                    <div class="form-group {{ $errors->has('animalspecies') ? 'has-error' : '' }}">
                                        {!! Form::label('Diersoort') !!}
                                        <br />
                                        {!! Form::radio('animalspecies', 'hond') !!}
                                        {!! Form::label('Hond') !!}
                                        {!! Form::radio('animalspecies', 'kat', ['class' => 'form-control']) !!}
                                        {!! Form::label('Kat') !!}
                                        {!! Form::radio('animalspecies', 'egel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Egel') !!}
                                        {!! Form::radio('animalspecies', 'vogel', ['class' => 'form-control']) !!}
                                        {!! Form::label('Vogel') !!}
                                        {!! Form::radio('animalspecies', 'anders', ['class' => 'form-control']) !!}
                                        {!! Form::label('Anders') !!}
                                        @if($errors->has('animalspecies'))
                                            <span class="help-block">{{ $errors->first('animalspecies') }}</span>
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
                                    <div class="form-group {{ $errors->has('invoice') ? 'has-error' : '' }}">
                                    {!! Form::label('Factuur') !!}
                                    {!! Form::text('invoice', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('invoice'))
                                        <span class="help-block">{{ $errors->first('invoice') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('paymentmethodinvoice') ? 'has-error' : '' }}">
                                    {!! Form::label('Betaalmethode') !!}
                                    <br />
                                    {!! Form::radio('paymentmethodinvoice', 'Contant', ['class' => 'form-control']) !!}
                                    {!! Form::label('Contant') !!}
                                    {!! Form::radio('paymentmethodinvoice', 'Pinnen', ['class' => 'form-control']) !!}
                                    {!! Form::label('Pinnen') !!}
                                    @if($errors->has('paymentmethodinvoice'))
                                        <span class="help-block">{{ $errors->first('paymentmethodinvoice') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('gifts') ? 'has-error' : '' }}">
                                    {!! Form::label('Factuur') !!}
                                    {!! Form::text('gifts', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('gifts'))
                                        <span class="help-block">{{ $errors->first('gifts') }}</span>
                                    @endif
                                    {!! Form::label('Betaalmethode') !!}
                                    <br />
                                    {!! Form::radio('paymentmethodgifts', 'Contant', ['class' => 'form-control']) !!}
                                    {!! Form::label('Contant') !!}
                                    {!! Form::radio('paymentmethodgifts', 'Pinnen', ['class' => 'form-control']) !!}
                                    {!! Form::label('Pinnen') !!}
                                    @if($errors->has('paymentmethodgifts'))
                                        <span class="help-block">{{ $errors->first('paymentmethodgifts') }}</span>
                                    @endif
                                </div>
                                    <hr>
                                    {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
