@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="fs-4 text-secondary mb-4">
        {{ __('Modifica regista') }}
    </h2>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('directors.update', $director->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Nome') }}</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $director->first_name) }}">
                        @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Cognome') }}</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $director->last_name) }}">
                        @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Data di nascita') }}</label>
                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $director->birth_date) }}">
                        @error('birth_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('Biografia') }}</label>
                        <textarea name="biography" class="form-control @error('biography') is-invalid @enderror" rows="3">{{ old('biography', $director->biography) }}</textarea>
                        @error('biography') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
