@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance')
@section('content')
@include('administration.admin_menu')
    <div class="wrapper">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <section class="content">
        <br />
        <a href="/bus/create" class="btn btn-success">
            Bus toevoegen
        </a>
        <br />
        <br />
        <br />
          @if (! $buses->count())
          <div class="alert alert-danger">
              <strong>Geen bussen gevonden</strong>
          </div>
          @else
            <div class="list">
              @foreach($buses as $bus)
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
