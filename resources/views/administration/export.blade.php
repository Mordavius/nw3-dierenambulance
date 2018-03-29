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
                        <section class="content">
                            <div class="col-6">

                                <a href="{{ url('downloadExcel') }}"><button class="btn btn-success btn-lg">Exporteren naar Excel</button></a>

                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection