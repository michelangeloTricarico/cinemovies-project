<?php
// Controller used to view, add, modify a movies in admin interface
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use App\Models\Director;

class MovieController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'director_id' => 'nullable|exists:directors,id',
            'first_name' => 'required_without:director_id|string|max:255',
            'last_name' => 'required_without:director_id|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|image|max:2048',
            'trailer_url' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
        ]);

        if (!empty($validated['director_id'])) {
            $directorId = $validated['director_id'];
        } else {
            $director = Director::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'birth_date' => $validated['birth_date'] ?? null,
                'biography' => $validated['biography'] ?? null,
            ]);
            $directorId = $director->id;
        }

        $posterPath = $request->hasFile('poster')
            ? Storage::disk('public')->putFile('movies', $request->file('poster'))
            : null;

        Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'release_date' => $validated['release_date'] ?? null,
            'poster' => $posterPath,
            'trailer_url' => $validated['trailer_url'] ?? null,
            'genre' => $validated['genre'] ?? null,
            'director_id' => $directorId,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id){
        $movie = Movie::with('director')->findOrFail($id);
        $directors = Director::all();
        return view('admin.movies.edit', ['movie' => $movie, 'directors' => $directors]);
    }

    public function update(Request $request, $id){
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'director_id' => 'nullable|exists:directors,id',
            'first_name' => 'required_without:director_id|string|max:255',
            'last_name' => 'required_without:director_id|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|image|max:2048',
            'trailer_url' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
        ]);

        if (!empty($validated['director_id'])) {
            $directorId = $validated['director_id'];
        } else {
            $director = Director::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'birth_date' => $validated['birth_date'] ?? null,
                'biography' => $validated['biography'] ?? null,
            ]);
            $directorId = $director->id;
        }

        $posterPath = $movie->poster;
        if ($request->hasFile('poster')) {
            $posterPath = Storage::disk('public')->putFile('movies', $request->file('poster'));
        }

        $movie->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'release_date' => $validated['release_date'] ?? null,
            'poster' => $posterPath,
            'trailer_url' => $validated['trailer_url'] ?? null,
            'genre' => $validated['genre'] ?? null,
            'director_id' => $directorId,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('dashboard');
    }
    
}
