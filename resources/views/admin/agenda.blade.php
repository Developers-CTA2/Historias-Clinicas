@extends('admin.layouts.main')

@section('title', 'Agenda')
@section('viteConfig')
    @vite(['resources/sass/agenda.scss'])
@endsection


@section('content')
    <div id="calendar" class="mt-4"></div>

@endsection

@section('scripts')
    @vite('resources/js/agenda.js')
@endsection
