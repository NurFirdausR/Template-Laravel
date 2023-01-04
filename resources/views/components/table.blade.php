@props([
    'thead',
    'tfoot',
])

<table {{ $attributes->merge(['class' => 'table table-striped mt-3', 'width' => '100%']) }}>
    @isset($thead)
    <thead {{ $thead->attributes->class(['']) }}>
        {{ $thead }}
    </thead>
    @endisset

    <tbody class="sort_menu">
        {{ $slot }}
    </tbody>

    @isset($tfoot)
    <tfoot {{ $thead->attributes->class(['']) }}>
        {{ $tfoot }}
    </tfoot>
    @endisset
</table>