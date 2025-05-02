@props(['variant' => 'primary', 'type' => 'button'])

@php
    $baseClasses = 'px-4 py-2 rounded-lg transition-colors duration-200';
    $variantClasses = match ($variant) {
        'primary' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'secondary' => 'bg-gray-100 hover:bg-gray-200 text-gray-700',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        default => 'bg-gray-100 hover:bg-gray-200 text-gray-700',
    };
@endphp

<button {{ $attributes->merge(['class' => $baseClasses . ' ' . $variantClasses, 'type' => $type]) }}>
    {{ $slot }}
</button>
