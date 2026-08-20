<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-3 bg-light d-flex align-items-center justify-content-center p-3">
            <img
                src="{{ $movie->poster ? asset('storage/' . $movie->poster) : 'https://placehold.co/400x600?text=CineMovies' }}"
                alt="{{ $movie->title }}"
                class="img-fluid"
                style="max-height: 220px; object-fit: contain;">
        </div>
        <div class="col-md-9">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h4 class="fs-5">{{ $movie->title }}</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-dark btn-sm">{{ __('Modifica') }}</a>
                        <form method="POST" action="{{ route('movies.destroy', $movie->id) }}" onsubmit="return confirm('{{ __('Vuoi eliminare questo film?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Elimina') }}</button>
                        </form>
                    </div>
                </div>
                <p class="text-secondary mb-1"><strong>{{ __('Genere') }}:</strong> {{ $movie->genre }}</p>
                <p class="text-secondary mb-1"><strong>{{ __('Uscita') }}:</strong> {{ $movie->release_date }}</p>
                <p class="text-secondary mb-1">
                    <strong>{{ __('Regista') }}:</strong>
                    {{ $movie->director ? $movie->director->first_name . ' ' . $movie->director->last_name : 'N/D' }}
                </p>
                <p class="mb-0">{{ $movie->description }}</p>
            </div>
        </div>
    </div>
</div>
