@extends('layouts.app')
@section('content')
@include('administration.admin_menu')
    <a href="/melding/create">
      <button class="round">
          <img src="../images/plus.png" class="rotate-button"/>
      </button>
    </a>
    <div class="wrapper">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <section class="content">
        <a href="/bus/create" class="btn btn-success">
            Bus toevoegen
        </a>
        <br />
        <br />
          @if (! $bus->count())
          <div class="alert alert-danger">
              <strong>Geen bussen gevonden</strong>
          </div>
          @else
            <div class="list">
              @foreach($bus as $bus)
                <div class="list-item">
                  <a href="#"> <!-- link naar bus -->
                    <div class="headings">
                      <h2>{{ $bus->bus_type }}</h2>
                      <span class="subheading">Kilometerstand: {{ $bus->milage }}</span>
                    </div>
                  </a>
                  <div class="delete">
                    {!! Form::open(['method' => 'DELETE',
                    'route' => ['bus.destroy', $bus->id],
                    'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                        <button type="submit" class="btn-delete">
                            <img class="icon" src="{{asset('images/delete.svg')}}" alt="Verwijderen"> </li>
                        </button>
                    {!! Form::close() !!}
                  </div>
                </div>
              @endforeach
            </div>
          @endif
      </section>
</div>
@endsection
