@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                    @endif

<!-- /.box-header -->
<div class="box-body ">
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    @if (! $notifications->count())
        <div class="alert alert-danger">
            <strong>Geen meldingen gevonden</strong>
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Meldingsnummer</td>
                <td>Diersoort</td>
                <td>Adresgegevens</td>
                <td>Datum</td>
                <td>Tijd</td>
                <td>Beschrijving</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)

                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->animalspecies }}</td>
                    <td>{{ $notification->address }}</td>
                    <td>{{ $notification->date, $notification->time  }}</td>
                    <td>{{ $notification->time }}</td>
                    <td>{{ $notification->comments }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['melding.destroy', $notification->id], 'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                        <a href="{{ route('melding.edit', $notification->id) }}">
                            <i class="btn btn-primary">Melding aanpassen</i>
                        </a>

                        <button type="submit">
                            <i class="btn btn-primary">Verwijder Melding</i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @endif
</div>
<!-- /.box-body -->

@endsection
