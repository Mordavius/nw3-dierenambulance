@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Busbeheer
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/bus/create" class="btn btn-success">
                            Nieuwe bus toevoegen
                        </a>
                        <section class="content">
                            @if (! $bus->count())
                            <div class="alert alert-danger">
                                <strong>Geen bussen gevonden</strong>
                            </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Type bus</td>
                                            <td>Kilometerstand</td>
                                            <td>Schade</td>
                                            <td>Schade beschrijving</td>
                                            <td>Schoon</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bus as $bus)
                                            <tr>
                                                <td>{{ $bus->bus_type }}</td>
                                                <td>{{ $bus->milage }}</td>
                                                @if($bus->damage == 1)
                                                    <td>Ja</td>
                                                @else
                                                    <td>Nee</td>
                                                @endif
                                                <td>{{ $bus->damage_description }}</td>
                                                @if($bus->clean == 0)
                                                    <td>Ja</td>
                                                @else
                                                    <td>Nee</td>
                                                @endif
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE',
                                                    'route' => ['bus.destroy', $bus->id],
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
