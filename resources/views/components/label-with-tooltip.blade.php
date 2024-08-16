@props(['labelFor','titleLabel','required','message' => '','haveTooltip' => false])
<div class="d-flex justity-content-between">
    <label for="{{$labelFor}}" class="flex-grow-1"> @if($required)<span class="required-point me-1">*</span>@endif{{$titleLabel}}</label>
    @if($haveTooltip)
        <x-tooltip message="{{$message}}" />
    @endif
</div>