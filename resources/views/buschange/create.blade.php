@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance');
@section('body_class', 'buschange')
@section('content')
<div class="container buswissel">
  <h1>
      Nieuwe buswissel
  </h1>
  <div class="content-buswissel">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif

      {!! Form::model($buschange, [
          'method' => 'POST',
          'route' => 'buswissel.store'])
      !!}
          <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
              {!! Form::label('datum') !!}
              <input placeholder="Datum" class="form-control" type="date" name="date"

                  @if($buschange && $buschange->date)
                      value="{{ date('d-m-Y', strtotime($buschange->date)) }}"
                  @else
                      value="{{ date('Y-m-d') }}"
                  @endif
              />
              @if($errors->has('date'))
                  <span class="help-block">
                      {{ $errors->first('date') }}
                  </span>
                  @endif
          </div>
          <div class="form-group {{ $errors->has('bus') ? 'has-error' : '' }}">
              <select placeholder="Voertuig" name="bus" id="bus">
                  <option value="" disabled selected>Voertuig</option>
                  @foreach($bus as $buses)
                      <option value="{{$buses}}">{{$buses}}</option>
                  @endforeach
              </select>
              @if($errors->has('bus'))
                  <span class="alert alert-danger">
                      {{ $errors->first('bus') }}
                  </span>
              @endif
          </div>

          <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
              <select placeholder="Van" name="from" id="from">
                <option value="" disabled selected>Van</option>
                  @foreach($users as $user)
                      <option value="{{$user}}">{{$user}}</option>
                  @endforeach
              </select>
              @if($errors->has('from'))
                  <span class="help-block">
                      {{ $errors->first('from') }}
                  </span>
              @endif
          </div>

          <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
              <select placeholder="Naar" name="to" id="to">
                <option value="" disabled selected>Naar</option>
                  @foreach($users as $user)
                      <option value="{{$user}}">{{$user}}</option>
                  @endforeach
              </select>
              @if($errors->has('to'))
                  <span class="help-block">
                          {{ $errors->first('to') }}
                      </span>
              @endif
          </div>

          <div class="form-group{{ $errors->has('milage') ? 'has-error' : ''}}">
              {!! Form::text('milage', null, ['placeholder' => 'kilometerstand'], ['class' => 'form-control']) !!}

              @if($errors->has('milage'))
                <span class="alert-danger">{{ $errors->first('milage') }}</span>
              @endif
          </div>



          {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
      {!! Form::close()   !!}



  </div>
</div>
@endsection
