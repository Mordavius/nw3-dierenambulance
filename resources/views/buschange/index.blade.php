@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance')
@section('body_class', 'buschange')
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
            <div class="buschange-list">
                @foreach($buschanges as $buschange)
                <div class="buschange-item">
                  <h2>{{$buschange->bus}}</h2>
                  <div class="from-to">
                     <span class="from">{{$buschange->from}}</span>
                     -
                     <span class="to">{{$buschange->to}}</span>
                  </div>
                  <span class="subheading">Datum: {{$buschange->date}} - Kilometerstand: {{$buschange->milage}}</span>
                </div>
                @endforeach
              </div>
          @endif
      </div>
  </section>
</div>
@endsection
