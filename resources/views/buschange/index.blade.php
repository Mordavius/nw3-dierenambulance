@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <nav class="navbar navbar-light bg-light">
      </nav>
      <div class="card">
        <div class="card-header">Buswissel</div>
        <div class="card-body">
          <div class="box-body">
<<<<<<< HEAD
            <a href="{{ route('buswissel.create') }}" class="btn btn-primary">Nieuwe buswissel aanmaken</a><br /><br />
=======
            <a href="{{ route('buswissel.create') }}" class="btn btn-primary">Wissel van bus</a><br /><br />
>>>>>>> 8d2756ebbe6930e7deb6e3c22579e4e63dbb7d33

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
          @if (! $buschanges->count())
            <div class="alert alert-danger">
              <strong>Geen buswissels gevonden</strong>
            </div>
          @else
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td>Bus</td>
                  <td>Datum</td>
                  <td>Van</td>
                  <td>Naar</td>
                  <td>Kilometer stand</td>
                </tr>
              </thead>

              <tbody>
                @foreach($buschanges as $buschange)
                  <tr>
                    <td>{{$buschange->bus}}</td>
                    <td>{{$buschange->date}}</td>
                    <td>{{$buschange->from}}</td>
                    <td>{{$buschange->to}}</td>
                    <td>{{$buschange->kilometerstraveled}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
