<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
        ]);

        Director::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit($id){
        $director = Director::find($id);
        return view('admin.directors.edit', ['director' => $director]);
    }

    public function update(Request $request, $id){
        $director = Director::find($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'biography' => 'nullable|string',
        ]);

        $director->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroy($id){
        $director = Director::find($id);
        $director->delete();

        return redirect()->route('dashboard');
    }
}
