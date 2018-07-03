@extends('layouts.app')

@section('content')
<div class="container">
  <section class="content">
    <h1>Buswissel</h1>
      <div class="box-body">
        <br />
          <a href="{{ route('buswissel.create') }}" class="btn btn-success">
            Nieuwe buswissel
          </a>
          <br />
          <br />
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
                      <td>{{$buschange->milage}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          @endif
      </div>
  </section>
</div>
@endsection
