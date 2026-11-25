
@extends('layouts.app')

@section('title', 'Movie List')

@section('content')

    {{-- Page heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Movie List</h2>

        @can('create', App\Models\Movie::class)
            <a href="{{ route('movies.create') }}" class="btn btn-primary">
                + Add Movie
            </a>
        @endcan
    </div>

    {{-- Read-only message --}}
    @cannot('create', App\Models\Movie::class)
        <p>You are viewing the movies in read-only mode.</p>
    @endcannot

    {{-- Search, Filters, and Sorting --}}
    <form method="GET" action="{{ route('movies.index') }}" class="mb-4">

        <div class="row g-2 align-items-center">

            {{-- Search --}}
            <div class="col-lg-3 col-md-12">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search movies..."
                    value="{{ $search }}"
                >
            </div>

            {{-- Genre Filter --}}
            <div class="col-lg-2 col-md-4">
                <select name="genre" class="form-select">
                    <option value="">All genres</option>

                    @foreach ($genres as $g)
                        <option
                            value="{{ $g->id }}"
                            @selected((string)$genre === (string)$g->id)
                        >
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Featured Filter --}}
            <div class="col-lg-2 col-md-4">
                <select name="featured" class="form-select">
                    <option value="">Any</option>

                    <option value="1" @selected($featured === '1')>
                        Featured
                    </option>

                    <option value="0" @selected($featured === '0')>
                        Not Featured
                    </option>
                </select>
            </div>

            {{-- Sorting --}}
            <div class="col-lg-2 col-md-4">
                <select name="sort" class="form-select">
                    <option value="title" @selected($sort === 'title')>
                        Sort by Title
                    </option>

                    <option value="year" @selected($sort === 'year')>
                        Sort by Year
                    </option>
                </select>
            </div>

            {{-- Apply and Clear --}}
            <div class="col-lg-3 col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    Apply
                </button>

                <a href="{{ route('movies.index') }}"
                   class="btn btn-outline-secondary">
                    Clear
                </a>
            </div>

        </div>
    </form>

    {{-- Movies Table --}}
    <div class="table-responsive">

        <table class="table table-striped table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Director</th>
                    <th>Rating</th>
                    <th>Duration</th>

                    @can('create', App\Models\Movie::class)
                        <th>Actions</th>
                    @endcan
                </tr>
            </thead>

            <tbody>
                @forelse ($items as $movie)

                    <tr>
                        <td>{{ $items->firstItem() + $loop->index }}</td>

                        <td>
                            <a href="{{ route('movies.show', $movie) }}"
                               class="fw-bold text-decoration-none">
                                {{ $movie->title }}
                            </a>
                        </td>

                        <td>{{ $movie->genre->name ?? '—' }}</td>

                        <td>{{ $movie->year }}</td>

                        <td>{{ $movie->director }}</td>

                        <td>
                            {{ $movie->rating }}

                            @if ($movie->rating >= 8.5)
                                <span class="badge bg-success">
                                    Top Rated
                                </span>
                            @endif
                        </td>

                        <td>{{ $movie->duration }}</td>

                        @can('create', App\Models\Movie::class)
                            <td>
                                <div class="d-flex gap-1">

                                    @can('update', $movie)
                                        <a href="{{ route('movies.edit', $movie) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $movie)
                                        <form action="{{ route('movies.destroy', $movie) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this record?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        @endcan

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center py-4">
                            No movies found.
                        </td>
                    </tr>

                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $items->links() }}
    </div>

@endsection
