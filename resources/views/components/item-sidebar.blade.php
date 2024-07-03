@props(['title','route'])
{{-- Item sidebar --}}
<li class="link-item-custom">
    <a class="link-item-principal" href="{{$route}}">
        <div class="icon-item-sidebar">
            {{$icon}}
        </div>
        <span class="text">{{$title}}</span>
    </a>
</li>