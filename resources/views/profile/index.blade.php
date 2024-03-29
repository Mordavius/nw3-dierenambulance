@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Gebruikersbeheer
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <section class="content">
                            <a href="../register" class="btn btn-success">
                                Nieuwe gebruiker toevoegen
                            </a>
                            <br />
                            <br />
                            @if (! $users->count())
                                <div class="alert alert-danger">
                                    <strong>Geen gebruikers gevonden</strong>
                                </div>
                            @else
                                @include('administration.table')
                            @endif
                            <div class="pull-right">
                                <small>
                                    {{ $usersCount }} {{ str_plural('gebruikers', $usersCount) }}
                                </small>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
