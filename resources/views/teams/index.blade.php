@extends('layouts.app')

@section('title', 'Teams - LUCSC Festival')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Teams</h1>
        <x-button onclick="openCreateTeamModal()">
            Create New Team
        </x-button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($teams as $team)
            <x-team-card :team="$team" />
        @endforeach
    </div>
@endsection

@push('modals')
    <x-modal id="teamModal" title="Team Details" closeFunction="closeTeamModal">
        <div id="teamModalContent">
            <!-- Content will be loaded dynamically -->
        </div>
    </x-modal>

    <x-modal id="createTeamModal" title="Create New Team" closeFunction="closeCreateTeamModal">
        <form id="createTeamForm" action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Team Name</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Team Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="mt-1 block w-full">
                </div>
                <div class="flex justify-end space-x-4">
                    <x-button variant="secondary" type="button" onclick="closeCreateTeamModal()">
                        Cancel
                    </x-button>
                    <x-button type="submit">
                        Create Team
                    </x-button>
                </div>
            </div>
        </form>
    </x-modal>
@endpush

@push('scripts')
    <script>
        function openTeamModal(slug) {
            fetch(`/teams/${slug}/modal`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('teamModalContent').innerHTML = html;
                    document.getElementById('teamModal').classList.remove('hidden');
                });
        }

        function closeTeamModal() {
            document.getElementById('teamModal').classList.add('hidden');
        }

        function openCreateTeamModal() {
            document.getElementById('createTeamModal').classList.remove('hidden');
        }

        function closeCreateTeamModal() {
            document.getElementById('createTeamModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const teamModal = document.getElementById('teamModal');
            const createTeamModal = document.getElementById('createTeamModal');

            if (event.target === teamModal) {
                closeTeamModal();
            }
            if (event.target === createTeamModal) {
                closeCreateTeamModal();
            }
        }
    </script>
@endpush
