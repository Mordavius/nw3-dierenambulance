<!-- /.box-header -->
<div class="box-body ">
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    @if (! $notifications->count())
        <div class="alert alert-danger">
            <strong>Geen meldingen gevonden</strong>
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <td width="80">Action</td>
                <td>Title</td>
                <td width="120">Id</td>
                <td width="150">Datum</td>
                <td width="170">Tijd</td>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)

                <tr>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['notification.destroy', $notification->id], 'onsubmit' => 'return confirm("Klik op OK om de melding te verwijderen!")']) !!}
                        <a href="{{ route('melding.edit', $notification->id) }}" class="btn btn-xs btn-default">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-xs btn-danger">
                            <i class="fa fa-times"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $notification->title }}</td>
                    <td>{{ $notification->date->name }}</td>
                    <td>{{ $notification->time->title }}</td>
                    <td>{{ $notification->created_at }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @endif
</div>
<!-- /.box-body -->
