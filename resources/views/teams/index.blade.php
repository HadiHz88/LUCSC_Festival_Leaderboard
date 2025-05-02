@extends('layouts.app')

@section('title', 'Teams - LUCSC Festival')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 transform transition-all duration-300 hover:shadow-xl">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Teams</h1>
                <a href="{{ route('teams.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                    Create New Team
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($teams as $team)
                    <div
                        class="bg-white rounded-lg shadow-md p-6 transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02]">
                        <div class="flex items-center space-x-4 mb-4">
                            <div
                                class="h-16 w-16 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden shadow-sm">
                                @if ($team->logo && Storage::disk('public')->exists($team->logo))
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}"
                                        class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                                        onerror="this.parentElement.innerHTML='<div class=\'text-gray-500 text-2xl font-medium\'>{{ substr($team->name, 0, 1) }}</div>'">
                                @else
                                    <div class="text-gray-500 text-2xl font-medium">{{ substr($team->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $team->name }}</h3>
                                <p class="text-sm text-gray-500">Slug: {{ $team->slug }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Games Played</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $team->games_played }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Wins</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $team->wins }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Points</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $team->points }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <form action="{{ route('teams.destroy', $team->slug) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:scale-105"
                                    onclick="return confirm('Are you sure you want to delete this team?')">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('teams.edit', $team->slug) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                                Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
