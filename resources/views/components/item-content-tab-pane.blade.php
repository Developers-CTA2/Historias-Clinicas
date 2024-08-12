@props(['id', 'active'])
<div class="tab-pane fade show {{$active && 'active'}} md-w-custom" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $id }}" tabindex="0">
    {{ $slot }}
</div>
