<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Director;

class MovieController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
        ]);

        $director = Director::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'birth_date' => $validated['birth_date'] ?? null,
            'biography' => $validated['biography'] ?? null,
        ]);

        Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'release_date' => $validated['release_date'] ?? null,
            'poster' => $validated['poster'] ?? null,
            'trailer_url' => $validated['trailer_url'] ?? null,
            'genre' => $validated['genre'] ?? null,
            'director_id' => $director->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id){
        $movie = Movie::with('director')->findOrFail($id);
        return view('admin.movies.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id){
        $movie = Movie::with('director')->findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|string|max:255',
            'trailer_url' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
        ]);

        $movie->director->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'birth_date' => $validated['birth_date'] ?? null,
            'biography' => $validated['biography'] ?? null,
        ]);

        $movie->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'release_date' => $validated['release_date'] ?? null,
            'poster' => $validated['poster'] ?? null,
            'trailer_url' => $validated['trailer_url'] ?? null,
            'genre' => $validated['genre'] ?? null,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('dashboard');
    }
}
