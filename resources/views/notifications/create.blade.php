@extends('')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Melding Toevoegen
                <small>Nieuwe melding toevoegen</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/melding') }}"><i class="fa fa-dashboard"></i> Meldingen</a>
                </li>
                <li><a href="{{ route('melding.index') }}">Meldingen</a></li>
                <li class="active">Nieuw</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            {!! Form::model($post, [
                                'method' => 'POST',
                                'route' => 'melding.store'
                            ]) !!}

                            <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                                {!! Form::label('id') !!}
                                {!! Form::text('id', null, ['class' => 'form-control']) !!}

                                @if($errors->has('id'))
                                    <span class="help-block">{{ $errors->first('id') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                {!! Form::label('date') !!}
                                {!! Form::text('date', null, ['class' => 'form-control']) !!}

                                @if($errors->has('date'))
                                    <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                {!! Form::label('address') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control']) !!}

                                @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <hr>

                            {!! Form::submit('Opslaan', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
