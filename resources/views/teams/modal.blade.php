@extends('layouts.app')

@section('title', 'Edit Team - LUCSC Festival')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Team</h2>

            <form action="{{ route('teams.update', $team->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Team Name</label>
                    <input type="text" name="name" id="name" value="{{ $team->name }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ $team->slug }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-4">
                    <label for="games_played" class="block text-sm font-medium text-gray-700 mb-1">Games Played</label>
                    <input type="number" name="games_played" id="games_played" value="{{ $team->games_played }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        min="0" required>
                </div>

                <div class="mb-4">
                    <label for="wins" class="block text-sm font-medium text-gray-700 mb-1">Wins</label>
                    <input type="number" name="wins" id="wins" value="{{ $team->wins }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        min="0" max="{{ $team->games_played }}" required>
                </div>

                <div class="mb-4">
                    <label for="points" class="block text-sm font-medium text-gray-700 mb-1">Points</label>
                    <input type="number" name="points" id="points" value="{{ $team->points }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        min="0" required>
                </div>

                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Team Logo</label>
                    <input type="file" name="logo" id="logo"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/*">
                    <div class="mt-2">
                        <div class="flex items-center space-x-4">
                            <div
                                class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                                @if ($team->logo && Storage::disk('public')->exists($team->logo))
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}"
                                        class="h-full w-full object-cover"
                                        onerror="this.parentElement.innerHTML='<div class=\'text-gray-400 text-2xl\'>{{ substr($team->name, 0, 1) }}</div>'">
                                @else
                                    <div class="text-gray-400 text-2xl">{{ substr($team->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="text-sm text-gray-500">
                                Current logo will be replaced when a new one is uploaded
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('teams.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
