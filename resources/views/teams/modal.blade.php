@php
    $isEditMode = isset($editMode) && $editMode;
@endphp

<div class="space-y-6">
    @if ($isEditMode)
        <form id="editTeamForm" action="{{ route('teams.update', $team->slug) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Team
                        Name</label>
                    <input type="text" name="name" id="edit_name" value="{{ $team->name }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="edit_slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="edit_slug" value="{{ $team->slug }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="edit_logo" class="block text-sm font-medium text-gray-700">Team
                        Logo</label>
                    <input type="file" name="logo" id="edit_logo" accept="image/*" class="mt-1 block w-full">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Games Played</label>
                        <p class="mt-1 text-gray-900">{{ $team->games_played }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Points</label>
                        <p class="mt-1 text-gray-900">{{ $team->points }}</p>
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <x-button variant="secondary" type="button" onclick="closeTeamModal()">
                        Cancel
                    </x-button>
                    <x-button type="submit">
                        Save Changes
                    </x-button>
                </div>
            </div>
        </form>
    @else
        <div class="space-y-6">
            <div class="flex items-center space-x-4">
                @if ($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}"
                        class="w-24 h-24 rounded-full">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-4xl text-gray-500">{{ substr($team->name, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <h3 class="text-2xl font-bold">{{ $team->name }}</h3>
                    <p class="text-gray-600">Slug: {{ $team->slug }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Games Played</label>
                    <p class="mt-1 text-gray-900">{{ $team->games_played }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Points</label>
                    <p class="mt-1 text-gray-900">{{ $team->points }}</p>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <form action="{{ route('teams.destroy', $team->slug) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-button variant="danger" type="submit"
                        onclick="return confirm('Are you sure you want to delete this team?')">
                        Delete Team
                    </x-button>
                </form>
                <x-button onclick="loadEditForm('{{ $team->slug }}')">
                    Edit Team
                </x-button>
            </div>
        </div>
    @endif
</div>

<script>
    function loadEditForm(slug) {
        fetch(`/teams/${slug}/modal?edit=1`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('teamModalContent').innerHTML = html;
            });
    }
</script>
