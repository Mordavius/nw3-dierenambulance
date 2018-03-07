@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Meldingen</h1>
    </section>

    <!-- Main content -->
    <section class="content">
                            <a href="{{ route('melding.index') }}">Alle Meldingen</a><br />
                            <a href="{{ route('melding.create') }}" class="btn btn-success">Nieuwe melding aanmaken</a><br />
                            <a href="{{ url('/profiel') }}">Bekijk profiel</a>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>

@endsection
