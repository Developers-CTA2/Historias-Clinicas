@extends('admin.layouts.main')

@section('title', 'Agenda')
@section('viteConfig')
    @vite(['resources/sass/agenda.scss'])
@endsection


@section('content')
<div id="calendar"></div>

@endsection

@section('scripts')
@vite(['resources/js/loading-screen.js', 'resources/js/SideBar.js', 'resources/js/agenda.js'])
@endsection