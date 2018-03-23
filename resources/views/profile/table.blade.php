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
                    <a href="" class="btn btn-xs btn-default"> <!-- route('profiel.adminedit', $user->id) -->
                        <i class="btn btn-success">Aanpassen</i>
                    </a>
                    @if($user->id == config('') || $user->id == $currentUser->id)
                        <button onclick="return false" type="submit" class="btn btn-xs btn-danger disabled">
                            Verwijderen
                        </button>
                    @else
                        <a href="" class="btn btn-xs btn-danger">  <!-- route('profile.confirm', $user->id) -->
                            Verwijderen
                        </a>
                    @endif
                </td>
            </tr>

        @endforeach
    </tbody>
</table>
