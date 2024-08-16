@props(['id', 'name', 'active', 'classCustom' => ''])
<button @class(['active'=> $active, 'nav-link', 'text-start',$classCustom]) id="btn-{{$id}}" data-bs-toggle="pill" data-bs-target="#{{$id}}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="{{$active}}">{{$slot}} {{$name}}</button>
