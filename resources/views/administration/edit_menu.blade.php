<div class="edit-menu">
  <a href="{{ url()->previous() }}"><img src="{{asset('images/close.svg')}}" alt=""></a>
  <h1>
    @if(isset($user->name))
      {{ $user->name }}
    @else
      Nieuwe gebruiker
    @endif
  </h1>
  <button type="submit" class="">
      <img src="{{asset('images/check.svg')}}" alt="">
  </button>
</div>
