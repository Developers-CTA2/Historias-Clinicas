<a {{ $attributes->merge(['class' => 'fst-normal px-3 py-2 tooltip-container d-flex gap-1 ' . ( $class ?? '' ), 'href' => $route ]) }}>
    <div class="me-1">
        {!! $icon !!}
    </div>
    {{($text ?? '')}}
    <span class="tooltip-text">{{$tooltipText}}</span>
</a>

