@props([
    'collapsed' => false,
    'background' => false
])
<div
    @class([
        'space-y-8',
        'py-16' => !$collapsed,
        'bg-cover' => $background
])
    @if($background)
        @style([
            "background-image:url('".\RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem::find($background)->getItem()->getUrl('banner')."')" => (bool)$background
        ])
    @endif
>
    {{ $slot }}
</div>
