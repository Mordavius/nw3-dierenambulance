@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
@include('administration.edit_menu')
@section('body_class', 'edit_page')
<div class="wrapper">
    <section class="content">
      <h1>Nieuwe bus toevoegen</h1>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      {!! Form::model($bus, [
          'method' => 'POST',
          'route' => 'bus.store'])
      !!}
      <div class="form-group{{ $errors->has('busname') ? 'has-error' : ''}}">
          {!! Form::text('bus_type', null, ['class' => 'form-control', 'placeholder' => 'Voertuig naam']) !!}

          @if($errors->has('bus_type'))
            <br /><span class="alert-danger">{{ $errors->first('bus_type') }}</span><br /><br />
          @endif
      </div>
      {!! Form::text('milage', null, ['class' => 'form-control', 'placeholder' => 'Kilometerstand']) !!}

       @if($errors->has('milage'))
        <br /><span class="alert-danger">{{ $errors->first('milage') }}</span><br /><br />
       @endif

       {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
       {!! Form::close()   !!}
   </div>
  </section>
</div>
@endsection
