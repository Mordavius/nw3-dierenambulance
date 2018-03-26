<table class="table table-bordered">
    <thead>
        <tr>
            <td>Naam</td>
            <td>E-mail</td>
            <td>Rol van gebruiker</td>
            <td width="80px">Acties</td>
        </tr>
    </thead>
    <tbody>
        <?php $currentUser = auth()->user(); ?>
        @foreach($users as $user)

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('leden.edit', $user->id) }}" class="btn btn-xs btn-default">
                        <i class="btn btn-success">Aanpassen</i>
                    </a>
                    @if($user->id == config('') || $user->id == $currentUser->id)
                        <button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
                            Verwijderen
                        </button>
                    @else
                        {!! Form::open(['method' => 'DELETE', 'route' => ['leden.destroy', $user->id],
                        'onsubmit' => 'return confirm("Klik op OK om de gebruiker te verwijderen!")']) !!}
                        <button type="submit" class="btn btn-xs btn-danger">
                            Verwijderen
                        </button>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>

        @endforeach
    </tbody>
</table>
