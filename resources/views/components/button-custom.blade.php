<button {{ $attributes }} @class(['fst-normal' ,'tooltip-container','d-flex','gap-1',  $class, $padding]) id="{{$id}}" {{$disabled ? 'disabled' : ''}} >
    <div @class(['me-1'=>  !$onlyIcon]) >
        {!! $icon !!}
    </div>
    {{$text}}
    {{ $padding}}
    <span class="tooltip-text">{{$tooltipText}}</span>
</button>

