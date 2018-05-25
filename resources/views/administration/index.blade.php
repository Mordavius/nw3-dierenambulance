@extends('layouts.app')
@section('content')
<div class="admin-menu">
  <ul>
    <li class="menu-item active">
      <a href="#">
        <img class="icon" src="{{asset('images/users.svg')}}" alt="Gebruikers"> </li>
      </a>
    <li class="menu-item">
      <a href="#">
        <img class="icon" src="{{asset('images/car.svg')}}" alt="Voertuigen"> </li>
      </a>
    <li class="menu-item">
      <a href="#">
        <img class="icon" src="{{asset('images/location.svg')}}" alt="Bekende adressen"> </li>
      </a>
    <li class="menu-item">
      <a href="#">
        <img class="icon" src="{{asset('images/export.svg')}}" alt="Export"> </li>
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
            Nieuwe gebruiker toevoegen
        </a>
        <br />
        <br />
        @if (! $users->count())
            <div class="alert alert-danger">
                <strong>Geen gebruikers gevonden</strong>
            </div>
        @else
        <div class="count">
            <small>
                {{ $usersCount }} {{ str_plural('gebruikers', $usersCount) }}
            </small>
        </div>
        <div class="users">
          @if($currentUser= auth()->user())
              @foreach($users as $user)
              <div class="user">
                <a href="{{ route('leden.edit', $user->id) }}">
                  <h2>{{ $user->name }}</h2>
                  <span class="subheading">{{ $user->role->name }}</span>
                </a>
                
                @if($user->id == config('') || $user->id == $currentUser->id)
                  <button onclick="return false" type="submit" class="delete disabled">
                      <img class="icon" src="{{asset('images/delete.svg')}}" alt="Verwijderen"> </li>
                  </button>
                @else
                    {!! Form::open(['method' => 'DELETE',
                     'route' => ['leden.destroy', $user->id],
                    'onsubmit' => 'return confirm("Klik op OK om de gebruiker te verwijderen!")']) !!}
                      <button onclick="return false" type="submit" class="delete">
                          <img class="icon" src="{{asset('images/delete.svg')}}" alt="Verwijderen"> </li>
                      </button>
                    {!! Form::close() !!}
                @endif
              </div>
              @endforeach
          @endif
        </div>
        @endif
    </section>
</div>
@endsection
