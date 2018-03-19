@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">Laat meldingen zien vanaf</div>

                    <nav class="navbar navbar-light bg-light">
                        <form action="{{ route('search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control input-lg" value="{{ request('search') }}" name="search" placeholder="Zoeken naar...">
                                <span class="input-group-btn">
                        <button class="btn btn-lg btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                            </div>
                        </form>
                    </nav>
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a href="meldingen"><div class="btn btn-primary">Terug naar het menu</div></a><br /><br />
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($search = request('search'))
                            <div class="alert alert-success">
                               <p>Zoekresultaten: {{ $search }}</p>
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
                <td>Meldings<br />nummer</td>
                <td>Diersoort</td>
                <td>Plaats</td>
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
                    <td>{{ $notification->city }}</td>
                    <td>{{ $notification->date }}</td>
                    <td>{{ $notification->time }}</td>
                    <td>{{ $notification->comments }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['melding.destroy', $notification->id], 'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                        <a href="{{ route('melding.edit', $notification->id) }}">
                            <i class="btn btn-primary">Aanpassen</i>
                        </a>

                        <br />

                        <a href="{{ route('melding.show', $notification->id) }}"><i class="btn btn-primary">Bekijk</i></a>

                        <br />

                        <button type="submit" class="btn btn-primary">
                            <i>Verwijderen</i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>

                <!-- pagination -->
              

            @endforeach
            </tbody>
        </table>
    @endif
</div>
<!-- /.box-body -->

@endsection
