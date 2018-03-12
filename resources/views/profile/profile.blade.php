@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @foreach($user as $user)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profiel</div>
                <button onclick="location.href='{{$user->name}}/edit'" type="submit" class="btn btn-primary">
              Edit profile
            </button>
                <div class="card-body">
                      <table class="table table-bordered">
                          <thead>
                          <tr>
                              <td width="80">Id</td>
                              <td width="80">Naam</td>
                              <td width="80">E-mail</td>
                          </tr>
                          </thead>
                          <tbody>


                      <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                      </tr>
                  @endforeach

            </div>
        </div>

    </div>
</div>
@endsection
<!-- /.box-body -->