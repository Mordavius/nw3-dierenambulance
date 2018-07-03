@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');

@section('content')
@include('administration.admin_menu')
@include('administration.edit_menu')
@section('body_class', 'edit_page')
<div class="wrapper">
  <section class="content">
    <h1>Gebruiker bewerken</h1>
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div>
            {!! Form::model($user, [
                'method' => 'PUT',
                'route'  => ['leden.update', $user->id],
                'files'  => TRUE,
                'id'     => 'user-form'
            ]) !!}
                @include('profile.form')
            {!! Form::close() !!}
        </div>
  </section>
</div>
@endsection
