@extends('layouts.app')
@section('content')
@include('administration.admin_menu')
<div class="wrapper">
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <section class="content">
      <h1>Toevoegen, bewerken en verwijderen van gebruikers</h1>
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
                        <button onclick="submit" type="submit" class="btn-delete">
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
