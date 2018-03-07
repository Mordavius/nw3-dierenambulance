
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Nieuwe melding toevoegen
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            {!! Form::model($notification, [
                                'method' => 'POST',
                                'route' => 'melding.store'
                            ]) !!}

                            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                {!! Form::label('date') !!}
                                {!! Form::text('date', null, ['class' => 'form-control']) !!}

                                @if($errors->has('date'))
                                    <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                                {!! Form::label('time') !!}
                                {!! Form::text('time', null, ['class' => 'form-control']) !!}

                                @if($errors->has('time'))
                                    <span class="help-block">{{ $errors->first('time') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                {!! Form::label('address') !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}

                                @if($errors->has('address'))
                                    <span class="help-block">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('postalcode') ? 'has-error' : '' }}">
                                {!! Form::label('postalcode') !!}
                                {!! Form::text('postalcode', null, ['class' => 'form-control']) !!}

                                @if($errors->has('postalcode'))
                                    <span class="help-block">{{ $errors->first('postalcode') }}</span>
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
