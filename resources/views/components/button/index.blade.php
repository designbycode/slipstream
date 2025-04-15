@props([
    'type' => 'submit',
    'variant' => 'solid', // solid, outline, ghost
    'color' => 'primary', // primary, secondary, danger, info, warning
    'size' => 'md', // sm, md, lg
])

@php
    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200';

    // Size classes
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        'xl' => 'px-8 py-3 text-lg',
    ][$size];

    // Color classes for solid variant
    $solidColors = [
        'primary' => 'border border-primary-600 bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
        'secondary' => 'border border-gray-600 bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'danger' => 'border border-red-600 bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'info' => 'border border-blue-600 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        'warning' => 'border border-yellow-600 bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500',
    ];

    // Color classes for outline variant
    $outlineColors = [
        'primary' => 'border border-primary-500 text-primary-600 hover:bg-primary-50 focus:ring-primary-200',
        'secondary' => 'border border-gray-500 text-gray-600 hover:bg-gray-50 focus:ring-gray-200',
        'danger' => 'border border-red-500 text-red-600 hover:bg-red-50 focus:ring-red-200',
        'info' => 'border border-blue-500 text-blue-600 hover:bg-blue-50 focus:ring-blue-200',
        'warning' => 'border border-yellow-500 text-yellow-600 hover:bg-yellow-50 focus:ring-yellow-200',
    ];

    // Color classes for ghost variant
    $ghostColors = [
        'primary' => 'border border-transparent text-primary-600 hover:bg-primary-50 focus:ring-primary-200 disabled:opacity-75',
        'secondary' => 'border border-transparent text-gray-600 hover:bg-gray-50 focus:ring-gray-200 disabled:opacity-75',
        'danger' => 'border border-transparent text-red-600 hover:bg-red-50 focus:ring-red-200 disabled:opacity-75',
        'info' => 'border border-transparent text-blue-600 hover:bg-blue-50 focus:ring-blue-200 disabled:opacity-75',
        'warning' => 'border border-transparent text-yellow-600 hover:bg-yellow-50 focus:ring-yellow-200 disabled:opacity-75',
    ];

    // Variant classes
    $variantClasses = [
        'solid' => $solidColors[$color] ?? $solidColors['primary'],
        'outline' => $outlineColors[$color] ?? $outlineColors['primary'],
        'ghost' => $ghostColors[$color] ?? $ghostColors['primary'],
    ][$variant];

    // Combine all classes
    $classes = "$baseClasses $sizeClasses $variantClasses";
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
