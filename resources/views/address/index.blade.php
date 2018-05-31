@extends('layouts.app')
@section('content')
@include('administration.admin_menu')
    <div class="wrapper">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <section class="content">
        <a href="/bekende-adressen/create" class="btn btn-success">
            Nieuw adres toevoegen
        </a>
        <br>
        <br>
          @if (! $known->count())
          <div class="alert alert-danger">
              <strong>Geen bekende adressen gevonden</strong>
          </div>
          @else
            <div class="list">
              @foreach($known as $known)
                <div class="list-item">
                  <!-- <a href=" route('address.edit', $address->id) "> -->
                    <div class="headings">
                      <h2>{{ $known->location_name }}</h2>
                      <span class="subheading">{{ $known->address }} {{$known->house_number}}, {{ $known->postal_code }} {{ $known->city}}</span>
                    </div>
                  <!-- </a> -->
                  <div class="delete">
                    {!! Form::open(['method' => 'DELETE',
                    'route' => ['bekende-adressen.destroy', $known->id],
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
