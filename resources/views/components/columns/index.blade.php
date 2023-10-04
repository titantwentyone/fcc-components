{{--@props([--}}
{{--    'count',--}}
{{--    'contained',--}}
{{--    'buffer_left' => true,--}}
{{--    'buffer_right' => false--}}
{{--])--}}

{{--@php--}}
{{--    $cols = match($count) {--}}
{{--        '2'  => 'grid-cols-2',--}}
{{--        '3'  => 'grid-cols-3',--}}
{{--        default => 'grid-cols-4'--}}
{{--    };--}}

{{--    $grid_template_area = match($count) {--}}
{{--        '2'  => 'grid-cols-2',--}}
{{--        '3'  => 'grid-cols-3',--}}
{{--        default => 'grid-cols-4'--}}
{{--    };--}}

{{--    if($buffer_left && !$contained) {--}}
{{--        $cols = match($count) {--}}
{{--            '2'  => 'grid-cols-[1fr_50%_50%_1fr] [&>div:first-child]:col-start-2',--}}
{{--            '3'  => 'grid-cols-3',--}}
{{--            default => 'grid-cols-4'--}}
{{--        };--}}
{{--    }--}}
{{--@endphp--}}
{{--<div @class([--}}
{{--        'grid gap-16',--}}
{{--        'container mx-auto' => $contained,--}}
{{--//        'mx-16' => !$contained,--}}
{{--//        'ml-[auto] w-[calc(100%-16rem)] [&_>_div:first]:w-1/4' => !$contained && $buffer_left,--}}
{{--        $cols--}}
{{--    ])>--}}
{{--    {{ $slot }}--}}
{{--</div>--}}
@props([
    'column_count' => 2,
    'contained' => true,
    'expand_left' => false,
    'expand_right' => false,
    'gapped' => true
])
@php
    //ensure expand options are disabled when contained
    if($contained) {
        $expand_left = false;
        $expand_right = false;
    }

    $column_count_css_var = match($column_count) {
        '2' => !($expand_left || $expand_right) ? 'grid-cols-2' : "[--container-columns:2]",
        '3' => !($expand_left || $expand_right)  ? 'grid-cols-3' :"[--container-columns:3]",
        default => !($expand_left || $expand_right)  ? 'grid-cols-4' :"[--container-columns:4]"
    };
@endphp
<div class='relative @container'>
    <div @class([
        'grid',
        'gap-16' => $gapped,
        '[&>div]:px-16' => !$gapped,
        $column_count_css_var,
        'container mx-auto' => $contained,
        '2xl:[--column-width:calc(var(--theme-container-max-width-2xl)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'xl:[--column-width:calc(var(--theme-container-max-width-xl)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'lg:[--column-width:calc(var(--theme-container-max-width-lg)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'md:[--column-width:calc(var(--theme-container-max-width-md)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'sm:[--column-width:calc(var(--theme-container-max-width-sm)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        '[--column-width:var(--theme-container-max-width)/var(--container-columns)]' => ($expand_left || $expand_right)  && !$contained,
        '@container-2xl:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-xl:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-xl))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-lg:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-lg))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-md:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-md))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-sm:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-sm))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '[&>div:first-child]:col-span-2' => $expand_left,
        '[&>div:first-child]:col-start-2' => !$expand_left && $expand_right,
        '[&>div:last-child]:col-span-2' => $expand_right,

    ])
    >
        {{ $slot }}
    </div>
</div>
