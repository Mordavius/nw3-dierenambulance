@extends('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profiel</div>

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
                  @foreach($user as $user)

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
</div>
<!-- /.box-body -->
