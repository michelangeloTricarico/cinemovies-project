<table class="table">
    <thead>
        <tr>
            <th>{{ __('Film') }}</th>
            <th>{{ __('Utente') }}</th>
            <th>{{ __('Voto') }}</th>
            <th>{{ __('Commento') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reviews as $review)
        <tr>
            <td>{{ $review->movie->title ?? 'N/D' }}</td>
            <td>{{ $review->user->name ?? 'N/D' }}</td>
            <td>{{ $review->rating }}/5</td>
            <td>{{ $review->comment }}</td>
            <td>
                <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit="return confirm('{{ __('Vuoi eliminare questa recensione?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Elimina') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
