@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <nav class="navbar navbar-light bg-light">
      </nav>
      <div class="card">
        <div class="card-header">Nieuwe buswissel</div>
        <div class="card-body">
          <a href="../buswissel">
            <div class="btn btn-primary">Terug naar het menu
            </div>
          </a>
        </br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
          <div class="box-body">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
