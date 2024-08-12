@props(['id', 'name', 'active'])
<button class="nav-link {{$active && 'active'}} text-start list-btn-nav" id="btn-{{$id}}" data-bs-toggle="pill" data-bs-target="#{{$id}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="{{$active}}">{{$name}}</button>
