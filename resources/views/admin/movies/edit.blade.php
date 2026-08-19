@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="fs-4 text-secondary mb-4">
        {{ __('Modifica film') }}
    </h2>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                @csrf
                @method('PUT')

                <h4 class="fs-6 text-secondary mt-3">{{ __('Regista') }}</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Nome') }}</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $movie->director->first_name ?? '') }}">
                        @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Cognome') }}</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $movie->director->last_name ?? '') }}">
                        @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Data di nascita') }}</label>
                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $movie->director->birth_date ?? '') }}">
                        @error('birth_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('Biografia') }}</label>
                        <textarea name="biography" class="form-control @error('biography') is-invalid @enderror" rows="3">{{ old('biography', $movie->director->biography ?? '') }}</textarea>
                        @error('biography') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <h4 class="fs-6 text-secondary mt-4">{{ __('Film') }}</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Titolo') }}</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $movie->title) }}">
                        @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Genere') }}</label>
                        <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre', $movie->genre) }}">
                        @error('genre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Data di uscita') }}</label>
                        <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date', $movie->release_date) }}">
                        @error('release_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Poster (percorso in storage)') }}</label>
                        <input type="text" name="poster" class="form-control @error('poster') is-invalid @enderror" value="{{ old('poster', $movie->poster) }}" placeholder="movies/nome-file.jpg">
                        @error('poster') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('URL trailer') }}</label>
                        <input type="text" name="trailer_url" class="form-control @error('trailer_url') is-invalid @enderror" value="{{ old('trailer_url', $movie->trailer_url) }}">
                        @error('trailer_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('Descrizione') }}</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $movie->description) }}</textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-dark">{{ __('Salva modifiche') }}</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">{{ __('Annulla') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
