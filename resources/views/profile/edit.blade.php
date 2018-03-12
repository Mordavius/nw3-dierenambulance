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
            {!! Form::label('Username', 'Title:', ['class' => 'control-label']) !!}
            {!! Form::text('username', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Description:', ['class' => 'control-label']) !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Update Task', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
        @endforeach
            <!--{!! Form::model($user, [
                                'method' => 'PATCH',
                                'route' => ['profiel.update', $user ->id]
                            ]) !!}
                            <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                                <td width="200">{!! Form::label('username') !!}</td>
                                <td width="80%">{!! Form::text('name', $user->name , ['class' => 'form-control']) !!}</td>

                                @if($errors->has('user'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <td width="100">{!! Form::label('password') !!}</td>
                                <td width="100%">{!! Form::password('password', ['class' => 'form-control']) !!}</td>

                                @if($errors->has('user'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <td width="100">{!! Form::label('email') !!}</td>
                                <td width="100%">{!! Form::text( 'name' , $user->email , ['class' => 'form-control']) !!}</td>

                                @if($errors->has('user'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <hr>
                          <tbody>

                            {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}



            </div>
        </div>-->
</section>

    </div>
</div>
@endsection
<!-- /.box-body -->
