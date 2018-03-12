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

                    <!-- Main content -->
                        <section class="content">
                            <div class="col-6">
                                <a href="{{ route('melding.index') }}" class="btn btn-success">Alle Meldingen</a>
                                <a href="{{ route('melding.create') }}" class="btn btn-success">Nieuwe melding aanmaken</a>
                                <a href="{{ url('/profiel') }}" class="btn btn-success">Bekijk profiel</a>
                            </div>
                        </section>
                        <!-- /.content -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
