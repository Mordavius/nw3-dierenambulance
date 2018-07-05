@extends(Auth::user()->isAdmin() ? 'layouts.app' : 'layouts.appambulance')

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
        <div class="dates date-1">
          <label class="date-label" for="startdate">Van</label>
          <input class="date-start"type="date" name="startdate" id="startdate"/>
        </div>
        <div class="dates date-2">
          <label class="date-label" for="enddate">Tot</label>
          <input class="date-end" type="date" name="enddate" id="enddate"/>
        </div>
        <select placeholder="Dier" id="animal" type="text" name="animal">
            <option selected disabled value="all">Dieren</option>
            <option value="Hond">Hond</option>
            <option value="Kat">Kat</option>
            <option value="Vogel">Vogel</option>
            <option value="Egel">Egel</option>
            <option value="Konijn">Konijn</option>
            <option value="Anders">Anders</option>
        </select>
        <select placeholder="Gemeente" id="township" type="text" name="township">
            <option selected disabled value="all">Gemeenten</option>
            @foreach($destinations as $destination)
                <option value="{{$destination->township}}">{{$destination->township}}</option>
            @endforeach
        </select>
        <input type="checkbox" id="financien" name="withfinance" value="true"><label class="finance" for="financien">Met financiën</label>
        <button class="btn btn-success full-width">
            Exporteren naar Excel
        </button>
        {{ Form::close() }}
    </section>
</div>
@endsection
