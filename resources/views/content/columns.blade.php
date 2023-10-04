<x-columns
        column_count="{{ $data['column_number'] }}"
        contained="{{ $data['contained'] ?? false }}"
        expand_left="{{ $data['expand_left'] ?? false }}"
        expand_right="{{ $data['expand_right'] ?? false }}"
        gapped="{{ $data['gapped'] ?? false}}"
>
    @foreach(range(1, $data['column_number']) as $column)
        <x-columns.column
                collapsed="{{ $data['collapsed']['collapsed_'.$column] ?? false}}"
                background="{{ $data['background']['background_'.$column] ?? false}}"
        >
            @foreach($data['columns']['content_'.$column] as $component)
                {!! parseContentComponent($component) !!}
            @endforeach
        </x-columns.column>
    @endforeach
</x-columns>