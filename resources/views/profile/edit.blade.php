@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Profiel aanpassen
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content-wrapper">
                        <section class="content">
                            @foreach($user as $user)
                                <div class="col-12">
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
                                        {!! Form::submit('Profiel opslaan', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.box-body -->
