@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Bekende addressen beheer
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/bekende-adressen/create" class="btn btn-success">
                            Nieuw adres toevoegen
                        </a>
                        <section class="content">
                            @if (! $known->count())
                            <div class="alert alert-danger">
                                <strong>Geen bekende adressen gevonden</strong>
                            </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Locatie Naam</td>
                                            <td>Postcode</td>
                                            <td>Straat</td>
                                            <td>Huisnummer</td>
                                            <td>Stad</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($known as $known)
                                            <tr>
                                                <td>{{ $known->location_name }}</td>
                                                <td>{{ $known->postal_code }}</td>
                                                <td>{{ $known->address }}</td>
                                                <td>{{ $known->house_number }}</td>
                                                <td>{{ $known->city }}</td>

                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['bekende-adressen.destroy', $known->id],
                                                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                                                        <button type="submit" class="btn btn-danger">
                                                            <i>Verwijderen</i>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
