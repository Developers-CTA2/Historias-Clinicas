@props(['tooltipText' => '', 'text' => ''])

<button
    {{ $attributes->merge(['class' => 'fst-normal tooltip-container d-flex gap-1 ', 'type' => 'button']) }}>
    <div @class(['me-1' => !($onlyIcon ?? false)])>
        {!! $icon !!}
    </div>
    {{ $text }}
    <span class="tooltip-text">{{ $tooltipText }}</span>
</button>
