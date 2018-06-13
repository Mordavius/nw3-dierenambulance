@extends('layouts.app')

@section('content')
<div>
    <div>
        Administratie
    </div>
    <div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <!-- Main content -->
        <section class="content">
            <div class="col-6">
                <a href="leden" class="btn btn-primary">
                    Gebruikers
                </a>
                <br />
                <br />
                <a href="exporteren" class="btn btn-primary">
                    Exporteer Meldingen
                </a>
                <br />
                <br />
                <a href="bus" class="btn btn-primary">
                    Bussen
                </a>
                <br />
                <br />
                <a href="bekende-adressen" class="btn btn-primary">
                    Bekende adressen
                </a>
                <br />
                <br />
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
@endsection
