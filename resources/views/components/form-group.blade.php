<div @class(['form-group', 'col-lg-6','col-12', 'mb-3', 'group-custom', $class]) id="{{$id}}">

    {!! $label !!}
    
    <div class="input-group">
        <span class="input-group-text">{!! $icon !!}</span>
        {!! $input !!}
    </div>
    <span class="text-danger fw-normal d-none"></span>
</div>