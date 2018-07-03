@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');

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

                    Dit is niet toegestaan!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
