@php
    $socialLinks = config("socialLink");
@endphp

<footer class="bg-light border-top py-3 mt-4 px-4">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <p class="mb-0 text-secondary">© {{ date('Y') }} CineMovies Spa</p>

        <div class="d-flex gap-2">
            @foreach ($socialLinks as $social)
            <a href="#" aria-label="{{ $social['label'] }}" class="d-flex align-items-center justify-content-center rounded-circle bg-dark text-white" style="width: 2.5rem; height: 2.5rem;"> <i class="bi {{ $social['icon'] }}"></i></a>
            @endforeach
        </div>
    </div>
</footer>
