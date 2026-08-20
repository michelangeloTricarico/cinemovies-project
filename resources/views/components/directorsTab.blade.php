<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title fs-5">{{ __('Aggiungi un regista') }}</h3>

        <form method="POST" action="{{ route('directors.store') }}">
            @csrf

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

            <button type="submit" class="btn btn-dark mt-4">{{ __('Salva regista') }}</button>
        </form>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Nome') }}</th>
            <th>{{ __('Cognome') }}</th>
            <th>{{ __('Data di nascita') }}</th>
            <th>{{ __('Film') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($directors as $director)
        <tr>
            <td>{{ $director->first_name }}</td>
            <td>{{ $director->last_name }}</td>
            <td>{{ $director->birth_date ?? 'N/D' }}</td>
            <td>{{ $director->movies_count }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('directors.edit', $director->id) }}" class="btn btn-dark btn-sm">{{ __('Modifica') }}</a>
                    <form method="POST" action="{{ route('directors.destroy', $director->id) }}" onsubmit="return confirm('{{ __('Eliminando questo regista verranno eliminati anche tutti i suoi film e le relative recensioni. Continuare?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('Elimina') }}</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
