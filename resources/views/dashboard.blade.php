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
            <button class="nav-link" id="directors-tab" data-bs-toggle="tab" data-bs-target="#directors-pane" type="button" role="tab">Directors</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab">Reviews</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-pane" type="button" role="tab">Users</button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabsContent">

        <div class="tab-pane fade show active" id="movies-pane" role="tabpanel">
            <x-moviesTab :movies="$movies" :directors="$directors" />
        </div>

        <div class="tab-pane fade" id="directors-pane" role="tabpanel">
            <x-directorsTab :directors="$directors" />
        </div>

        <div class="tab-pane fade" id="reviews-pane" role="tabpanel">
            <x-reviewsTab :reviews="$reviews" />
        </div>

        <div class="tab-pane fade" id="users-pane" role="tabpanel">
            <x-usersTab :users="$users" />
        </div>

    </div>
</div>
@endsection
