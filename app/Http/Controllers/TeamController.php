<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        // Fetch all teams from the database
        $teams = Team::all();

        // Return the view with the teams data
        return view('teams.index', compact('teams'));
    }

    public function show($slug)
    {
        // Fetch the team by slug
        $team = Team::where('slug', $slug)->firstOrFail();

        // Return the view with the team data
        return view('teams.show', compact('team'));
    }

    public function modal($slug)
    {
        // Fetch the team by slug
        $team = Team::where('slug', $slug)->firstOrFail();

        // Check if we're in edit mode
        $editMode = request()->has('edit') && request()->query('edit') == '1';

        // Return the modal view with the team data
        return view('teams.modal', compact('team', 'editMode'));
    }

    public function create()
    {
        // Return the view to create a new team
        return view('teams.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:teams',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new team
        $team = new Team();
        $team->name = $request->name;
        $team->slug = $request->slug;
        $team->points = 0;
        $team->games_played = 0;
        $team->wins = 0;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('team-logos', 'public');
            $team->logo = $path;
        }

        $team->save();

        // Redirect to the team index with a success message
        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function edit($slug)
    {
        // Fetch the team by slug
        $team = Team::where('slug', $slug)->firstOrFail();

        // Return the view to edit the team
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, $slug)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:teams,slug,' . $slug,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fetch the team by slug
        $team = Team::where('slug', $slug)->firstOrFail();

        // Update the team
        $team->name = $request->name;
        $team->slug = $request->slug;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $path = $request->file('logo')->store('team-logos', 'public');
            $team->logo = $path;
        }

        $team->save();

        // Redirect to the team index with a success message
        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy($slug)
    {
        // Fetch the team by slug
        $team = Team::where('slug', $slug)->firstOrFail();

        // Delete the team's logo if it exists
        if ($team->logo) {
            Storage::disk('public')->delete($team->logo);
        }

        // Delete the team
        $team->delete();

        // Redirect to the team index with a success message
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}