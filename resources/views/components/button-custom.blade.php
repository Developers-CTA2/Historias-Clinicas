<button {{ $attributes }} @class(['fst-normal' ,'tooltip-container','d-flex','gap-1',  $class, $paddingClass ?? 'px-3 py-2']) id="{{$id}}" {{$disabled ? 'disabled' : ''}} >
    <div @class(['me-1'=>  !$onlyIcon]) >
        {!! $icon !!}
    </div>
    {{$text}}
    {{ $padding}}
    <span class="tooltip-text">{{$tooltipText}}</span>
</button>

