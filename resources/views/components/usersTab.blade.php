<table class="table">
    <thead>
        <tr>
            <th>{{ __('Nome') }}</th>
            <th>{{ __('Email') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('{{ __('Vuoi eliminare questo utente?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Elimina') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
