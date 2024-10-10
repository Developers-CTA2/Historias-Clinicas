<button {{ $attributes }} @class(['fst-normal',$padding ,'tooltip-container','d-flex','gap-1',  $class]) id="{{$id}}" {{$disabled ? 'disabled' : ''}} >
    <div @class(['me-1'=>  !$onlyIcon]) >
        {!! $icon !!}
    </div>
    {{$text}}

    <span class="tooltip-text">{{$tooltipText}}</span>
</button>

