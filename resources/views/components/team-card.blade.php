@props(['team'])

<div onclick="openTeamModal('{{ $team->slug }}')"
    class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition-shadow">
    <div class="flex items-center space-x-4">
        @if ($team->logo)
            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-16 h-16 rounded-full">
        @else
            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">{{ substr($team->name, 0, 1) }}</span>
            </div>
        @endif
        <div>
            <h2 class="text-xl font-semibold">{{ $team->name }}</h2>
            <div class="flex space-x-4 mt-1">
                <span class="text-sm text-gray-600">
                    <span class="font-medium">Games:</span> {{ $team->games_played }}
                </span>
                <span class="text-sm text-gray-600">
                    <span class="font-medium">Points:</span> {{ $team->points }}
                </span>
            </div>
        </div>
    </div>
</div>
