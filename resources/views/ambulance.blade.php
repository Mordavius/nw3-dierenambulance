@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Main content -->
                        <section class="content">
                            <div class="col-12">
                                <a href="{{ route('melding.index') }}" class="btn btn-primary">Openstaande Meldingen</a><br /><br />
                                <a href="buswissel" class="btn btn-primary">Buswissel</a><br /><br />
                            </div>
                        </section>
                        <!-- /.content -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
