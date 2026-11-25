<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $action = Genre::firstOrCreate(['name' => 'Action']);
        $scifi = Genre::firstOrCreate(['name' => 'Science Fiction']);
        $hero = Genre::firstOrCreate(['name' => 'Superhero']);

        $movies = [
            [
                'title' => 'The Matrix',
                'genre_id' => $scifi->id,
                'year' => 1999,
                'director' => 'Lana Wachowski, Lilly Wachowski',
                'rating' => 8.7,
                'duration' => '2h 16m',
                'is_featured' => true,
            ],
            [
                'title' => 'The Dark Knight',
                'genre_id' => $action->id,
                'year' => 2008,
                'director' => 'Christopher Nolan',
                'rating' => 9.0,
                'duration' => '2h 32m',
            ],
            [
                'title' => 'Inception',
                'genre_id' => $scifi->id,
                'year' => 2010,
                'director' => 'Christopher Nolan',
                'rating' => 8.8,
                'duration' => '2h 28m',
            ],
            [
                'title' => 'Interstellar',
                'genre_id' => $scifi->id,
                'year' => 2014,
                'director' => 'Christopher Nolan',
                'rating' => 8.7,
                'duration' => '2h 49m',
            ],
            [
                'title' => 'Spider-Man: No Way Home',
                'genre_id' => $hero->id,
                'year' => 2021,
                'director' => 'Jon Watts',
                'rating' => 8.2,
                'duration' => '2h 28m',
            ],
            [
                'title' => 'Avengers: Doomsday',
                'genre_id' => $hero->id,
                'year' => 2026,
                'director' => 'Anthony Russo, Joe Russo',
                'rating' => null,
                'duration' => '2h 30m',
            ],
            [
                'title' => 'John Wick',
                'genre_id' => $action->id,
                'year' => 2014,
                'director' => 'Chad Stahelski',
                'rating' => 7.4,
                'duration' => '1h 41m',
            ],
            [
                'title' => 'Mad Max: Fury Road',
                'genre_id' => $action->id,
                'year' => 2015,
                'director' => 'George Miller',
                'rating' => 8.1,
                'duration' => '2h 00m',
            ],
            [
                'title' => 'Gladiator',
                'genre_id' => $action->id,
                'year' => 2000,
                'director' => 'Ridley Scott',
                'rating' => 8.5,
                'duration' => '2h 35m',
            ],
            [
                'title' => 'Top Gun: Maverick',
                'genre_id' => $action->id,
                'year' => 2022,
                'director' => 'Joseph Kosinski',
                'rating' => 8.2,
                'duration' => '2h 10m',
            ],
            [
                'title' => 'Blade Runner 2049',
                'genre_id' => $scifi->id,
                'year' => 2017,
                'director' => 'Denis Villeneuve',
                'rating' => 8.0,
                'duration' => '2h 44m',
            ],
            [
                'title' => 'Dune',
                'genre_id' => $scifi->id,
                'year' => 2021,
                'director' => 'Denis Villeneuve',
                'rating' => 8.0,
                'duration' => '2h 35m',
            ],
            [
                'title' => 'Arrival',
                'genre_id' => $scifi->id,
                'year' => 2016,
                'director' => 'Denis Villeneuve',
                'rating' => 7.9,
                'duration' => '1h 56m',
            ],
            [
                'title' => 'The Avengers',
                'genre_id' => $hero->id,
                'year' => 2012,
                'director' => 'Joss Whedon',
                'rating' => 8.0,
                'duration' => '2h 23m',
            ],
            [
                'title' => 'Black Panther',
                'genre_id' => $hero->id,
                'year' => 2018,
                'director' => 'Ryan Coogler',
                'rating' => 7.3,
                'duration' => '2h 14m',
            ],
            [
                'title' => 'Iron Man',
                'genre_id' => $hero->id,
                'year' => 2008,
                'director' => 'Jon Favreau',
                'rating' => 7.9,
                'duration' => '2h 06m',
            ],
            [
                'title' => 'Doctor Strange',
                'genre_id' => $hero->id,
                'year' => 2016,
                'director' => 'Scott Derrickson',
                'rating' => 7.5,
                'duration' => '1h 55m',
            ],
            [
                'title' => 'Deadpool',
                'genre_id' => $hero->id,
                'year' => 2016,
                'director' => 'Tim Miller',
                'rating' => 8.0,
                'duration' => '1h 48m',
            ],
            [
                'title' => 'Tenet',
                'genre_id' => $scifi->id,
                'year' => 2020,
                'director' => 'Christopher Nolan',
                'rating' => 7.3,
                'duration' => '2h 30m',
            ],
            [
                'title' => 'Mission: Impossible - Fallout',
                'genre_id' => $action->id,
                'year' => 2018,
                'director' => 'Christopher McQuarrie',
                'rating' => 7.7,
                'duration' => '2h 27m',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::firstOrCreate(
                ['title' => $movie['title']],
                $movie
            );
        }
    }
}