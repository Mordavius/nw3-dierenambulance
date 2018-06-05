@extends('layouts.app')

@section('content')
@include('administration.admin_menu')
<div class="wrapper">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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
