@extends('layouts.app')

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
                            @foreach($quarterlies as $quarterlies)
                                <tr>
                                    <td>{{ $quarterlies->name }}</td>
                                    <td>{{ $quarterlies->year }}</td>
                                    <td><a href="download/{{ $quarterlies->name }}.xlsx">downloaden</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
