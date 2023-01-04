@props([
    'header',
    'footer',
])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($header)
    <div {{ $header->attributes->class(['card-header']) }}>
        {{ $header }}
    </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>

    @isset($footer)
    <div {{ $footer->attributes->class(['card-footer']) }}>
        {{ $footer }}
    </div>
    @endisset
</div>
