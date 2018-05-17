@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($quarterlies as $quarterlies)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Profiel
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-info">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td width="80">Naam</td>
                                    <td width="80">Jaar</td>
                                    <td width="80">Downloaden</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $quarterlies->name }}</td>
                                    <td>{{ $quarterlies->year }}</td>
                                    <td><a href="download/{{ $quarterlies->name }}.xlsx">downloaden</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
