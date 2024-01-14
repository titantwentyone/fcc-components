<x-fccc::columns
        column_count="{{ $data['column_number'] }}"
        contained="{{ $data['contained'] ?? false }}"
        expand_left="{{ $data['expand_left'] ?? false }}"
        expand_right="{{ $data['expand_right'] ?? false }}"
        gapped="{{ $data['gapped'] ?? false}}"
        virtual_column_count="{{ $data['virtual_column_number'] }}"
        collapse_left_margin="{{ (bool)$data['collapse_left_margin'] ?? false}}"
        collapse_right_margin="{{ (bool)$data['collapse_right_margin'] ?? false}}"
>
    @foreach(range(1, $data['column_number']) as $column)
        <x-fccc::columns.column
                collapsed="{{ $data['collapsed']['collapsed_'.$column] ?? false}}"
                background="{{ $data['background']['background_'.$column] ?? false}}"
                class="{{ $data['classes']['classes_'.$column] ?? false}}"
                span="{{ $data['span']['span_'.$column] ?? 1}}"
        >
            @foreach($data['columns']['content_'.$column] as $component)
                {!! parseContentComponent($component) !!}
            @endforeach
        </x-fccc::columns.column>
    @endforeach
</x-fccc::columns>