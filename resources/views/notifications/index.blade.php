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
                <td width="80">Action</td>
                <td width="120">Melding nummer</td>
                <td width="120">Adres</td>
                <td width="150">Datum</td>
                <td width="170">Tijd</td>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)

                <tr>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['melding.destroy', $notification->id], 'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                        <a href="{{ route('melding.edit', $notification->id) }}" class="btn btn-xs btn-default">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-xs btn-danger">
                            <i class="fa fa-times">Verwijder Melding</i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->address }}</td>
                    <td>{{ $notification->date }}</td>
                    <td>{{ $notification->time }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @endif
</div>
<!-- /.box-body -->

@endsection
