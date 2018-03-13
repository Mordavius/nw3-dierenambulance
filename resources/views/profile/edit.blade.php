@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Profiel aanpassen</h1>
      </section>
      <section class="content">
        @foreach($user as $user)
          <div class="col-8">
            {!! Form::model($user, [
              'method' => 'PATCH',
              'route' => ['profiel.update', $user->id]
              ]) !!}
          <div class="form-group">
            {!! Form::label('Username', 'Gebruikersnaam:', ['class' => 'control-label']) !!}
            {!! Form::text('username', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail adres:', ['class' => 'control-label']) !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Update Task', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
        @endforeach
        </div>
</section>


</div>
@endsection
<!-- /.box-body -->
