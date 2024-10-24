@props(['typeButton' => 'button'])

<button {{ $attributes->merge(['class' => 'fst-normal tooltip-container d-flex gap-1 ' . ($class ?? 'btn-primary') . ' ' . ($paddingClass ?? 'px-3 py-2'), 'id' => ($id ?? ''), 'type' => $typeButton , 'disabled' => ($disabled ?? false)]) }}  >
    <div @class(['me-1'=>  !($onlyIcon ?? false)]) >
        {!! $icon !!}
    </div>
    {{$text ?? ''}}
    <span class="tooltip-text">{{$tooltipText}}</span>
</button>

