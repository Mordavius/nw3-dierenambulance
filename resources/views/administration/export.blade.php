@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
@section('body_class', 'export')
<div class="wrapper">
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
    <button class="btn btn-success full-width">
        Exporteren naar Excel
    </button>
    {{ Form::close() }}
</section>
</div>
@endsection
