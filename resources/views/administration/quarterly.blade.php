@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Kwartaaloverzicht
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td width="80">Naam</td>
                                <td width="80">Jaar</td>
                                <td width="80">Downloaden</td>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($errors->first()))
                                <div class="row col-lg-12">
                                    <div class="alert alert-danger">
                                        <span>{{ $errors->first() }}</span>
                                    </div>
                                </div>
                            @endif
                            @foreach($quarterlies as $quarterlies)
                                <tr>
                                    <td>{{ $quarterlies->name }}</td>
                                    <td>{{ $quarterlies->year }}</td>
                                    <td><a href="administratie/download/{{ $quarterlies->name }}.xlsx">downloaden</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
