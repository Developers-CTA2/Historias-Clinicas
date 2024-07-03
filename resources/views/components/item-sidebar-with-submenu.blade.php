@props(['label'])

<li class="link-item-custom">
    <a class="link-item-principal">
        <div class="icon-item-sidebar">
            {{$icon}}
        </div>
        <span class="text">{{$label}}</span>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="arrow-submenu">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
        </div>
    </a>
    <ul class="submenu">
        {{$slot}}
    </ul>
</li>
