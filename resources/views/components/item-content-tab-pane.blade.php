@props(['id', 'active'])
<div class="tab-pane fade {{ $active ? 'show active' : '' }} md-w-custom" id="{{ $id }}" role="tabpanel"
    aria-labelledby="{{ $id }}" tabindex="0">
    <div class="px-5 px-sm-0 px-lg-0">
        {{ $slot }}
    </div>
</div>
