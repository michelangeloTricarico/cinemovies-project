@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="fs-4 text-secondary mb-4">
        {{ __('Modifica film') }}
    </h2>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('movies.update', $movie->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h4 class="fs-6 text-secondary mt-3">{{ __('Regista') }}</h4>
                <div class="mb-3">
                    <label class="form-label">{{ __('Scegli un regista esistente o compila i campi sotto per crearne uno nuovo') }}</label>
                    <select id="director-select" class="form-select">
                        <option value="">{{ __('-- Nuovo regista --') }}</option>
                        @foreach ($directors as $director)
                        <option
                            value="{{ $director->id }}"
                            data-first-name="{{ $director->first_name }}"
                            data-last-name="{{ $director->last_name }}"
                            data-birth-date="{{ $director->birth_date }}"
                            data-biography="{{ $director->biography }}"
                            {{ $movie->director_id == $director->id ? 'selected' : '' }}>
                            {{ $director->first_name }} {{ $director->last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="director_id" id="director-id-input" value="{{ old('director_id', $movie->director_id) }}">

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
                        <label class="form-label">{{ __('Poster') }}</label>
                        @if ($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="d-block mb-2" style="max-height: 120px;">
                        @endif
                        <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror" accept="image/*">
                        <small class="text-secondary">{{ __('Lascia vuoto per non cambiare il poster attuale.') }}</small>
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

<script>
    document.getElementById('director-select').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const idInput = document.getElementById('director-id-input');
        const firstNameInput = document.querySelector('[name="first_name"]');
        const lastNameInput = document.querySelector('[name="last_name"]');
        const birthDateInput = document.querySelector('[name="birth_date"]');
        const biographyInput = document.querySelector('[name="biography"]');

        idInput.value = selected.value;
        firstNameInput.value = selected.dataset.firstName || '';
        lastNameInput.value = selected.dataset.lastName || '';
        birthDateInput.value = selected.dataset.birthDate || '';
        biographyInput.value = selected.dataset.biography || '';
    });
</script>
@endsection
