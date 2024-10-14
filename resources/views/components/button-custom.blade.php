<button {{ $attributes->merge(['class' => 'fst-normal tooltip-container d-flex gap-1 ' . $class . ' ' .$paddingClass ?? ' px-3 py-2', 'id' => $id, 'type' => $type, 'disabled' => $disabled]) }}  >
    <div @class(['me-1'=>  !$onlyIcon]) >
        {!! $icon !!}
    </div>
    {{$text}}
    <span class="tooltip-text">{{$tooltipText}}</span>
</button>

