@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
@section('body_class', 'edit_page')
<div class="wrapper">
  <div class="card-body">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <div class="row">
          {!! Form::model($user, [
              'method' => 'PUT',
              'route'  => ['leden.update', $user->id],
              'files'  => TRUE,
              'id'     => 'user-form'
          ]) !!}
              @include('profile.form')
          {!! Form::close() !!}
      </div>
</div>
@endsection
