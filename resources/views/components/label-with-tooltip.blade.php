@props(['labelFor','titleLabel','required','message'])
<div class="d-flex justity-content-between mb-1">
    <label for="{{$labelFor}}" class="pb-1 flex-grow-1">{{$titleLabel}} @if($required)<span class="required-point">*</span>@endif</label>
    <x-tooltip message="{{$message}}" />
</div>