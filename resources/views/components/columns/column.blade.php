@props([
    'collapsed' => false,
    'background' => false,
    'class' => '',
    'span' => 1
])

@php
$span = match((int)$span) {
    2 => 'col-span-2',
    3 => 'col-span-3',
    default => 'col-span-1'
}
@endphp

<div
    @class([
        'space-y-8',
        'py-16' => !$collapsed,
        'bg-cover' => $background,
        $class,
        $span
])
    @if($background)
        @style([
            "background-image:url('".\RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem::find($background)->getItem()->getUrl('banner')."')" => (bool)$background
        ])
    @endif
>
    {{ $slot }}
</div>
