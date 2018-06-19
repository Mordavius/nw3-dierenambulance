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
            <option value="all">Alles</option>
            <option value="Hond">Hond</option>
            <option value="Kat">Kat</option>
            <option value="Vogel">Vogel</option>
            <option value="Egel">Egel</option>
            <option value="Konijn">Konijn</option>
            <option value="Anders">Anders</option>
        </select>
        <select placeholder="Gemeente" id="township" type="text" name="township">
            @foreach($destinations as $destination)
                <option value="{{$destination->township}}">{{$destination->township}}</option>
            @endforeach
        </select>
        <input type="checkbox" id="financien" name="withfinance" value="true"><label for="financien">Met financiën</label>
        <button class="btn btn-success full-width">
            Exporteren naar Excel
        </button>
        {{ Form::close() }}
    </section>
</div>
@endsection
