@props([
    'column_count' => 2,
    'contained' => true,
    'expand_left' => false,
    'expand_right' => false,
    'gapped' => true,
    'virtual_column_count' => 2,
    'collapse_left_margin',
    'collapse_right_margin'
])
@php
    //ensure expand options are disabled when contained
    if($contained) {
        $expand_left = false;
        $expand_right = false;
    }

    //determine whether to use columns or virtual columns when detrmining grid columns
    $col = $column_count != $virtual_column_count ? $virtual_column_count : $column_count;

    $column_count_css_var = match($col) {
        '1' => !($expand_left || $expand_right) ? 'grid-cols-1' : "grid-cols-2 [--container-columns:2]",
        '2' => !($expand_left || $expand_right) ? 'grid-cols-1 md:grid-cols-2' : " grid-cols-3 [--container-columns:2]",
        '3' => !($expand_left || $expand_right)  ? 'grid-cols-1 md:grid-cols-3' :"grid-cols-5 [--container-columns:3]",
        default => !($expand_left || $expand_right)  ? 'grid-cols-1 md:grid-cols-4' :"grid-cols-5 [--container-columns:4]"
    };
@endphp
<div class='relative @container'>
    <?php //@todo proper injection of styles ?>
    <style>
        * {
            --theme-container-max-width-2xl: 1536px;
            --theme-container-max-width-xl: 1280px;
            --theme-container-max-width-lg: 1024px;
            --theme-container-max-width-md: 768px;
            --theme-container-max-width-sm: 640px;
            --theme-container-max-width: 100%;
        }
    </style>
    <div @class([
        'grid',
        'pl-6' => !$collapse_left_margin,
        'pr-6' => !$collapse_right_margin,
        'gap-16' => $gapped,
        $column_count_css_var,
        'container mx-auto' => $contained,

        //column width var
        '2xl:[--column-width:calc(var(--theme-container-max-width-2xl)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'xl:[--column-width:calc(var(--theme-container-max-width-xl)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'lg:[--column-width:calc(var(--theme-container-max-width-lg)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'md:[--column-width:calc(var(--theme-container-max-width-md)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        'sm:[--column-width:calc(var(--theme-container-max-width-sm)/var(--container-columns))]' => ($expand_left || $expand_right) && !$contained,
        '[--column-width:var(--theme-container-max-width)/var(--container-columns)]' => ($expand_left || $expand_right)  && !$contained,

        //grid cols var
        '@container-2xl:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-xl:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-xl))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-lg:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-lg))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-md:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-md))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        '@container-sm:grid-cols-[minmax(1px,_calc((100%_-_var(--theme-container-max-width-sm))/2))_repeat(var(--container-columns),_var(--column-width))_minmax(1px,_calc((100%_-_var(--theme-container-max-width-2xl))/2))]' => ($expand_left || $expand_right)  && !$contained,
        //'@container-xs:grid-cols-1' => ($expand_left || $expand_right)  && !$contained,

        //expand cols var
        '[&>div:first-child]:col-span-2' => $expand_left,
        '[&>div:first-child]:col-start-2' => !$expand_left && $expand_right,
        '[&>div:last-child]:col-span-2' => $expand_right,
    ])
    >
        {{ $slot }}
    </div>
</div>
