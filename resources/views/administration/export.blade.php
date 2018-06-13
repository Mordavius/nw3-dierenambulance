@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Exporteren naar excel
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <!-- Main content -->
                    <section class="content">
                        {{Form::open(array('url' => 'downloadExcel'))}}
                        <input type="date" name="startdate" id="startdate"/>
                        <input type="date" name="enddate" id="enddate"/>
                        <div class="col-6">
                                <button class="btn btn-success btn-lg">
                                    Exporteren naar Excel
                                </button>
                        </div>
                        {{ Form::close() }}
                    </section>
                </div>
            </div>
=======
@include('administration.admin_menu')
<div class="wrapper">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
>>>>>>> dev
        </div>
    @endif
<!-- Main content -->
    <section class="content">
            <a href="{{ url('downloadExcel') }}">
                <button class="btn btn-success full-width">
                    Exporteren naar Excel
                </button>
            </a>
    </section>
</div>
@endsection
