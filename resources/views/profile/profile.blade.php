@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @foreach($user as $user)
      <div class="col-md-12">
        <div class="card">
          @if(session('status'))
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-header">Profiel</div>
          <div class="card-body">
            <button onclick="location.href='{{$user->name}}/edit'" type="submit" class="btn btn-primary">
              Profiel aanpassen
            </button>
          <br>
          <br>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td width="80">Gebruikersnaam</td>
                  <td width="80">E-mail</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                </tr>
              </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
<!-- /.box-body -->
