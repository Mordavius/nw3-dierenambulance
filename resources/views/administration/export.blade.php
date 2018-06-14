@extends('layouts.app')

@section('content')
    @include('administration.admin_menu')
@section('body_class', 'export')
<a href="/melding/create">
    <button class="round">
        <img src="../images/plus.png" class="rotate-button"/>
    </button>
</a>
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
        <select placeholder="Dier" id="animal" type="text" name="animal">
            <option value="">Hoi</option>
            <option value="">Hoi</option>
            <option value="">Hoi</option>
        </select>
        <select placeholder="Gemeente" id="township" type="text" name="township">
            <option value="">Hoi</option>
            <option value="">Hoi</option>
            <option value="">Hoi</option>
        </select>
        <input type="checkbox" id="financien" name="Met financiën" value="Met financiën"><label for="financien">Met financiën</label>
        <button class="btn btn-success full-width">
            Exporteren naar Excel
        </button>
        {{ Form::close() }}
    </section>
</div>
@endsection
