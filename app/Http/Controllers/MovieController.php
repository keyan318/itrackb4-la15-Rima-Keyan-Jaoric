<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

 
class MovieController extends Controller
{
 
public function index(Request $request)
{
    DB::enableQueryLog();

    $search = $request->query('search');
    $genre = $request->query('genre');
    $featured = $request->query('featured');

    // Get the requested sort column
    $sort = $request->query('sort', 'title');

    // Allow only approved columns
    $allowedSorts = ['title', 'year'];

    if (!in_array($sort, $allowedSorts, true)) {
        $sort = 'title';
    }

    $genres = Genre::all();

    DB::flushQueryLog();

    $query = Movie::with('genre');

    // Search by movie title
    if ($search) {
        $query->where('title', 'like', "%{$search}%");
    }

    // Filter by genre
    if ($genre) {
        $query->where('genre_id', $genre);
    }

    // Filter by featured status
    if ($featured !== null && $featured !== '') {
        $query->where('is_featured', $featured);
    }

    // Sort, paginate, and preserve URL parameters
    $items = $query->orderBy($sort)
        ->paginate(6)
        ->withQueryString();

    return view('movies.index', compact(
        'items',
        'genres',
        'search',
        'genre',
        'featured',
        'sort'
    ));
}


    public function create()
    {  
        Gate::authorize('create', Movie::class);
         $genres= Genre::all();

        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Movie::class);
        $validated=$request->validate([
            'title' =>'required|string|min:5|max:100',
            'genre_id' =>'required|exists:genres,id',
            'year' =>'required|integer|min:1888|max:2100',
            'director'=>['required','string','min:5','max:100','regex:/^[A-Za-z .,\'-]+$/'],
            'rating'=>'required|numeric|min:0|max:10',
            'duration'=>['required','regex:/^\d{1,2}h\s?\d{1,2}m$/'],
        ],[
            'title.min' =>'The title must be at least 5 characters.',
            'title.max' =>'The title must not be longer than 100 characters.',
            'director.min' =>'The director must be at least 5 characters.',
            'director.regex' =>'The director may only contain letters, spaces, periods, commas, apostrophes and hyphens.',
            'duration.regex' =>'The duration must look like 2h 28m.',
        ]);

        $validated['year']=(int)$validated['year'];
        $validated['rating']=(float)$validated['rating'];

        $movie = Movie::create($validated);

         Log::info('Movie saved', [
        'id' => $movie->id,
        ]);

    return redirect()
    ->route('movies.index')
    ->with('success', 'Movie added successfully.');
    }

   public function show(Movie $movie)
{
    return view('movies.show', ['item' => $movie]);
}

    public function edit(Movie $movie)
   {
    Gate::authorize('update', $movie);
    $genres = Genre::all();
    return view('movies.edit', compact('movie', 'genres'));
   }

    public function update(Request $request, Movie $movie)
    {
    Gate::authorize('update', $movie);
    $validated = $request->validate([
        'title' => 'required|string|min:5|max:100',
        'genre_id' => 'required|exists:genres,id',
        'year' => 'required|integer|min:1888|max:2100',
        'director' => ['required','string','min:5','max:100','regex:/^[A-Za-z .,\'-]+$/'],
        'rating' => 'required|numeric|min:0|max:10',
        'duration' => ['required','regex:/^\d{1,2}h\s?\d{1,2}m$/'],
    ], [
        'title.min' => 'The title must be at least 5 characters.',
        'title.max' => 'The title must not be longer than 100 characters.',
        'director.min' => 'The director must be at least 5 characters.',
        'director.regex' => 'The director may only contain letters, spaces, periods, commas, apostrophes and hyphens.',
        'duration.regex' => 'The duration must look like 2h 28m.',
    ]);

    $validated['year'] = (int) $validated['year'];
    $validated['rating'] = (float) $validated['rating'];

    $movie->update($validated);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

   
public function destroy(Movie $movie)
{
    Gate::authorize('delete', $movie);
    abort_if($movie->genre->movies()->count() === 1, 403);

    $movie->delete();

    return redirect()->route('movies.index');
}

    public function featured()
    {
        $item = Movie::where('is_featured', true)->firstOrFail();
        return view('movies.show', ['item' => $item]);
    }
}
