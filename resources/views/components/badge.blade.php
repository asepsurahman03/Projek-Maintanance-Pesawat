@props(['color' => 'blue', 'size' => 'sm'])
{{-- Badge component --}}
@php
$colors = [
    'blue'   => 'badge-blue',
    'green'  => 'badge-green',
    'amber'  => 'badge-amber',
    'red'    => 'badge-red',
    'slate'  => 'badge-slate',
    'sky'    => 'badge bg-sky-100 text-sky-800 dark:bg-sky-900 dark:text-sky-200',
    'purple' => 'badge bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
    'orange' => 'badge bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
    'teal'   => 'badge bg-teal-100 text-teal-800 dark:bg-teal-900 dark:text-teal-200',
];
$cls = $colors[$color] ?? 'badge-slate';
@endphp
<span {{ $attributes->merge(['class' => $cls]) }}>{{ $slot }}</span>
