@extends('layouts.app')

@section('title', 'Edit Team - LUCSC Festival')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 transform transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Edit Team</h2>
                <a href="{{ route('teams.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                    Back to Teams
                </a>
            </div>

            <form action="{{ route('teams.update', $team->slug) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Team Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $team->slug) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            required>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Team Logo</label>
                        <div class="mt-2">
                            <div class="flex items-center space-x-6">
                                <div
                                    class="h-24 w-24 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden shadow-md">
                                    @if ($team->logo && Storage::disk('public')->exists($team->logo))
                                        <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}"
                                            class="h-full w-full object-cover transition-transform duration-300 hover:scale-110"
                                            onerror="this.parentElement.innerHTML='<div class=\'text-gray-500 text-3xl font-medium\'>{{ substr($team->name, 0, 1) }}</div>'">
                                    @else
                                        <div class="text-gray-500 text-3xl font-medium">{{ substr($team->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="logo" id="logo"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        accept="image/*">
                                    <p class="mt-2 text-sm text-gray-500">Upload a new logo to replace the current one</p>
                                </div>
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="transform transition-all duration-200 hover:scale-[1.01]">
                            <label for="games_played" class="block text-sm font-medium text-gray-700 mb-2">Games
                                Played</label>
                            <input type="number" name="games_played" id="games_played"
                                value="{{ old('games_played', $team->games_played) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                min="0" required>
                            @error('games_played')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="transform transition-all duration-200 hover:scale-[1.01]">
                            <label for="wins" class="block text-sm font-medium text-gray-700 mb-2">Wins</label>
                            <input type="number" name="wins" id="wins" value="{{ old('wins', $team->wins) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                min="0" max="{{ old('games_played', $team->games_played) }}" required>
                            @error('wins')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="transform transition-all duration-200 hover:scale-[1.01]">
                            <label for="points" class="block text-sm font-medium text-gray-700 mb-2">Points</label>
                            <input type="number" name="points" id="points" value="{{ old('points', $team->points) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                min="0" required>
                            @error('points')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('teams.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
