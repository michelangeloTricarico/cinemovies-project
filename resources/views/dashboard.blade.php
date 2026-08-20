@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="fs-4 text-secondary mb-4">
        {{ __('Dashboard') }}
    </h2>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <ul class="nav nav-tabs mb-4" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="movies-tab" data-bs-toggle="tab" data-bs-target="#movies-pane" type="button" role="tab">Movies</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab">Reviews</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab">Users</button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabsContent">

        {{-- MOVIES --}}
        <div class="tab-pane fade show active" id="movies-pane" role="tabpanel">

            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title fs-5">{{ __('Aggiungi un film') }}</h3>

                    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                        @csrf

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
                                    data-biography="{{ $director->biography }}">
                                    {{ $director->first_name }} {{ $director->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="director_id" id="director-id-input">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Nome') }}</label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                                @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Cognome') }}</label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
                                @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Data di nascita') }}</label>
                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                                @error('birth_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Biografia') }}</label>
                                <textarea name="biography" class="form-control @error('biography') is-invalid @enderror" rows="3">{{ old('biography') }}</textarea>
                                @error('biography') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <h4 class="fs-6 text-secondary mt-4">{{ __('Film') }}</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Titolo') }}</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Genere') }}</label>
                                <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre') }}">
                                @error('genre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Data di uscita') }}</label>
                                <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date') }}">
                                @error('release_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Poster') }}</label>
                                <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror" accept="image/*">
                                @error('poster') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('URL trailer') }}</label>
                                <input type="text" name="trailer_url" class="form-control @error('trailer_url') is-invalid @enderror" value="{{ old('trailer_url') }}">
                                @error('trailer_url') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Descrizione') }}</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark mt-4">{{ __('Salva film') }}</button>
                    </form>
                </div>
            </div>

            @foreach ($movies as $movie)
                <x-movieCard :movie="$movie" />
            @endforeach
        </div>

        {{-- REVIEWS --}}
        <div class="tab-pane fade" id="reviews-pane" role="tabpanel">
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
        </div>

        {{-- USERS --}}
        <div class="tab-pane fade" id="users-pane" role="tabpanel">
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
