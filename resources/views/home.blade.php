
@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- Welcome Section --}}
    <div class="mb-5">
        <h2 class="fw-bold">Discover and Manage Your Favorite Movies</h2>
        <p class="text-muted">
            Browse our movie collection, explore different genres,
            and keep track of your favorite films.
        </p>
    </div>

    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="text-muted mb-2">Total Movies</p>
                    <h2 class="fw-bold mb-0">{{ $movieCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <p class="text-muted mb-2">Total Genres</p>
                    <h2 class="fw-bold mb-0">{{ $genreCount }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Browse Movies Button --}}
    <div class="mb-5">
        <a href="{{ route('movies.index') }}" class="btn btn-primary px-4 py-2">
            Browse Movies
        </a>
    </div>

    <hr class="my-5">

    {{-- Student Profile --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">About the Developer</h4>

            <div class="d-flex align-items-center gap-4 flex-wrap">

                <img src="{{ asset('img/profile.jpeg') }}"
                     width="110"
                     height="110"
                     class="rounded-circle"
                     style="object-fit: cover;"
                     alt="My Profile Photo">

                <div>
                    <h5 class="fw-bold mb-2">Keyan Jaoric V. Rima</h5>

                    <p class="text-muted mb-1">
                        BS Information Technology
                    </p>

                    <p class="text-muted mb-0">
                        4th Year - Block A
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
