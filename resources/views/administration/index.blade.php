@extends('layouts.app')
@section('content')
<div class="admin-menu">
  <ul>
    <li class="menu-item active">
      <a href="../administratie">
        <img class="icon" src="{{asset('images/users.svg')}}" alt="Gebruikers"> <span>Gebruikers</span></li>
      </a>
    <li class="menu-item">
      <a href="/bus">
        <img class="icon" src="{{asset('images/car.svg')}}" alt="Voertuigen"> <span>Voertuigen</span></li>
      </a>
    <li class="menu-item">
      <a href="/bekende-adressen">
        <img class="icon" src="{{asset('images/location.svg')}}" alt="Bekende adressen"> <span>Bekende adressen</span></li>
      </a>
    <li class="menu-item">
      <a href="/exporteren">
        <img class="icon" src="{{asset('images/export.svg')}}" alt="Export"> <span>Export</span></li>
      </a>
  </ul>
</div>
<div class="wrapper">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <section class="content">
        <a href="../register" class="btn btn-success">
            Gebruiker toevoegen
        </a>
        <br />
        <br />
        @if (! $users->count())
            <div class="alert alert-danger">
                <strong>Geen gebruikers gevonden</strong>
            </div>
        @else
        <div class="list">
          @if($currentUser= auth()->user())
              @foreach($users as $user)
              <div class="list-item">
                <a href="{{ route('leden.edit', $user->id) }}">
                  <div class="headings">
                    <h2>{{ $user->name }}</h2>
                    <span class="subheading">{{ $user->role->name }}</span>
                  </div>
                </a>
                <div class="delete">
                  @if($user->id == config('') || $user->id == $currentUser->id)

                  @else
                      {!! Form::open(['method' => 'DELETE',
                       'route' => ['leden.destroy', $user->id],
                      'onsubmit' => 'return confirm("Klik op OK om de gebruiker te verwijderen!")']) !!}
                        <button onclick="return false" type="submit" class="btn-delete">
                            <img class="icon" src="{{asset('images/delete.svg')}}" alt="Verwijderen"> </li>
                        </button>
                      {!! Form::close() !!}
                  @endif
                </div>
              </div>
              @endforeach
          @endif
        </div>
        @endif
    </section>
</div>
@endsection
