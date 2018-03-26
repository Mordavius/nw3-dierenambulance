@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                    @endif

                    <!-- Main content -->

      <!-- Main content -->
      <section class="content">
          <div class="row">
              {!! Form::model($user, [
                  'method' => 'PUT',
                  'route'  => ['leden.update', $user->id],
                  'files'  => TRUE,
                  'id'     => 'user-form'
              ]) !!}

              @include('profile.form')

            {!! Form::close() !!}
          </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>

@endsection
