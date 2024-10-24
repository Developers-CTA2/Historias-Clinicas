@props(['title'])
<div class="card shadow-custom mb-4">
    <div class="card-header text-center bg-blue">
        {{$title}}
    </div>
    <div class="card-body px-4">
        {{$slot}}
    </div>
</div>
