@props(['id', 'title', 'closeFunction' => 'closeModal'])

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">{{ $title }}</h2>
                <button onclick="{{ $closeFunction }}()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
